<?php

use Illuminate\Support\Facades\Route;

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
use \App\Article;

Route::get('/', function () {

    //First Step should add index to elastic search engine
    Article::addAllToIndex();

    return view('welcome');
});

Route::get('search',function (){

    $articles = Article::searchByQuery(
        [
            'match' => ['title' => 'sed'],
            //match on second filter and override one
            'match' =>['tags'=>'maxime']
        ],null,null,3,null,null);

    //return number of object return
//    dd($articles->totalHits());
//    dd( $articles->count());
//    dd($articles->skip(2)->get(2))

    //Put first two object in array
//    dd($articles->chunk(2));

    return $articles;
});




