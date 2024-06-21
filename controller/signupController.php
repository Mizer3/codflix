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
  }else if( !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $data->password)){
    throw new Exception( 'Votre mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial' );
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

/******************************************
* ----- REDIRCT FOR EMAIL VALIDATION -----
******************************************/

function confirmEmailPage(){

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
  if ($user_id) {
  require('view/auth/confirmEmail.php');
  } else {
    header('location: index.php');
  }
  
}

/***************************
* ----- EMAIL VALIDATION -----
* *************************/

function confirmEmail($user_id){
  $userData = User::getUserById($user_id);


  $data = new stdClass();
  $data->id = $userData['id'];
  $data->email = $userData['email'];
  $data->password = $userData['password'];
  $data->isVerified = $userData['isVerified'];
  $data->token = $userData['token'];

  

  if( empty( $data->email ) || empty( $data->token ) ){
    throw new Exception( 'User does not exist' );
  } else {
    $user = new User($data);
    $userMailVerif = $user->getUserByEmail();
    if($userMailVerif && sizeof($userMailVerif) != 0){
      if($data->token == $userData['token']){
        $user->setIsVerified(1);
        $user->setToken("");
        $user->updateUser();
        header('location: index.php');
        exit();
      } else {
        $error_msg = "Token incorrect";
      }
    } else {
      $error_msg = "Email incorrect";
    }
  }
  require('view/auth/confirmEmail.php');
}
