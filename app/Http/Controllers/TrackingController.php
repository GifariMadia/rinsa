<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_code' => ['required', 'string'],
        ]);

        $code  = strtoupper(trim($request->order_code));
        $order = Order::with(['customer', 'statusLogs'])
            ->where('order_code', $code)
            ->first();

        if (!$order) {
            return back()
                ->withInput()
                ->withErrors(['order_code' => 'Kode order tidak ditemukan. Periksa kembali kode kamu.']);
        }

        // Build timeline steps
        $statusFlow = Order::STATUS_FLOW;
        $statusLabels = Order::STATUS_LABELS;
        $curIdx = array_search($order->status, $statusFlow);

        $timeline = [];
        foreach ($statusFlow as $i => $status) {
            $log = $order->statusLogs->firstWhere('new_status', $status);
            $timeline[] = [
                'status' => $status,
                'label'  => $statusLabels[$status],
                'state'  => $i < $curIdx ? 'done' : ($i === $curIdx ? 'active' : 'pending'),
                'time'   => $log ? $log->changed_at->format('d M Y, H:i') : null,
            ];
        }

        return view('tracking.result', compact('order', 'timeline'));
    }
}
