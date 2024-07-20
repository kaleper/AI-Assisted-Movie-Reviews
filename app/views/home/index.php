<link rel="stylesheet" href="/app/views/css/home.css">
<?php if ($_SESSION['auth'] == 1) {
        require_once 'app/views/templates/header.php';

    echo "
            <div class='container main'>
                <div class='row mt-4'>
                    <div class='col-lg-12'>
                        <h4 class='greeting'>Welcome, " . $_SESSION['username'] . "</h4>
                        <p id='date'> <span id ='date-label'>Today's Date:</span> " . date('F jS, Y') . "</p>
                    </div>
                </div>
            </div>
        ";
        } else {
            require_once 'app/views/templates/headerAnon.php';
        }
    ?>

<!-- Form to search for a movie -->
<div class="form row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <?php 
            if (isset($_SESSION['review_placed']) && $_SESSION['review_placed']) {
            echo "<h3 class='review-confirmation text-success text-center mt-5'>Review placed successfully!</h3>";
            // Unset the session variable so the message only shows once
            unset($_SESSION['review_placed']);
            }
        ?>    
        <div class="form-container text-center mt-5 mb-3 px-5 py-5">
            <form action="/omdb/index" method="post">
                <h1 class="header h2 fw-normal">Search for a movie</h1>
                <fieldset class="container mt-4">
                    <div class="form-group mb-3 d-flex flex-column align-items-center">
                        <label class="visually-hidden">Movie</label>
                        <label for="title" class="mb-1"><strong>Title</strong></label>
                        <input type="text" id="title" name="title" class="mb-2 form-control w-50" required>
                        <label for="year" class="mb-1">
                            <i><strong>Year</strong> (Optional)</i>
                        </label>
                        <input type="text" id="year" name="year" class="mb-2 form-control w-50" >
                    </div>
                    <div class="button mt-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div> 
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>