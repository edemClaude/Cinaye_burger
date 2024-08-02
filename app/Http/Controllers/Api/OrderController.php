<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Notifications\SendCustomerMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() : JsonResponse
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'burger_id' => 'required|exists:burgers,id',
            'quantity' => 'required|numeric',
        ]);

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    public function show(string $id) : JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        try {
            $order = Order::findOrFail($id);

            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'burger_id' => 'required|exists:burgers,id',
                'quantity' => 'required|numeric',
            ]);

            $order->update($validated);

            return response()->json($order, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Order not found'], 404);
        }

    }

    public function destroy(Order $order) : JsonResponse
    {
        $order->delete();
        return response()->json(null, 204);
    }

    public function canceled(Order $order) : JsonResponse
    {
        $order->update(['status' => 'canceled']);
        return response()->json(null, 204);
    }

    public function sold(Order $order) : JsonResponse
    {
        $order->update(['status' => 'sold']);
        $client = Customer::findOrFail($order->customer_id);
        $client->notify(new SendCustomerMail());
        return response()->json(null, 204);
    }



}
