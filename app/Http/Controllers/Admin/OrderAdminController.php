<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Tailor;

class OrderAdminController extends Controller
{
public function index()
{
    $penjahitId = auth()->id();

    $orders = Order::whereHas('tailor', function($query) use ($penjahitId) {
        $query->where('user_id', $penjahitId);
    })->get();

    return view('admin.orders.index', compact('orders'));
}

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status diperbarui.');
    }
}
