<?php

class GeminiApi {

  public function __construct() {

  }

  public function generateAIReview($rating) {
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

      return $review_text;
  }
   //TODO: FIX THIS:
  public function createReview($movie_title, $star_amount, $review_text, $year) {

    // Start connection to database
    $db = db_connect();

    // Use prepared statement with SQL
    $sql = "INSERT INTO movie_reviews (movie_title, movie_year, created_at, anonymous_review, username, rating) 
            VALUES (:movie_title, :movie_year, NOW(), :anonymous_review, :username, :rating)";
    $statement = $db->prepare($sql);

    // Bind values to the placeholders
    $statement->bindValue(':movie_title', $movie_title);
    $statement->bindValue(':movie_year', $year);
      // TODO: Replace when I add logic in for anonymous person
    $statement->bindValue(':anonymous_review', 1);
    // TODO: Replace when I add logic in for logged in user to post review
    $statement->bindValue(':username', "FAKEUSER");
    $statement->bindValue(':rating', $star_amount);

    $statement->execute();
    
  }
}
