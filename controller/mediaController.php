<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  if( !empty( $_GET['title'])){
    $medias = Media::filterMedias( $search );
  } else {
    $medias = Media::getAllMedias();
  }

  require('view/mediaListView.php');

}
