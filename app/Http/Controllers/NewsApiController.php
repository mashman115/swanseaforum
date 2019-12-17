<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\NewsApi;
use GuzzleHttp\Client;

class NewsApiController extends Controller
{
    public function index(NewsApi $news)
    {

      $client = new Client();
      $request = $client->get($news->baseUrl . $news->source . $news->apiKey);
      $response = $request->getBody()->getContents();
      $result = json_decode($response);

      return view('newsapi.index', ['articles' => $result->articles]);
    }
}
