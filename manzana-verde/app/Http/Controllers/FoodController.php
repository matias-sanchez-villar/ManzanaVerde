<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foods;

class FoodController extends Controller
{
    public function index()
    {
        try {
            $foods = Foods::all();
            return response()->json($foods);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $food = Foods::findOrFail($id);
            return response()->json($food);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Food not found'], 404);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
