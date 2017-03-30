<?php

class BandController extends BaseController {
    public static function index() {
        
        $bands = Band::all();
        View::make('band/index.html', array('bands' => $bands));
        
    }
    
    public static function show($id) {
        
        $band = Band::find($id);
        View::make('band/show.html', array('band' => $band));
        
    }
    
    public static function create() {
        
        View::make("band/new.html");
    }
    
    public static function store() {
        
        $params = $_POST;
        
        $band = new Band(array(
           'name' => $params['name'],
           'description' => $params['description'],
           'founded' => $params['founded']
        ));
        
        Kint::dump($params);
        $band->save();
        
        Redirect::to('/band/' . $band->id, array('message' => 'Yhtye on lisätty kirjastoosi!'));
        
    }
    
}

