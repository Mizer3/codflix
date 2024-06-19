<?php

session_start();

require_once( 'model/user.php' );

/****************************
* ----- LOAD LOGIN PAGE -----
****************************/

function loginPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/loginView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- LOGIN FUNCTION -----
***************************/

function login( $post ) {



  $data           = new stdClass();
  $data->email    = $post['email'];
  $data->password = $post['password'];

  $user           = new User( $data );
  $userData       = $user->getUserByEmail();

  $error_msg      = "Email ou mot de passe incorrect";

  if( $userData && sizeof( $userData ) != 0 ):
    if(password_verify($data->password, $userData['password']) || $data->password == $userData['password']){
      
      // Set session
      $_SESSION['user_email'] = $userData['email'];
      if($userData['isVerified'] == 0){
        header( 'location: index.php?action=confirmEmail' );
      } else {
        header( 'location: index.php ');
      }
    $error_msg = "Email ou mot de passe incorrect";
  }
  endif;

  require('view/auth/loginView.php');
}

/****************************
* ----- LOGOUT FUNCTION -----
****************************/

function logout() {
  $_SESSION = array();
  session_destroy();

  header( 'location: index.php' );
}
