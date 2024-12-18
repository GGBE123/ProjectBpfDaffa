@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Sales Report</h1>

        <!-- Date filters -->
        <form method="GET" action="{{ route('sales.report') }}">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <h4>Total Sales: ${{ number_format($totalSales, 2) }}</h4>

        <!-- Sales by Product -->
        <h5>Sales by Product</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesByProduct as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                        <td>${{ number_format($item->total_revenue, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Sales by Category -->
        <h5>Sales by Category</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesByCategory as $item)
                    <tr>
                        <td>{{ $item->category->name }}</td>
                        <td>${{ number_format($item->total_revenue, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection