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
   
    
    
    public function review($movie_title, $rating) {
      $star_amount = 0;
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
              $star_amount = 1;
              break;
        
          case "2":
              $stars = "
            
                <i class='fa-solid fa-star'></i>
                  <i class='fa-solid fa-star'></i>
                  <i class='fa-regular fa-star'></i>
                  <i class='fa-regular fa-star'></i>
                  <i class='fa-regular fa-star'></i>
              ";
            $star_amount = 2;
              break;
        
          case "3":
          $stars = "
              <i class='fa-solid fa-star'></i>
              <i class='fa-solid fa-star'></i>
              <i class='fa-solid fa-star'></i>
              <i class='fa-regular fa-star'></i>
              <i class='fa-regular fa-star'></i>
          ";
              $star_amount = 3;
              break;
        
          case "4":
          $stars = "
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-regular fa-star'></i>
              
          ";
              $star_amount = 4;
              break;
    
          case "5":
          $stars = "
              <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          <i class='fa-solid fa-star'></i>
          ";
              $star_amount = 5;
              break;
      }
    $gemini = $this->model('GeminiApi');
    $review_text = $gemini->generateAIReview($rating);

        
    $this->view('omdb/review', [
        'movie_title' => $movie_title,
        'stars' => $stars,
        'review_text' => $review_text,
        'star_amount' => $star_amount
    ]);
    
    
    }

    // Redirected to function after a star rating and optional review has been written
     public function post_review() {
         $review_text = $_REQUEST['review_text'];
         $movie_title = $_REQUEST['movie_title'];
         $star_amount = $_REQUEST['star_amount'];
         var_dump($star_amount);
         var_dump($movie_title);
         var_dump($review_text);

    //TODO: FIX THIS:
         // $review = $this->model('createReview');
    
    }
}