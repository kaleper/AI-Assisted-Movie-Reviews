<?php

class Logout extends Controller {

    // Destory the session and redirect back to the login page 
    public function index() {		
        session_start();
        $_SESSION = array();
        session_destroy();
        $_SESSION['auth'] = 0;
        header('location: /home');
        $this->view('home/index');
    }
}