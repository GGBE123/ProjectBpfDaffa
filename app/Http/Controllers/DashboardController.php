<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total akun user biasa
        $totalUsers = User::where('is_admin', false)->count();

        // Hitung total semua order
        $totalOrders = Order::count();

        // Untuk admin: Hitung semua order berdasarkan status
        $adminOrders = auth()->user()->is_admin
            ? Order::select('status', \DB::raw('COUNT(*) as count'))->groupBy('status')->get()
            : [];

        // Untuk user: Hitung order berdasarkan status
        $userOrders = !auth()->user()->is_admin
            ? [
                'pending' => Order::where('user_id', auth()->id())->where('status', 'pending')->count(),
                'shipped' => Order::where('user_id', auth()->id())->where('status', 'shipped')->count(),
                'completed' => Order::where('user_id', auth()->id())->where('status', 'completed')->count(),
            ]
            : [];

        return view('dashboard', compact('totalUsers', 'totalOrders', 'adminOrders', 'userOrders'));
    }
}

