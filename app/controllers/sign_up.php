<?php

class Sign_up extends Controller {

  public function index() {		
    $this->view('sign_up/index');
  }

  public function newAcc(){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $user = $this->model('CreateUser');
    $user->register($username, $password); 
  }
}
