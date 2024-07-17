<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }
?>


<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-9 col-xl-8">
        <p> hello!</p>
        <?php if (isset($data['movie']) && !empty($data['movie'])): ?>
            <h2>Movie Details</h2>
            <?php foreach ($data['movie'] as $key => $value): ?>
                <p>
                    <strong><?php echo $key; ?>:</strong> <?php echo $value; ?>
                </p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No movie details found.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>