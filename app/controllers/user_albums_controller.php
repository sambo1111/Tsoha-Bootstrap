<?php

class UserAlbumController extends BaseController {

  public static function store($id) {

    $user_album = new UserAlbum(array(
       'user_id' => $_SESSION['user'],
       'album_id' => $id,
    ));

    if (UserAlbum::check_if_user_has_album($id, $_SESSION['user']) == true) {
      Redirect::to('/album/' . $id, array('error' => 'Olet jo lisännyt albumin kokoelmaasi!'));
    }

    $errors = $user_album->errors();

    if (count($errors) > 1) {
        Redirect::to('/album/', array('message' => 'Virheelliset tiedot lisäyksessä!'));

    } else {

        $user_album->save();
        Redirect::to('/album/' . $user_album->album_id, array('message' => 'Yhtye on lisätty kirjastoosi!'));
    }

  }

}
