<?php

class Band extends BaseModel {
    public $id, $name, $description, $founded, $added;
    
    public function __construct($attr) {
        parent::__construct($attr);
    }
    
    public static function all() {
        
        $query = DB::connection()->prepare('SELECT * FROM Band');
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $bands = array();
        
        foreach($rows as $row) {
            
            $bands[] = new Band(array(
                
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'founded' => $row['added'],
                'added' => $row['added']        
                
            ));
            
        }
        return $bands;
    }
    
    public static function find($id) {
        
        $query = DB::connection()->prepare('SELECT * FROM Band WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            
            $band = new Band(array(
               
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'founded' => $row['added'],
                'added' => $row['added'] 
                
            ));
            
            return $band;
        }
        
        return null;
        
    }
    
    public function save() {
        
        $query = DB::connection()->prepare('INSERT INTO Band (name, description, founded) VALUES (:name, :description, :founded) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'founded' => $this->founded));
        $row = $query->fetch();
        $this->id = $row['id'];
      
    }
}

