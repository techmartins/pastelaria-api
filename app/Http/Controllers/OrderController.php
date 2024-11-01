<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('products')->get();
    }

    public function show($id)
    {
        return Order::with('products')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

        $order = Order::create(['customer_id' => $request->customer_id]);
        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        // Dispara o e-mail com detalhes do pedido
        Mail::to($order->customer->email)->send(new SendMail($order));

        return $order->load('products');
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();

        foreach ($request->products as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        return $order->load('products');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Pedido deletado com sucesso.']);
    }
}
