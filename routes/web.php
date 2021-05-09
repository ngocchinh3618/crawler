<?php

use Illuminate\Support\Facades\Route;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    $client = new Client(HttpClient::create(['timeout' => 60]));
    $temparr = [];
    $crawler = $client->request('GET', 'https://tinhocngoisao.com/may-tinh-de-ban');
    $crawler->filter(".product-inner > .mf-product-details > .mf-product-content > h2 > a")->each(function ($node) use (&$temparr) {
        array_push($temparr, $node->text());
    });

    return view('product',["products"=>$temparr]);
});
