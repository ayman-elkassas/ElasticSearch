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

    //todo:Simple and Quick Search Query
//    $articles = Article::searchByQuery(
//        [
//            'match' => ['title' => 'sed'],
//            //match on second filter and override one
////            'match' =>['tags'=>'maxime']
//        ],null,null,3,null,null
//    );

    //todo:Full search example with aggregation, highlight, filter...
    $articles = Article::searchByQuery(
        [
            //QUERY
            'bool' => [
                'must'=>[
                    'match'=> [
                        //match : title must entire word like : 'sed'
                        'title'=> 'sed'
                    ],
                ],
                //then result apply next query
                'must_not'=> [
                    [
                        //match_phrase : title must not entire phrase like : 'Quidem quis sed.'
                        'match_phrase' =>[
                            'title' => 'Quidem quis sed.'
                        ]
                    ]
                ],
                'filter'=>[
                    [
                        'exists'=>[
                            'field'=>'title'
                        ],
                    ],
                    [
                        'range'=>[
                            'id'=>[
                                'gte'=>10
                            ]
                        ]
                    ]
                ],
                'should'=>[
                    'match'=> [
                        //match : title must entire word like : 'sed'
                        'title'=> 'sed'
                    ]
                ],
                'minimum_should_match' => 1,
            ],
        ],
        [
            //AGGREGATION
//            'aggs'=> [
//                'my_agg'=> [
//                    'terms' => [
//                        'field' => 'title',
//                        'size' => 10
//                        ]
//                    ]
//            ]
        ],null,3,null, ['id'=> ['order'=>'asc']]
    );

    //return number of object return
//    dd($articles->totalHits());
//    dd( $articles->count());
//    dd($articles->skip(2)->get(2))

    //Put first two object in array
//    dd($articles->chunk(2));

    return $articles;
});




