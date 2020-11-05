<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\Resource\Collection;
use Illuminate\Support\facades\Http;
use Illuminate\Support\Facades\Route;


class UserController extends Controller
{
    // use HasFactory;
    protected function fractal()
    {
        return new Fractal\Manager();
    }
    public function users()
    {
        // dd('masuk');
        $users = User::all();
        // $manager = new Manager();
        // $manager->setSerializer(new DataArraySerializer());
        return fractal()->collection($users)->transformWith(new UserTransformer)->toArray();
        // $resources = new Fractal\Resource\Collection($users, new UserTransformer);

        // return $manager->createData($resources)->toArray();
    }

    public function profile(User $user)
    {
        $user = $user->find(Auth::user()->id);
        return fractal()->item($user)->transformWith(new UserTransformer)->includePosts()->toArray();
    }

    public function profileById(User $user, $id)
    {
        $users = $user->find($id);
        // var_dump($users);
        return fractal()->item($users)->transformWith(new UserTransformer)->includePosts()->toArray();
    }

    public function pengguna(User $user)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://openweathermap.org/api ');
        $response  = $request->getBody();
        dd($response);
    }
}
