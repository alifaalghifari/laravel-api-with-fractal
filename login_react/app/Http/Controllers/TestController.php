<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Ixudra\Curl\Facades\Curl;

class TestController extends Controller
{
    public function getApi()
    {

        $response = Curl::to('http://localhost:8000/api/users');

        return $response;
        // $url = 'http://localhost:8000/api/users';

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);
        // $err = curl_error($ch);  //if you need
        // curl_close($ch);
        // dd($err);
        // return $response;

        // dd('alif');
        // $client = new Client();
        // $request = $client->createRequest('get', 'http://localhost:8000/api/users');
        // $response  = $client->send($request);
        // dd(' asdf');



        // $request = Request::create('http://localhost:8000/api/users', 'GET');
        // $response = Route::dispatch($request);
        // return $response;

        // $response = Http::get('http://localhost:8000/api/users');
        // dd($response);
        // return $response['name'];
    }
}
