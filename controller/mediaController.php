<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $allMedias = Media::getAllMedias();
  $search = isset( $_GET['titl'] ) ? $_GET['titl'] : null;
  $medias = Media::filterMedias( $search );

  require('view/mediaListView.php');

}

/***************************
 * --- MEDIA PAGE CONTENT----
 * *************************/

function mediaContent($id) {
  $mediaById = Media::getMediaById($id);

require('view/mediaView.php');

}
