<?php

class Album extends BaseModel {
    public $id, $band_id, $name, $release_date, $description, $band_name;
    
    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array();
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
    
    public function save() {
        
        $query = DB::connection()->prepare('INSERT INTO Album (name, description, release_date, band_id) VALUES (:name, :description, :release_date, :band_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'release_date' => $this->release_date, 'band_id' => $this->band_id));
        $row = $query->fetch();
        $this->id = $row['id'];
      
    }
}

