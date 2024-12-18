<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function exportSalesReportCsv(Request $request)
    {
        // Apply date range filter if provided
        $query = Order::query(); // Get orders (not order items)
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Get orders with orderItems and products eager loaded
        $orders = $query->with('orderItems.product')->get();

        // Check if there are any orders
        if ($orders->isEmpty()) {
            // If no orders exist, you can return an empty response or message
            return response()->json(['message' => 'No orders found'], 404);
        }

        // CSV data to be returned
        $csvData = [];

        // Write column headers
        $csvData[] = ['Order ID', 'Product Name', 'Quantity', 'Total Price', 'Status'];

        // Write order data
        foreach ($orders as $order) {
            // Check if orderItems is not null
            if ($order->orderItems) {
                foreach ($order->orderItems as $orderItem) {
                    $csvData[] = [
                        $order->id,
                        $orderItem->product->name,
                        $orderItem->quantity,
                        $orderItem->price * $orderItem->quantity,
                        $order->status
                    ];
                }
            }
        }

        // Create CSV string
        $csvFile = fopen('php://temp', 'r+');
        foreach ($csvData as $row) {
            fputcsv($csvFile, $row);
        }
        rewind($csvFile);

        // Return the CSV as a download
        return response()->stream(function () use ($csvFile) {
            while (($row = fgetcsv($csvFile)) !== false) {
                echo implode(',', $row) . "\n";
            }
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=sales_report.csv",
        ]);
    }


    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
        $this->middleware('admin'); // Ensure user is an admin
    }

    public function createAdminForm()
    {
        return view('admin.create-admin'); // Create a view for admin creation form
    }

    public function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => true, // Mark as admin
        ]);

        return redirect()->route('dashboard')->with('success', 'Admin created successfully!');
    }

    public function salesReport(Request $request)
    {
        $query = OrderItem::query();

        // Apply date range filter if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Fetch total sales and total orders
        $totalSales = $query->sum('price');
        $totalOrders = $query->count();

        // Fetch order items data for the breakdown table (or you can fetch orders if needed)
        $orders = Order::with('orderItems.product')->get(); // Adjust the relationship if necessary

        return view('admin.sales-report', compact('totalSales', 'totalOrders', 'orders'));
    }
}
