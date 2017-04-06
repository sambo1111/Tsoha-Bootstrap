<?php

class Album extends BaseModel {
    public $id, $band_id, $name, $release_date, $added, $description, $band_name;
    
    public function __construct($attr) {
        parent::__construct($attr);
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
}

