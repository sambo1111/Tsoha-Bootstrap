<?php

class Album extends BaseModel {
    public $id, $band_id, $name, $release_date, $added, $description;
    
    public function __construct($attr) {
        parent::__construct($attr);
    }
    
    public static function all() {
        
        $query = DB::connection()->prepare('SELECT * FROM Album');
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $albums = array();
        
        foreach($rows as $row) {
            
            $albums[] = new Album(array(
                
                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'release_date' => $row['release_date'],
                'added' => $row['added'],
                'description' => $row['description']
                
            ));
            
        }
        
        return $albums;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Album WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row) {
            $album = new Album(array(
               
                'id' => $row['id'],
                'band_id' => $row['band_id'],
                'name' => $row['name'],
                'release_date' => $row['release_date'],
                'added' => $row['added'],
                'description' => $row['description']
                
            ));
            
            return $album;
        }
        return null;
    }
}

