<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //VERY IMPORTANT
    use ElasticquentTrait;

    protected $fillable=[
        'title','body','tags'
    ];

    //elastic search fields initialization
    protected $mappingProperities=array(
        'title'=>[
            'type'=>'text',
            'analyzer'=>'standard'
        ],
        'body'=>[
            'type'=>'text',
            'analyzer'=>'standard'
        ],
        'tags'=>[
            'type'=>'text',
            'analyzer'=>'standard'
        ]
    );
}
