<?php

date_default_timezone_set('Europe/Paris');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/userController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

if ( isset( $_GET['action'] ) ):

  switch( $_GET['action']):

    case 'login':

      if ( !empty( $_POST ) ) login( $_POST );
      else loginPage();

    break;

    case 'signup':

      signupPage();

    break;

    case 'register':

      register($_POST);

    break;

    case 'logout':

      logout();

    break;

    case 'media':

      $id = $_GET['id'];
      mediaContent($id);

    break;

    case 'confirmEmailView':

      confirmEmailPage();

    break;

    case 'confirmEmail':

      $user_id = $_SESSION['user_id'];
      confirmEmail($user_id);

    break;

    case 'profileView':

      $user_id = $_SESSION['user_id'];
      userData($user_id);

    break;

    case 'updateForm':

      $user_id = $_SESSION['user_id'];
      updateForm($user_id);

    break;

    case 'updateProfile':

      $user_id = $_SESSION['user_id'];
      updateProfile($user_id);

    break;

  endswitch;

else:

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
    mediaPage();
  else:
    homePage();
  endif;

endif;
