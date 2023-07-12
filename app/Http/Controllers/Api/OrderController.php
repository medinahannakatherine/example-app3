<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class OrderController extends Controller
{
    public function store(Request $request){
        // Retrieve the authenticated user
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the product
        $product = Product::findOrFail($request->input('product_id'));
        $quantity = $request->input('quantity');

        // Check if the product has sufficient stock
        if ($quantity > $product->stock) {
            return response()->json([
                'message' => 'Failed to order this product due to unavailability of stock',
            ], 400);
        }

        // Decrement the stock
        $product->decrement('stock', $quantity);
        
        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return response()->json([
            'message' => 'You have successfully ordered this product.',
        ], 201);
    }

}
