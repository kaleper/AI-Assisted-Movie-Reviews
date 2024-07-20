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
    
      // GEMINI
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $_ENV['GOOGLE_API_KEY'];
    
      
      $data = array(
        "contents" => array(
            array(
                "role" => "user",            
                "parts" => array(
                    "text" => "Please give a review of Heriditary from someone who gave it a rating of $rating stars out of 5 stars. Please include the movie title as well as the rating."
                    )
                )
            )
          );
    
      // Convert this data in JSON format to be sent through google api
      $json_data = json_encode($data);
    
      // Use CURL to transfer data
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch);
      curl_close($ch);
      if (curl_errno($ch)) {
          echo "Curl Errors: " . curl_error($ch);
      }
    
      // Test response in json
      // echo "<pre>";
      // echo $response;
      
      // Decode the JSON response into php array (true param)
      $response_php = json_decode($response, true);
    
      // Get's AI generated response in the array
      $review_text = $response_php['candidates'][0]['content']['parts'][0]['text'];        
     
      
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
    
    }
}