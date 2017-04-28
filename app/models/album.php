<?php

class Album extends BaseModel {
    public $id, $band_id, $name, $release_date, $description, $band_name;

    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Album');
        $query->execute();

        $rows = $query->fetchAll();

        $albums = array();

        foreach($rows as $row) {

            $band_name = Band::find($row['band_id'])->name;
            $albums[] = new Album(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'release_date' => $row['release_date'],
                'description' => $row['description'],
                'band_name' => $band_name

            ));

        }


        return $albums;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Album WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {

            $band_name = Band::find($row['band_id'])->name;

            $album = new Album(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'release_date' => $row['release_date'],
                'description' => $row['description'],
                'band_name' => $band_name

            ));

            return $album;
        }
        return null;
    }

    public static function findBandAlbums($id) {

        $query = DB::connection()->prepare('SELECT * FROM Album WHERE band_id = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();

        $albums = array();

        foreach($rows as $row) {

            $albums[] = new Album(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'release_date' => $row['release_date'],
                'description' => $row['description'],

            ));

        }
        return $albums;
    }

    public function destroy() {

        $query = DB::connection()->prepare('DELETE FROM Track WHERE album_id = :id');
        $query->execute(array('id' => $this->id));

        $query = DB::connection()->prepare('DELETE FROM UserAlbum WHERE album_id = :id');
        $query->execute(array('id' => $this->id));

        $query = DB::connection()->prepare('DELETE FROM Album WHERE id = :id');
        $query->execute(array('id' => $this->id));

    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Album (name, description, release_date, band_id) VALUES (:name, :description, :release_date, :band_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'release_date' => $this->release_date, 'band_id' => $this->band_id));
        $row = $query->fetch();
        $this->id = $row['id'];

    }

    public function validate_name(){
        $errors = array();
        if($this->name == '' || $this->name == null){
           $errors[] = 'Nimi ei saa olla tyhjä!';
        }

        return $errors;
    }

    public function validate_description(){
        $errors = array();
        if($this->description == '' || $this->description == null){
           $errors[] = 'Kuvaus ei saa olla tyhjä.';
        }
        if(strlen($this->description) < 10){
           $errors[] = 'Kuvauksen pituuden tulee olla vähintään 10 merkkiä.';
        }

        return $errors;
    }


}
