<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string',
            'transaction_id' => 'sometimes|required|string',
            'payment_id' => 'sometimes|required|integer',
            'callback' => 'required|string',
        ]);

        $paymentService = new PaymentService();

        $paymentService->updateStatus($request->input('transaction_id', null), $request->input('payment_id', null), $data['status'], $data['callback']);

        return response()->json([
            'message' => 'Payment status updated successfully',
        ], 200);
    }
}