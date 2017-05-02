<?php

class UserAlbum extends BaseModel {

  public $id, $user_id, $album_id;

  public function __construct($attr) {
      $this->validators = array();
      parent::__construct($attr);
  }

  public static function findUserAlbums($id) {

    $query = DB::connection()->prepare('SELECT a.id, a.name, a.band_id, a.release_date FROM UserAlbum as ua
      INNER JOIN Album as a ON ua.album_id = a.id WHERE ua.user_id = :id');

    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();

    $albums = array();

    foreach($rows as $row) {

        $band_name = Band::find($row['band_id'])->name;
        $albums[] = new Album(array(

            'id' => $row['id'],
            'band_id' => $row['band_id'],
            'name' => $row['name'],
            'release_date' => $row['release_date'],
            'band_name' => $band_name

        ));

    }
    return $albums;

  }

  public function save() {

      $query = DB::connection()->prepare('INSERT INTO UserAlbum (user_id, album_id) VALUES (:user_id, :album_id) RETURNING id');
      $query->execute(array('user_id' => $this->user_id, 'album_id' => $this->album_id));
      $row = $query->fetch();
      $this->id = $row['id'];

  }

  public function check_if_user_has_album($alb_id, $usr_id) {

    $albums = UserAlbum::findUserAlbums($usr_id);

    foreach($albums as $album) {

      if ($album->id == $alb_id) {
        return true;
      }
    }

    return false;

  }

}
