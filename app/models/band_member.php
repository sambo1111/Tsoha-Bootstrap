<?php

class BandMember extends BaseModel {
    public $id, $band_id, $name, $description, $band_name;
    
    public function __construct($attr) {
        parent::__construct($attr);
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
}
