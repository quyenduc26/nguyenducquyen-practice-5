<?php

/**
 * @OA\Info(title="Post API", version="1.0")
 */

 namespace App\Http\Controllers;

 use App\Models\Post;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;



 
 class PostController extends Controller
 {
     /**
     * @OA\Get(
     *     path="/posts",
     *     summary="Get all posts from posts table with their users.",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         )
     *     )
     * )
     */

     public function index()
     {
         $posts = Post::with('user')->get();
         return response()->json($posts);
     }
 
     /**
      * @OA\Post(
      *     path="/posts",
      *     summary="Create new post",
      *     tags={"Posts"},
      *     @OA\RequestBody(
      *         required=true,
      *         @OA\JsonContent(ref="#/components/schemas/Post")
      *     ),
      *     @OA\Response(
      *         response=201,
      *         description="Post created successfully",
      *         @OA\JsonContent(ref="#/components/schemas/Post")
      *     )
      * )
      */
     public function store(Request $request)
     {
         $post = Post::create($request->all());
         return response()->json($post, 201);
     }
 
     /**
      * @OA\Get(
      *     path="/posts/{id}",
      *     summary="Get one post by id with its user.",
      *     tags={"Posts"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the post",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Successful operation",
      *         @OA\JsonContent(ref="#/components/schemas/Post")
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="Post not found"
      *     )
      * )
      */
     public function show($id)
     {
         $post = Post::with('user')->findOrFail($id);
         return response()->json($post);
     }
 
     /**
      * @OA\Put(
      *     path="/posts/{id}",
      *     summary="Update post by id",
      *     tags={"Posts"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the post",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\RequestBody(
      *         required=true,
      *         @OA\JsonContent(ref="#/components/schemas/Post")
      *     ),
      *     @OA\Response(
      *         response=200,
      *         description="Post updated successfully",
      *         @OA\JsonContent(ref="#/components/schemas/Post")
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="Post not found"
      *     )
      * )
      */
     public function update(Request $request, $id)
     {
         $post = Post::findOrFail($id);
         $post->update($request->all());
         return response()->json($post, 200);
     }
 
     /**
      * @OA\Delete(
      *     path="/posts/{id}",
      *     summary="Delete post by id",
      *     tags={"Posts"},
      *     @OA\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID of the post",
      *         @OA\Schema(
      *             type="integer"
      *         )
      *     ),
      *     @OA\Response(
      *         response=204,
      *         description="Post deleted successfully"
      *     ),
      *     @OA\Response(
      *         response=404,
      *         description="Post not found"
      *     )
      * )
      */
     public function destroy($id)
     {
         $post = Post::findOrFail($id);
         $post->delete();
         return response()->json(null, 204);
     }
 }
 