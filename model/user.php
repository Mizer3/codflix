<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;
  protected $isVerified;
  protected $token;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
      $this->isVerified = false;
      $this->token = "";
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function setIsVerified( $isVerified ) {
    $this->isVerified = $isVerified;
  }

  public function setToken( $token ) {
    $this->token = $token;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getIsVerified() {
    return $this->isVerified;
  }

  public function getToken() {
    return $this->token;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();

    $token = bin2hex(random_bytes(50));

    $req  = $db->prepare( "INSERT INTO user ( email, password, isVerified, token ) VALUES ( :email, :password, :isVerified, :token )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword(),
      'isVerified' => false,
      'token'     => $token
    ));

    // Close databse connection
    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    $db   = null;

    return $req->fetch();
  }

  /***************************************
   * ------- UPDATE USER -------
   * ***************************************/

  public function updateUser() {
    // Open database connection
    $db = init_db();

    // Prepare the SQL query
    $req = $db->prepare("UPDATE user SET email = ?, password = ?, isVerified = ?, token = ? WHERE id = ?");

    // Execute the query
    $req->execute(array($this->email, $this->password, $this->isVerified, $this->token, $this->id));

    // Close database connection
    $db = null;
  }

  /***************************************
   * ------- DELETE USER -------
   * ***************************************/

  public function deleteUser() {
    // Open database connection
    $db = init_db();

    // Prepare the SQL query
    $req = $db->prepare("DELETE FROM user WHERE id = ?");

    // Execute the query
    $req->execute(array($this->id));

    // Close database connection
    $db = null;
  
  }

}
