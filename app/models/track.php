<?php

class Track extends BaseModel {
    
    public $id, $album_id, $name, $track_length, $album_name;
    
    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array();
    }
    
    public static function all() {
        
        $query = DB::connection()->prepare('SELECT * FROM Track');
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $tracks = array();
        
        foreach($rows as $row) {
            
            $album_name = Album::find($row['album_id'])->name;
            $tracks[] = new Track(array(
                
                'id' => $row['id'],
                'album_id' => $row['album_id'],
                'name' => $row['name'],
                'track_length' => $row['track_length'],
                'album_name' => $album_name
                
            ));
            
        }
        
        
        return $tracks;
    }
    
    public static function find($id) {
        
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            $album_name = Album::find($row['album_id'])->name;
            $track = new Track(array(
               
                'id' => $row['id'],
                'album_id' => $row['album_id'],
                'name' => $row['name'],
                'track_length' => $row['track_length'],
                'album_name' => $album_name
                
            ));
            
            return $track;
        }
        
        return null;
        
    }
    
    public static function findAlbumTracks($id) {
        
        $query = DB::connection()->prepare('SELECT * FROM Track WHERE album_id = :id');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        
        $tracks = array();
        
        foreach($rows as $row) {
            
            $tracks[] = new Track(array(
                
                'id' => $row['id'],
                'album_id' => $row['album_id'],
                'name' => $row['name'],
                'track_length' => $row['track_length'],
                
            ));
            
        }
        
        
        return $tracks;
        
    }
    
    public function save() {
        
        $query = DB::connection()->prepare('INSERT INTO Track (name, track_length, album_id) VALUES (:name, :track_length, :album_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'track_length' => $this->track_length, 'album_id' => $this->album_id));
        $row = $query->fetch();
        $this->id = $row['id'];
      
    }
}

