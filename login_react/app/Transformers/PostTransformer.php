<?php

namespace App\Transformers;

use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;
use App\Models\Post;

class PostTransformer extends TransformerAbstract
{


    public function transform(Post $post)
    {
        // dd('masuk');

        return [
            'user_id' => $post->user_id,
            'content' => $post->content,
        ];
    }
}
