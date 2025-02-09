<link rel="stylesheet" href="/app/views/css/omdb.css">
<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }
?>

<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <?php 
        
        if (isset($_SESSION['review_placed']) && $_SESSION['review_placed']) {
            echo '<p>Review placed successfully!</p>';
            // Unset the session variable so the message only shows once
            unset($_SESSION['review_placed']);
        }
        
        if (isset($data['movie']['Response']) && $data['movie']['Response'] == "False") {
            echo "<h3>Movie search results for: " . htmlspecialchars($data['title']) . " </h3> 
                  <p>No movie details found.</p>";
            
        } else if (isset($data['movie']) && !empty($data['movie'])) { 
            // var_dump($data['movie']);

            // Get the date string
            $dateString = $data['movie']['Released'];

            // Create a DateTime object from the string
            $date = DateTime::createFromFormat('d M Y', $dateString);

            // Extract the year, this is to be sent along in the URL
            $year = $date->format('Y');


            
            echo "<h2 class ='mb-5'>Movie search results for: " . htmlspecialchars($data['title']) . "</h2>";

            echo "
                <div class='d-flex'>
                    <div class='flex-shrink-0'>
                        <img src='" . htmlspecialchars($data['movie']['Poster']) . "' alt='Movie Poster for " . htmlspecialchars($data['title']) . "' class='img-fluid'>
                    </div>
                    <div class='flex-grow-1 ms-3'>
                        <p>
                            <strong>Title: </strong>" . htmlspecialchars($data['movie']['Title']) . " (" . htmlspecialchars($data['movie']['Year']) . ")
                        </p>
                        <p>
                            <strong>Rated: </strong>" . htmlspecialchars($data['movie']['Rated']) . "
                        </p>
                        <p>
                            <strong>Released: </strong>" . htmlspecialchars($data['movie']['Released']) . "
                        </p>
                        <p>
                            <strong>Director: </strong>" . htmlspecialchars($data['movie']['Director']) . "
                        </p>
                        <p>
                            <strong>Actors: </strong>" . htmlspecialchars($data['movie']['Actors']) . "
                        </p>
                        <p>
                            <strong>Plot: </strong>" . htmlspecialchars($data['movie']['Plot']) . "
                        </p>
                        <h3>
                           <strong>Give A Rating For: </strong>" . $data['movie']['Title'] . "
                               <span class='star-rating'>
                                 <a id='5star' href='review/" . urlencode($data['movie']['Title']) . "/" . urlencode($year) . "/5' data-rating='5'><i class='fa-solid fa-star'></i></a>
                                  <a id='4stars' href='review/" . urlencode($data['movie']['Title']) . "/" . urlencode($year) . "/4' data-rating='4'><i class='fa-solid fa-star'></i></a>
                                  <a id='3stars' href='review/" . urlencode($data['movie']['Title']) . "/" . urlencode($year) . "/3' data-rating='3'><i class='fa-solid fa-star'></i></a>
                                  <a id='2stars' href='review/" . urlencode($data['movie']['Title']) . "/" . urlencode($year) . "/2' data-rating='2'><i class='fa-solid fa-star'></i></a>
                                  <a id='1stars' href='review/" . urlencode($data['movie']['Title']) . "/" . urlencode($year) . "/1' data-rating='1'><i class='fa-solid fa-star'></i></a>


                               </span>
                        </h3>
                        
                    </div>
                </div>
            ";

            // foreach ($data['movie'] as $key => $value) { 
            //     echo "<p><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
        }
            
        ?>
    </div>
</div>
<?php require_once 'app/views/templates/footer.php' ?>