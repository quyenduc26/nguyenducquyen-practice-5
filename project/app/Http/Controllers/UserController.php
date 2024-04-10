<?php

/**
 * @OA\Info(title="User API", version="1.0")
 */

 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 
 class UserController extends Controller
 {
     /**
      * @OA\Get(
      *     path="/users",
      *     summary="Get all users from users table with their posts.",
      *     tags={"Users"},
      *     @OA\Response(
      *         response=200,
      *         description="Successful operation",
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     )
      * )
      */
     public function index()
     {
         $users = User::with('posts')->get();
         return response()->json($users);
     }
 
     /**
      * @OA\Post(
      *     path="/users",
      *     summary="Create new user",
      *     tags={"Users"},
      *     @OA\RequestBody(
      *         required=true,
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     ),
      *     @OA\Response(
      *         response=201,
      *         description="User created successfully",
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     )
      * )
      */
     public function store(Request $request)
     {
         $user = User::create($request->all());
         return response()->json($user, 201);
     }
 
     /**
      * @OA\Get(
      *     path="/users/{id}",
      *     summary="Get one user by id with their posts.",
      *     tags={"Users"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the user",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Successful operation",
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="User not found"
      *     )
      * )
      */
     public function show($id)
     {
         $user = User::with('posts')->findOrFail($id);
         return response()->json($user);
     }
 
     /**
      * @OA\Put(
      *     path="/users/{id}",
      *     summary="Update user by id",
      *     tags={"Users"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the user",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\RequestBody(
      *         required=true,
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="User updated successfully",
      *         @OA\JsonContent(ref="#/components/schemas/User")
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="User not found"
      *     )
      * )
      */
     public function update(Request $request, $id)
     {
         $user = User::findOrFail($id);
         $user->update($request->all());
         return response()->json($user, 200);
     }
 
     /**
      * @OA\Delete(
      *     path="/users/{id}",
      *     summary="Delete user by id",
      *     tags={"Users"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the user",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\Response(
      *         response=204,
      *         description="User deleted successfully"
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="User not found"
      *     )
      * )
      */
     public function destroy($id)
     {
         $user = User::findOrFail($id);
         $user->delete();
         return response()->json(null, 204);
     }
 }
 