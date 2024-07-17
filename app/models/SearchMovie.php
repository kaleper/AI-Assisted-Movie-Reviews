<?php

class SearchMovie {

  public function __construct() {

  }
  
  public function getMovie($title, $year) {
    
    $queryUrl = "https://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=" . urlencode($title) . "&y=" . $year;
    // var_dump($OMDB_KEY);
    // var_dump($queryUrl);
    $json = file_get_contents($queryUrl);
    //var_dump($json);

    // True makes it an associative array
    $json_associative_array = json_decode($json, true);
    return $json_associative_array;
  }
}