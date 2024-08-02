<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() : JsonResponse
    {
        $payments = Payment::all();
        return response()->json($payments, 200);
    }

    public function destroy(Payment $payment) : JsonResponse
    {
        $payment->delete();
        return response()->json(null, 204);
    }

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'paid_at' => 'required|date',
        ]);

        $payment = Payment::create($validated);

        return response()->json($payment, 201);
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        try {
            $payment = Payment::findOrFail($id);

            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'amount' => 'required|numeric',
                'paid_at' => 'required|date',
            ]);

            $payment->update($validated);

            return response()->json($payment, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }

    public function show(string $id) : JsonResponse
    {
        try {
            $payment = Payment::findOrFail($id);
            return response()->json($payment, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
    }

    public function paid(Payment $payment) : JsonResponse
    {
        $payment->update(
            ['is_paid' => true, 'paid_at' => now()]
        );
        return response()->json(null, 204);
    }


}
