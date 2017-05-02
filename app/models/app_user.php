<?php

class AppUser extends BaseModel {
    public $id, $name, $password, $is_admin;

    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array();

    }

    public static function authenticate($name, $password) {

        $query = DB::connection()->prepare('SELECT * FROM AppUser WHERE (name, password) = (:name, :password) LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));

        $row = $query->fetch();

        if ($row) {

            $user = new AppUser(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'is_admin' => $row['is_admin']
            ));

            return $user;

        } else {
            return NULL;
        }

    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM AppUser WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {

            $user = new AppUser(array(

                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'is_admin' => $row['is_admin']

            ));

            return $user;
        }

        return null;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Appuser (name, password) VALUES (:name, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];

    }
}
