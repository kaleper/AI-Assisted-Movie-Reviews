<link rel="stylesheet" href="/app/views/css/omdb_review.css">

<!-- If user is authenticated, gives logged in header - otherwise gives an anonymous header -->
<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }
?>

<div class="form row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <div class='form-container text-center mt-5 mb-3 px-5 py-5'>
            <form action='/omdb/post_review' method='post'>
                <h1 class='header h2 fw-normal'>Leave A Review</h1>
                <fieldset class='container mt-4'>
                    <div class='form-group mb-3 d-flex flex-column align-items-center'>

                        <!-- Used when accessing POST --> 
                        <input type="hidden" name="movie_title" value="<?php echo htmlspecialchars($data['movie_title']); ?>">
                        <input type="hidden" name="stars" value="<?php echo htmlspecialchars($data['stars']); ?>">
                        <input type="hidden" name="star_amount" value="<?php echo htmlspecialchars($data['star_amount']); ?>">

                        <!-- Movie title and rating from search page -->
                        <?php 
                            echo "<p> You rated '" .$data['movie_title'] . 
                                 "': " . $data['stars'] . "</p>";
                        ?>
                        <label for="use_ai_review">Do you want to use an AI-generated review based on your star rating?</label>
                    </div>
                    <input type="radio" id="yes" name="use_ai_review" value="yes" checked> Yes
                    <input type="radio" id="no" name="use_ai_review" value="no"> No
                    <textarea id="review_text" name="review_text" class="ai_review_text mb-2 form-control w-100" required placeholder="Optional Review"><?php echo htmlspecialchars($data['review_text']); ?></textarea>
                    <div class='button mt-3'>
                        <button type='submit' class='btn btn-primary'>Submit Review</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<!-- JS dynamically changes page to either display AI generated review or not based on the user's preference according to the radio selection -->
<script>
    
    // Listen for if radio button is selected to use AI's review or not
    document.querySelectorAll('input[name="use_ai_review"]').forEach((e) => {
        e.addEventListener("change", function(event) {

            let textarea = document.getElementById("review_text");

            // Needed because the special characters from php can't be displayed in JS
            const reviewText = <?php echo json_encode($data['review_text']); ?>;

            // If user selects no, then take away AI generated review
            if (event.target.value === "no") {
                textarea.value="";
                textarea.placeholder="Optionally write a review, or submit rating without a review.";
            // Display AI generated review 
            } else {
                textarea.value= reviewText;
            }
        });
    });
</script>

<?php require_once 'app/views/templates/footer.php' ?>