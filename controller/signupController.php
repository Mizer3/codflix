<?php

require_once( 'model/user.php' );


/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}


/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function register($post){
  
  $data = new stdClass();
  $data->email = isset($post['email']) ? trim($post['email']) : "";
  $data->password = isset($post['password']) ? trim($post['password']) : "";
  $data->password_confirm = isset($post['password_confirm']) ? trim($post['password_confirm']) : "";

  // Check if all fields are filled
  if( empty( $data->email ) || empty( $data->password ) || empty( $data->password_confirm ) ){
    throw new Exception( 'Tous les champs ne sont pas remplis' );
  }else if( !filter_var($data->email, FILTER_VALIDATE_EMAIL) ){
    throw new Exception( 'Email incorrect' );
  }else if( strlen($data->password) < 6 ){
    throw new Exception( 'Votre mot de passe doit contenir au moins 6 caractères' );
  } else if( $data->password != $data->password_confirm ){
    throw new Exception( 'Vos mots de passes ne correspondent pas' );
  } else {
    // Create user
    
    $user = new User($data);
    
    try {
      // Check if email already exists
      $user->createUser();
      header('location: index.php');
    } catch (Exception $e) {
      $error_msg = $e->getMessage();
    }
  }

  require('view/auth/signupView.php');
}
