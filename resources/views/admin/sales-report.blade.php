@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Laporan Penjualan</h1>

        <!-- Date Range Filtering -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.sales-report') }}">
                <label for="start_date">Tanggal Mulai :</label>
                <input type="date" id="start_date" name="start_date" value="{{ request()->get('start_date') }}">

                <label for="end_date">Tanggal Akhir :</label>
                <input type="date" id="end_date" name="end_date" value="{{ request()->get('end_date') }}">

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <!-- Displaying Total Sales and Total Orders -->
        <div class="mb-4">
            <h3>Total Penjualan : RP {{ number_format($totalSales, 0, ',', '.') }},00</h3>
            <h3>Total Order : {{ $totalOrders }}</h3>
        </div>

        <!-- Order Breakdown Table -->
        <div class="mb-4">
            <h4>Detail Order</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>Nama Produk</th>
                        <th>Banyak Produk</th>
                        <th>Harga Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $orderItem->product->name }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>RP {{ number_format($orderItem->price * $orderItem->quantity, 0, ',', '.') }},00</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Export Buttons (CSV) -->
        <div>
            <a href="{{ route('admin.sales-report.exportCsv') }}" class="btn btn-info">Export ke CSV</a>
        </div>
    </div>
@endsection
