<?php

class OMdb extends Controller {
  public function index() {

    // Initialize movie variable
    $movie = null;

      // Check is user submitted form request
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the user input from form 
        $title = $_POST['title'];
        $year = $_POST['year'];

        // Fetch the movie data from the model
        $searchMovie = $this->model('OmdbApi');
        $movie = $searchMovie->getMovie($title, $year);
      }

    // Pass the movie data to the view
   
    $this->view('omdb/index', [
        'movie' => $movie,
        'title' => $title,
        'year' => $year
    ]);
              
    header ('location: /omdb/index');
    die;
    }
    // // Should be a in a model
    // $query_url = "https://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=the+matrix&y=1999";

    // $json = file_get_contents($query_url);
    // $phpObj = json_decode($json);
    // // For each loop to get all the info
    // $movie = (array) $phpObj;

    // echo "<pre>";
    // print_r($movie);
    // die;


  public function review($movie_title, $rating) {

      $stars = '';
      switch ($rating) {
          case "1":
              $stars = "
            
              <i class='fa-solid fa-star'></i>
                <i class='fa-regular fa-star'></i>
                <i class='fa-regular fa-star'></i>
                <i class='fa-regular fa-star'></i>
                <i class='fa-regular fa-star'></i>
              ";
              break;
        
          case "2":
              $stars = "
            
                <i class='fa-solid fa-star'></i>
                  <i class='fa-solid fa-star'></i>
                  <i class='fa-regular fa-star'></i>
                  <i class='fa-regular fa-star'></i>
                  <i class='fa-regular fa-star'></i>
              ";
              break;
        
          case "3":
          $stars = "
              <i class='fa-solid fa-star'></i>
              <i class='fa-solid fa-star'></i>
              <i class='fa-solid fa-star'></i>
              <i class='fa-regular fa-star'></i>
              <i class='fa-regular fa-star'></i>
          ";
          break;
        
          case "4":
          $stars = "
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-regular fa-star'></i>
              
          ";
          break;

          case "5":
          $stars = "
              <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          ";
          break;
      }
    $this->view('omdb/review', [
        'movie_title' => $movie_title,
        'stars' => $stars
    ]);

 
  }
}