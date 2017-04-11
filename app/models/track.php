<?php

class Track extends BaseModel {
    
    public $id, $album_id, $name, $track_length, $album_name;
    
    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array('validate_name', 'validate_description');
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
}

