<?php

class Band extends BaseModel {
    public $id, $name, $description, $founded;
    
    public function __construct($attr) {
        parent::__construct($attr);
        $this->validators = array('validate_name', 'validate_description');
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
                'founded' => $row['founded']     
                
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
                'founded' => $row['founded']
                
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
    
    public function update() {
        
        $query = DB::connection()->prepare('UPDATE Band SET (name, description, founded) = (:name, :description, :founded) WHERE id = :id');
        $query->execute(array('id' => $this->id ,'name' => $this->name, 'description' => $this->description, 'founded' => $this->founded));
        
    }
    
    public function destroy() {
        
        $query = DB::connection()->prepare('DELETE FROM Band WHERE id = :id');
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

