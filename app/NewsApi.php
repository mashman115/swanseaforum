<?php

namespace App;

class NewsApi{

    public $baseUrl;
    public $source;
    public $apiKey;

    public function __construct($baseUrl,$source,$apiKey){
      $this->baseUrl = $baseUrl;
      $this->source = $source;
      $this->apiKey = $apiKey;
    }

}
