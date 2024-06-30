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

<!-- Form to create a reminder -->
<div class="form row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <div class="form-container text-center mt-5 mb-3 px-5 py-5">
            <form action="#" method="post">
                <h1 class="header h2 fw-normal">Search for a movie</h1>
                <fieldset class="container mt-4">
                    <div class="form-group mb-1">
                        <label class="visually-hidden">Movie</label>
                            <textarea class="form-control" placeholder="Reminder" name="reminder" required autofocus> 
                            </textarea>
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