<?php

class BandMember extends BaseModel {
    public $id, $band_id, $name, $description;
    
    public function __construct($attr) {
        parent::__construct($attr);
    }
}
