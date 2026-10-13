@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Overview')

@section('styles')
<style>
    .dashboard-page {
        --dash-green: #16834c;
        --dash-ink: #15251c;
        --dash-muted: #7b8880;
        --dash-line: #e9eeeb;
        color: var(--dash-ink);
    }

    .dashboard-welcome {
        position: relative;
        display: flex;
        min-height: 190px;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        overflow: hidden;
        padding: 32px 38px;
        margin-bottom: 26px;
        border-radius: 22px;
        background: linear-gradient(115deg, #123a27 0%, #176b42 58%, #1a8a51 100%);
        color: #fff;
        box-shadow: 0 18px 42px rgba(20, 92, 55, 0.16);
    }

    .dashboard-welcome::after {
        position: absolute;
        right: 13%;
        bottom: -180px;
        width: 390px;
        height: 390px;
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 50%;
        box-shadow: 0 0 0 36px rgba(255,255,255,.035), 0 0 0 72px rgba(255,255,255,.025);
        content: "";
        pointer-events: none;
    }

    .welcome-copy, .welcome-actions {
        position: relative;
        z-index: 1;
    }

    .welcome-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #c9f2d8;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .welcome-title {
        margin: 0;
        color: #fff;
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 800;
        letter-spacing: -.04em;
    }

    .welcome-description {
        max-width: 560px;
        margin: 9px 0 0;
        color: rgba(255,255,255,.76);
        font-size: 14px;
    }

    .welcome-actions {
        display: flex;
        flex-shrink: 0;
        flex-wrap: wrap;
        gap: 10px;
    }

    .welcome-actions .btn {
        min-height: 44px;
        padding: 10px 16px;
        border-radius: 11px;
        font-weight: 700;
    }

    .dashboard-section-heading {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 14px;
        margin: 28px 0 14px;
    }

    .dashboard-section-heading h2 {
        margin: 0;
        color: var(--dash-ink);
        font-size: 17px;
        font-weight: 800;
        letter-spacing: -.02em;
    }

    .dashboard-section-heading p {
        margin: 4px 0 0;
        color: var(--dash-muted);
        font-size: 12px;
    }

    .metric-card {
        height: 100%;
        padding: 20px;
        border: 1px solid var(--dash-line);
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(19, 44, 30, .035);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(19, 44, 30, .08);
    }

    .metric-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .metric-label {
        margin: 0;
        color: var(--dash-muted);
        font-size: 12px;
        font-weight: 700;
    }

    .metric-value {
        margin: 12px 0 0;
        color: var(--dash-ink);
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.045em;
        line-height: 1;
    }

    .metric-caption {
        margin: 9px 0 0;
        color: #9aa49e;
        font-size: 11px;
    }

    .metric-icon {
        display: grid;
        width: 43px;
        height: 43px;
        place-items: center;
        border-radius: 13px;
        background: #edf8f1;
        color: var(--dash-green);
        font-size: 19px;
    }

    .status-card {
        display: flex;
        min-height: 77px;
        align-items: center;
        gap: 13px;
        padding: 15px 17px;
        border: 1px solid var(--dash-line);
        border-radius: 15px;
        background: #fff;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        flex: 0 0 auto;
        border-radius: 50%;
        background: #e5a52e;
        box-shadow: 0 0 0 5px #fff6e5;
    }

    .status-card.processing .status-dot {
        background: #3488cc;
        box-shadow: 0 0 0 5px #eaf4fc;
    }

    .status-card.delivered .status-dot {
        background: #27a467;
        box-shadow: 0 0 0 5px #e9f8ef;
    }

    .status-card span {
        color: var(--dash-muted);
        font-size: 11px;
        font-weight: 600;
    }

    .status-card strong {
        display: block;
        margin-top: 3px;
        color: var(--dash-ink);
        font-size: 19px;
        line-height: 1;
    }

    .dashboard-panel {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--dash-line);
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(19, 44, 30, .035);
    }

    .panel-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 20px 22px;
        border-bottom: 1px solid #f0f3f1;
    }

    .panel-heading h2 {
        margin: 0;
        color: var(--dash-ink);
        font-size: 15px;
        font-weight: 800;
    }

    .panel-heading p {
        margin: 4px 0 0;
        color: var(--dash-muted);
        font-size: 11px;
    }

    .panel-heading .btn {
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
    }

    .recent-orders-table {
        margin: 0;
        white-space: nowrap;
    }

    .recent-orders-table thead th {
        padding: 12px 18px;
        border-bottom: 1px solid #f0f3f1;
        background: #fbfcfb;
        color: #8a968f;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .09em;
        text-transform: uppercase;
    }

    .recent-orders-table tbody td {
        padding: 14px 18px;
        border-color: #f1f4f2;
        color: #526158;
        font-size: 12px;
    }

    .order-number {
        color: #1a3727;
        font-weight: 800;
    }

    .order-subtext {
        display: block;
        margin-top: 4px;
        color: #9aa49e;
        font-size: 10px;
    }

    .order-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 999px;
        background: #fff6e5;
        color: #98680d;
        font-size: 10px;
        font-weight: 800;
    }

    .order-status.processing { background: #eaf4fc; color: #276b9f; }
    .order-status.shipped { background: #edf2ff; color: #4b5fa4; }
    .order-status.delivered { background: #e9f8ef; color: #197547; }
    .order-status.cancelled { background: #fff0ef; color: #b3443a; }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        border: 1px solid var(--dash-line);
        border-radius: 13px;
        color: var(--dash-ink);
        text-decoration: none;
        transition: border-color .18s ease, background .18s ease, transform .18s ease;
    }

    .quick-action:hover {
        transform: translateY(-2px);
        border-color: #b9dfc7;
        background: #f8fcf9;
        color: var(--dash-ink);
    }

    .quick-action-icon {
        display: grid;
        width: 40px;
        height: 40px;
        flex: 0 0 auto;
        place-items: center;
        border-radius: 12px;
        background: #edf8f1;
        color: var(--dash-green);
        font-size: 17px;
    }

    .quick-action strong {
        display: block;
        font-size: 12px;
    }

    .quick-action small {
        display: block;
        margin-top: 3px;
        color: var(--dash-muted);
        font-size: 10px;
    }

    .system-summary {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px 22px;
        padding: 15px 18px;
        border: 1px solid var(--dash-line);
        border-radius: 14px;
        background: #fff;
        color: var(--dash-muted);
        font-size: 11px;
    }

    .system-summary strong { color: #435148; }

    .system-live {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-left: auto;
        color: #197547;
        font-weight: 800;
    }

    .system-live::before {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #27a467;
        content: "";
    }

    @media (max-width: 720px) {
        .dashboard-welcome {
            min-height: unset;
            align-items: flex-start;
            flex-direction: column;
            padding: 25px 23px;
        }

        .welcome-actions {
            width: 100%;
        }

        .welcome-actions .btn {
            flex: 1;
        }

        .dashboard-section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .system-live {
            margin-left: 0;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-page">
    <section class="dashboard-welcome">
        <div class="welcome-copy">
            <div class="welcome-eyebrow"><i class="bi bi-stars"></i> Store overview <span aria-hidden="true">·</span> {{ now()->format('D, d M Y') }}</div>
            <h2 class="welcome-title">Welcome back, {{ Auth::user()->name }}</h2>
            <p class="welcome-description">Here’s what’s happening with your store. Review orders, check performance, and keep things moving.</p>
        </div>
        <div class="welcome-actions">
            <a href="{{ route('admin.products.create') }}" class="btn btn-light text-success">
                <i class="bi bi-plus-lg me-1"></i> Add product
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-up-right me-1"></i> View orders
            </a>
        </div>
    </section>

    <div class="dashboard-section-heading">
        <div>
            <h2>Store at a glance</h2>
            <p>Your current catalog and order totals</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-6 col-xl-3">
            <article class="metric-card">
                <div class="metric-top"><p class="metric-label">Products</p><span class="metric-icon"><i class="bi bi-box-seam"></i></span></div>
                <p class="metric-value">{{ number_format($productsCount) }}</p>
                <p class="metric-caption">Products in your catalog</p>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="metric-card">
                <div class="metric-top"><p class="metric-label">Customers</p><span class="metric-icon"><i class="bi bi-people"></i></span></div>
                <p class="metric-value">{{ number_format($customersCount) }}</p>
                <p class="metric-caption">Registered customer accounts</p>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="metric-card">
                <div class="metric-top"><p class="metric-label">Orders</p><span class="metric-icon"><i class="bi bi-bag-check"></i></span></div>
                <p class="metric-value">{{ number_format($ordersCount) }}</p>
                <p class="metric-caption">All orders received</p>
            </article>
        </div>
        <div class="col-6 col-xl-3">
            <article class="metric-card">
                <div class="metric-top"><p class="metric-label">Categories</p><span class="metric-icon"><i class="bi bi-grid"></i></span></div>
                <p class="metric-value">{{ number_format($categoriesCount) }}</p>
                <p class="metric-caption">Product categories</p>
            </article>
        </div>
    </div>

    <div class="dashboard-section-heading">
        <div>
            <h2>Order pipeline</h2>
            <p>Track work from incoming to completed</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4"><div class="status-card"><span class="status-dot"></span><div><span>Pending</span><strong>{{ number_format($pendingOrdersCount) }}</strong></div></div></div>
        <div class="col-md-4"><div class="status-card processing"><span class="status-dot"></span><div><span>Processing</span><strong>{{ number_format($processingOrdersCount) }}</strong></div></div></div>
        <div class="col-md-4"><div class="status-card delivered"><span class="status-dot"></span><div><span>Delivered</span><strong>{{ number_format($deliveredOrdersCount) }}</strong></div></div></div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-xl-8">
            <section class="dashboard-panel">
                <div class="panel-heading">
                    <div><h2>Recent orders</h2><p>Latest orders placed in your store</p></div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success">All orders <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
                @if($recentOrders->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table recent-orders-table align-middle">
                            <thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th><th></th></tr></thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><span class="order-number">{{ $order->order_number }}</span><span class="order-subtext">{{ $order->created_at->format('d M Y') }}</span></td>
                                        <td>{{ $order->customer_name }}<span class="order-subtext">{{ $order->customer_email }}</span></td>
                                        <td class="fw-bold text-dark">${{ number_format((float) $order->total_amount, 2) }}</td>
                                        <td><span class="order-status {{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                        <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light text-success" aria-label="View order {{ $order->order_number }}"><i class="bi bi-arrow-up-right"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 px-3">
                        <span class="metric-icon mx-auto mb-3"><i class="bi bi-inbox"></i></span>
                        <h3 class="h6 fw-bold">No orders yet</h3>
                        <p class="text-muted small mb-0">New customer orders will show up here.</p>
                    </div>
                @endif
            </section>
        </div>

        <div class="col-xl-4">
            <section class="dashboard-panel">
                <div class="panel-heading"><div><h2>Quick actions</h2><p>Jump into common tasks</p></div></div>
                <div class="d-grid gap-2 p-3">
                    <a href="{{ route('admin.products.create') }}" class="quick-action">
                        <span class="quick-action-icon"><i class="bi bi-plus-lg"></i></span>
                        <span><strong>Add a product</strong><small>Grow your store catalog</small></span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="quick-action">
                        <span class="quick-action-icon"><i class="bi bi-folder-plus"></i></span>
                        <span><strong>Create a category</strong><small>Organize your products</small></span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </a>
                    <a href="{{ route('admin.quotations.index') }}" class="quick-action">
                        <span class="quick-action-icon"><i class="bi bi-file-earmark-text"></i></span>
                        <span><strong>Review quotations</strong><small>Respond to customer requests</small></span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="quick-action">
                        <span class="quick-action-icon"><i class="bi bi-bar-chart"></i></span>
                        <span><strong>Open reports</strong><small>See your store reports</small></span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </a>
                </div>
            </section>
        </div>
    </div>

    <div class="dashboard-section-heading">
        <div><h2>Store summary</h2><p>Sales total and administrator session</p></div>
    </div>
    <div class="system-summary">
        <span><i class="bi bi-currency-dollar me-1 text-success"></i> Sales total: <strong>${{ number_format((float) $totalSales, 2) }}</strong></span>
        <span><i class="bi bi-person me-1"></i> Signed in as: <strong>{{ Auth::user()->email }}</strong></span>
        <span class="system-live">Admin session active</span>
    </div>
</div>
@endsection
