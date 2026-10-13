<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class QuotationController extends Controller
{
    /**
     * Display all quotations.
     */
    public function index()
    {
        $quotations = Quotation::with(['user', 'product'])
            ->latest()
            ->paginate(10);

        return view('admin.quotations.index', compact('quotations'));
    }

    /**
     * Display quotation details.
     */
    public function show(Quotation $quotation)
    {
        $quotation->load(['user', 'product']);

        return view('admin.quotations.show', compact('quotation'));
    }

    /**
     * Update quotation status.
     */
    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected,completed',
        ]);

        $quotation->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.quotations.show', $quotation)
            ->with('success', 'Quotation status updated successfully.');
    }
}