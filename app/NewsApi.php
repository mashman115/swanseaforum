<?php

namespace App;

class NewsApi{

    public $baseUrl;
    public $apiKey;

    public function __construct($baseUrl,$apiKey){
      $this->baseUrl = $baseUrl;
      $this->apiKey = $apiKey;
    }

}
