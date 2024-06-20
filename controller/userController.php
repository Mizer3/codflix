<?php

require_once( 'model/user.php' );

/***************************
* ----- SHOW USER DATA -----
***************************/

function userData($id) {

  $user_id = isset( $id ) ? $id : false;

  if( $user_id == $_SESSION['user_id'] ):

    $user_data  = User::getUserById( $user_id );

    require('view/profileView.php');
  else:
    require('view/homeView.php');
  endif;

}

function updateForm($id){

  $user_id = isset( $id ) ? $id : false;

  if( $user_id == $_SESSION['user_id'] ):

    $user_data  = User::getUserById( $user_id );

    require('view/updateProfileView.php');
  else:
    require('view/homeView.php');
  endif;
}

function updateProfile($id) {

  $user_id = isset( $id ) ? $id : false;
  $user_data  = User::getUserById( $user_id );

  
  if( $user_id == $_SESSION['user_id'] ){
    
    
    $data = new stdClass();
    $data->id = $user_data['id'];
    $data->email = $user_data['email'];
    $data->password = $user_data['password'];
    $data->isVerified = $user_data['isVerified'];

    $user = new User( $data );

    // Check if the email is different from the one in the database
    if( !empty($_POST['email']) && $_POST['email'] != $user_data['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $user->setEmail( $_POST['email'] );
    } else {
      $user->setEmail( $user_data['email'] );
    }

    // Check the password
    if( !empty($_POST['old-password']) && !empty($_POST['new-password']) && !empty($_POST['password_confirm']) ){
      if(password_verify( $user_data['password'], $_POST['old-password'] ) ){
        $error_msg = "Ancien mot de passe n'est pas bon";
      } else if( strlen($_POST['new-password']) < 6 ){
        $error_msg = "Votre mot de passe doit contenir au moins 6 caractères";
      } else if( $_POST['new-password'] != $_POST['password_confirm'] ){
        $error_msg = "La confirmation du mot de passe n'est pas bonne";
      } else {
        $user->setPassword($_POST['new-password'], $_POST['password_confirm'] );
      }
      
    } else {
      $user->setPassword( $user_data['password'] );
    }
    $user->setIsVerified(1);
    $user->updateUser();
    header('location: index.php');
  }else {
    $error_msg = "Une erreur est subvenue";
  }

}