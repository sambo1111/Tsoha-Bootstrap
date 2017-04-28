<?php

class BandMember extends BaseModel {
    public $id, $band_id, $name, $description, $band_name;

    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM BandMember');
        $query->execute();

        $rows = $query->fetchAll();

        $band_members = array();

        foreach($rows as $row) {

            $band_members[] = new BandMember(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'description' => $row['description']

            ));

        }
        return $band_members;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM BandMember WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {

            $band_name = Band::find($row['band_id'])->name;
            $band_member = new BandMember(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'description' => $row['description'] ,
                'band_name' => $band_name

            ));

            return $band_member;
        }

        return null;

    }

    public static function findBandMembers($id) {

        $query = DB::connection()->prepare('SELECT * FROM BandMember WHERE band_id = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();

        $band_members = array();

        foreach($rows as $row) {

            $band_members[] = new BandMember(array(

                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'description' => $row['description']

            ));

        }
        return $band_members;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO BandMember (name, band_id, description) VALUES (:name, :band_id, :description) RETURNING id');
        $query->execute(array('name' => $this->name, 'band_id' => $this->band_id, 'description' => $this->description));
        $row = $query->fetch();
        $this->id = $row['id'];

    }

    public function destroy() {

        $query = DB::connection()->prepare('DELETE FROM BandMember WHERE id = :id');
        $query->execute(array('id' => $this->id));

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
