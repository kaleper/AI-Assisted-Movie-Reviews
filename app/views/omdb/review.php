
<?php if ($_SESSION['auth'] == 1) {
      require_once 'app/views/templates/header.php';
  } else {
      require_once 'app/views/templates/headerAnon.php';
  }

echo $data['movie_title'] . " rated:";
echo $data['stars'];