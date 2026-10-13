<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuotationController extends Controller
{
    public function index(Request $request): View
    {
        $query = DB::table('quotations')->orderByDesc('created_at');
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            $ids = $request->session()->get('customer_quotation_ids', []);
            $query->whereIn('id', $ids ?: [0]);
        }

        $quotations = $query->paginate(15);
        $productIds = $quotations->getCollection()->pluck('product_id')->unique();
        $products = DB::table('products')->whereIn('id', $productIds)->get()->keyBy('id');
        $quotations->getCollection()->transform(function ($quotation) use ($products) {
            $quotation->product = $products->get($quotation->product_id);
            $quotation->created_at = \Carbon\Carbon::parse($quotation->created_at);

            return $quotation;
        });

        return view('customer.quotations.index', compact('quotations'));
    }

    public function create(int $product): View
    {
        $product = DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();

        return view('customer.quotations.create', compact('product'));
    }

    public function store(Request $request, int $product): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'quantity' => ['required', 'integer', 'min:1'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();
        $quotationId = DB::table('quotations')->insertGetId([
            'user_id' => Auth::id(),
            'product_id' => $product,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'quantity' => $validated['quantity'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!Auth::check()) {
            $request->session()->put(
                'customer_quotation_ids',
                array_values(array_unique([...$request->session()->get('customer_quotation_ids', []), $quotationId]))
            );
        }

        return redirect()->route('customer.quotations.show', $quotationId)->with('success', 'Your quotation request has been sent.');
    }

    public function show(Request $request, int $quotation): View
    {
        $quotationRow = DB::table('quotations')->where('id', $quotation)->firstOrFail();
        $owned = Auth::check()
            ? (int) $quotationRow->user_id === (int) Auth::id()
            : in_array($quotation, array_map('intval', $request->session()->get('customer_quotation_ids', [])), true);
        abort_unless($owned, 404);

        $quotationRow->product = DB::table('products')->where('id', $quotationRow->product_id)->first();
        $quotationRow->created_at = \Carbon\Carbon::parse($quotationRow->created_at);

        return view('customer.quotations.show', ['quotation' => $quotationRow]);
    }
}
