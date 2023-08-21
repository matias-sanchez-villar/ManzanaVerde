<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Foods;
use JWTAuth;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|exists:users,id',
                'items' => 'required|array',
                'items.*.food_item_id' => 'required|exists:foods,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);
        
            $orders = [];
        
            foreach ($request->items as $item) {
                $order = Order::create([
                    'user_id' => $request->user_id,
                    'food_item_id' => $item['food_item_id'],
                    'quantity' => $item['quantity'],
                ]);
        
                $orders[] = $order;
            }
        
            return response()->json(['message' => 'Orders created successfully', 'orders' => $orders]);
        } catch (ValidationException $exception) {
            return response()->json(['error' => $exception->errors()], 422);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function all(Request $request)
    {
        try {
            $userOrders = Order::where('user_id', $request->user()->id)->get();
            return response()->json(['orders' => $userOrders]);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

}
