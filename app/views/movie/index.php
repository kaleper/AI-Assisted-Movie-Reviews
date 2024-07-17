<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }
?>


<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <?php 
             
            if (isset($data['movie']['Response']) && $data['movie']['Response'] == "False") {
                echo "<h3>Movie search results for: " . htmlspecialchars($data['title']) . " </h3> 
                      <p>No movie details found.</p>";
                
            } else if (isset($data['movie']) && !empty($data['movie'])) { 
                // var_dump($data['movie']);
                echo "<h2>Movie search results for: " . htmlspecialchars($data['movie']['title']) . "</h2>";

                foreach ($data['movie'] as $key => $value) { 
                    echo "<p><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
                }
            }
        ?>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>