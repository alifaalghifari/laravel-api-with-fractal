<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Transformers\PostTransformer;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function add(StorePostPost $request, Post $post)
    {
        $validate = (object) $request->validated();
        // dd(Auth::user()->id);
        $user = $post::create([
            'user_id' => Auth::user()->id,
            'content' => $validate->content,
        ]);

        $response = fractal()->item($user)->transformWith(new PostTransformer)->toArray();

        return response()->json($response, 201);
    }

    public function update(StorePostPost $request, Post $post)
    {

        // $this->authorize('update', $post); authorize dengan PostPolicy
        // $post->content = $request->get('content', $post->content);
        // $post->save();
        // $response = fractal()->item($post)->transformWith(new PostTransformer)->toArray();
        // return response()->json($response, 201);

        // 

        // Gate::authorize('update-post', $post); call fungsi update-post dari Class AuthServiceProvider
        if (Gate::allows('post', $post)) {
            $post->content = $request->get('content', $post->content);
            $post->save();
            $response = fractal()->item($post)->transformWith(new PostTransformer)->toArray();
            return response()->json($response, 201);
        } else {
            return "not allowed";
        }
    }

    public function delete(Request $request, Post $post)
    {
        //     dd($request->url());
        // $response = Http::delete($request->url());
        // return $response->status();
        if ($request->isMethod('delete')) {
            // Check is user can delete the post
            $response = Gate::inspect('update', $post);
            if ($response->allowed()) {
                // $post->delete(); // open this comment to delete
                $response = fractal()->item($post)->transformWith(new PostTransformer)->addMeta(['message' => 'Data was deleted'])->toArray();
                return response()->json($response, 201);
            } else {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'You cannot delete this post',
                    ], 401);
                } else {
                    $response = Http::delete($request->url());
                    return $response->status();
                }
            }
        } else {
            return response()->json([
                'message' => 'not allowed',
            ]);
        }
    }
}
