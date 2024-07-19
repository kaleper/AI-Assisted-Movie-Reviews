<link rel="stylesheet" href="/app/views/css/omdb_review.css">

<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }
?>

<!-- <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">

    
        
    </div>
</div> -->

<div class="form row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <div class='form-container text-center mt-5 mb-3 px-5 py-5'>
            <form action='/omdb/review' method='post'>
                <h1 class='header h2 fw-normal'>Leave A Review</h1>
                <fieldset class='container mt-4'>
                    <div class='form-group mb-3 d-flex flex-column align-items-center'>
                        <?php 
                            echo "<p> You rated '" .$data['movie_title'] . 
                                 "': " . $data['stars'] . "</p>";
                        ?>
                        <input type='text' id='title' name='title' class='mb-2 form-control w-50' required placeholder='Optional Review' >
                        <div class='button mt-3'>
                            <button type='submit' class='btn btn-primary'>Submit Review</button>
                        </div> 
                    </div> 
                </fieldset>
            </form>
        </div>
    </div>
</div>
 <?php
echo $data['review_text'];

?>

<?php require_once 'app/views/templates/footer.php' ?>