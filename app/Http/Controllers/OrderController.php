<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Tailor;
use Midtrans\Snap;
use Midtrans\Config;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
public function create(Request $request)
{
    $tailor = null;
    $harga = 0;

    if ($request->has('product_id')) {
        $tailor = Tailor::find($request->product_id);
        $harga = $tailor ? $tailor->harga : 0;
    }
    return view('orders.create', compact('tailor', 'harga'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'ukuran' => 'required',
            'deskripsi' => 'nullable',
            'design' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'product_id' => 'required|exists:tailors,id',
        ]);

        $tailor = Tailor::findOrFail($request->product_id);
        $basePrice = (int) $tailor->harga;

        // // Simpan file desain
        $designPath = $request->file('design')->store('designs', 'public');
        // // Hitung tambahan (jika ada)
        $tambahan = null;
        $extraPrice = 0;
        $extraItems = [];

        if ($request->has('extras')) {
            $tambahan = implode(', ', collect($request->extras)->map(function ($item) use (&$extraPrice, &$extraItems) {
                [$nama, $harga] = explode('|', $item);
                $extraPrice += (int) $harga;
                $extraItems[] = [
                    'id' => 'extra-' . $nama,
                    'price' => (int) $harga,
                    'quantity' => 1,
                    'name' => 'Tambahan: ' . $nama
                ];
                return $nama . ' (+' . number_format($harga) . ')';
            })->toArray());
        }

        $finalPrice = ($basePrice + $extraPrice) * $request->jumlah;


        // Buat order di DB
        $order = Order::create([
            'user_id' => auth()->id(),
            'tailor_id' => $tailor->id,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'ukuran' => $request->ukuran,
            'deskripsi' => $request->deskripsi,
            'design' => $designPath,
            'harga' => $finalPrice,
            'tambahan' => $tambahan,
        ]);

        // Midtrans setup
        Config::$serverKey = "SB-Mid-server-d1p9xcPHAuAaIKqN71uVgJnP";
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Kirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => $finalPrice,
            ],
            'item_details' => array_merge([[
                'id' => 'produk-' . $tailor->id,
                'price' => $basePrice+$extraPrice,
                'quantity' => (int)$request->jumlah,
                'name' => 'Pemesanan: ' . $tailor->name,
            ]], $extraItems),
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);


       return view('orders.payment', compact( 'snapToken','order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }
    public function del($id) {
    Order::where('id',$id)->delete();
        return redirect()->back();
    }

    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function payment(Order $order)
    {
        Config::$serverKey = "SB-Mid-server-d1p9xcPHAuAaIKqN71uVgJnP";
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->harga,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('orders.payment', compact('snapToken', 'order'));
    }


    public function handleCallback(Request $request)
    {
        $serverKey = "SB-Mid-server-d1p9xcPHAuAaIKqN71uVgJnP";
        $hashed = hash("sha512", 
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($hashed === $request->signature_key) {
            $orderId = explode('-', $request->order_id)[1] ?? null;
            $order = Order::find($orderId);

            if ($order) {
                if ($request->transaction_status === 'settlement') {
                    $order->status = 'diproses';
                } elseif ($request->transaction_status === 'pending') {
                    $order->status = 'pending';
                } elseif ($request->transaction_status === 'deny' || $request->transaction_status === 'expire') {
                    $order->status = 'gagal';
                }
                $order->save();
            }
        }

        return response()->json(['message' => 'Callback processed']);
    }


}
