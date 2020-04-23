<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client as ElasticaClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    protected $elasticSearch;
    protected $elastica;

    //setup our clients
    public function __construct()
    {
        $this->elasticSearch=ClientBuilder::create()->build();

        //create an Elastica client
        $elasticaConfig=[
            'host'=>'localhost',
            'port'=>9200,
            'index'=>'pets'
        ];

//        $this->elastica=new ElasticaClient($elasticaConfig);
    }
}
