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
        $request = Request::create('http://localhost:8000/api/users', 'GET');
        $response = Route::dispatch($request);
        return $response;
    }
}
