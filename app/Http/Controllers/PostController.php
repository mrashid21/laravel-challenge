<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Resources\PostResource;
use App\Http\Requests\ToggleReactionRequest;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::select('id', 'title', 'description', 'created_at')->get();

        $data = PostResource::collection($posts);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function toggleReaction(ToggleReactionRequest $request)
    {
        $post = Post::find($request->post_id);

        if (! $post) {
            return response()->json([
                'status' => 404,
                'message' => 'model not found',
            ]);
        }

        if ($post->user_id == auth()->id()) {
            return response()->json([
                'status' => 500,
                'message' => 'You cannot like your post',
            ]);
        }

        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();

        if ($like && $request->like) {

            return response()->json([
                'status' => 500,
                'message' => 'You already liked this post',
            ]);

        } elseif ($like && !$request->like) {

            $like->delete();

            return response()->json([
                'status' => 200,
                'message' => 'You unlike this post successfully',
            ]);

        } elseif (!$like && $request->like) {

            Like::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'You like this post successfully',
            ]);

        }

        return response()->json([
            'status' => 500,
            'message' => 'reaction error',
        ]);
    }
}
