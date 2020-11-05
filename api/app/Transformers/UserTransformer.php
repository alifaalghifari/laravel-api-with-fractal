<?php

namespace App\Transformers;

use App\Models\User;
use App\Models\Post;
use App\Transformers\PostTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'posts',
    ];
    public function transform(User $user)
    {

        return [
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->api_token
        ];
    }

    public function includePosts(User $user)
    {
        $posts = $user->post()->LatestFirst()->get();

        return $this->collection($posts, new PostTransformer);
    }
}
