<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10'],
        ]);

        $phone = $request->phone;
        $customer = Customer::where('phone', $phone)->first();

        if (!$customer) {
            return back()
                ->withInput()
                ->withErrors(['phone' => 'Nomor telepon tidak ditemukan dalam data pelanggan kami.']);
        }

        $orders = $customer->orders()->latest()->get();

        return view('history.list', compact('customer', 'orders'));
    }

    public function feedback(Order $order)
    {
        return view('history.feedback', compact('order'));
    }

    public function storeFeedback(Request $request, Order $order)
    {
        $request->validate([
            'rating'    => ['required', 'integer', 'min:1', 'max:5'],
            'feedback'  => ['nullable', 'string', 'max:1000'],
            'complaint' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update([
            'rating'    => $request->rating,
            'feedback'  => $request->feedback,
            'complaint' => $request->complaint,
        ]);

        return redirect()->route('history.search', ['phone' => $order->customer->phone])
            ->with('success', 'Terima kasih atas feedback Anda!');
    }
}
