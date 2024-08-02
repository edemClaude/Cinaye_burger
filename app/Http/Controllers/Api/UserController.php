<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() : JsonResponse
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show(User $user) : JsonResponse
    {
        return response()->json($user, 200);
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        try {

            $user = User::findOrFail($id);
            $validate = $request->validate([
               'last_name' => 'required',
               'first_name' => 'required',
               'email' => 'required',
            ]);

            $user->update($validate);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);

        }
        return response()->json($user, 200);
    }

    public function destroy(User $user) : JsonResponse
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function activate(User $user) : JsonResponse
    {
        $user->update(['is_active' => true]);
        return response()->json($user, 200);
    }

    public function deactivate(User $user) : JsonResponse
    {
        $user->update(['is_active' => false]);
        return response()->json($user, 200);
    }

}
