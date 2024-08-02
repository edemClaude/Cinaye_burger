<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Burger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BurgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        // Retrieve all burgers from the database
        $burgers = Burger::all();

        // Return the burgers as a JSON response with status code 200
        return response()->json($burgers, 200);
    }


    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:1000',
            'price' => 'required|numeric',
            'image' => 'required|max:255',
        ]);

        $burger = Burger::create($validated);

        return response()->json($burger, 201);
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        try {
            $burger = Burger::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|max:50',
                'description' => 'required|max:1000',
                'price' => 'required|numeric',
                'image' => 'required|max:255',
            ]);

            $burger->update($validated);

            return response()->json($burger, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Burger not found'], 404);
        }

    }

    public function show(string $id) : JsonResponse
    {
        try {
            $burger = Burger::findOrFail($id);
            return response()->json($burger, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Burger not found'], 404);
        }
    }

    public function archive(Burger $burger) : JsonResponse
    {
        $burger->update(['is_archived' => true]);
        return response()->json(null, 204);
    }

    public function restore(Burger $burger) : JsonResponse
    {
        $burger->update(['is_archived' => false]);
        return response()->json(null, 204);
    }


}
