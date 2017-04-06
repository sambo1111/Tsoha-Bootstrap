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
        
        $errors = $band->errors();
        
        if (count($errors) > 1) {
            Redirect::to('/band/', array('message' => 'Virheelliset tiedot lisäyksessä!'));
         
        } else {
            
            $band->save();
            Redirect::to('/band/' . $band->id, array('message' => 'Yhtye on lisätty kirjastoosi!'));
        }
        
    }
    
    public static function edit($id){
        $band = Band::find($id);
        View::make('band/edit.html', array('band' => $band));
    }
    
    public static function update($id){
        $params = $_POST;

        $attributes = array(
          'id' => $id,
          'name' => $params['name'],
          'description' => $params['description'],
          'founded' => $params['founded']
        );

        $band = new Band($attributes);
        $errors = $band->errors();

        if(count($errors) > 0){
          View::make('band/edit.html', array('errors' => $errors, 'band' => $band));
        }else{
          $band->update();

          Redirect::to('/band/' . $band->id, array('message' => 'Yhtyeen muokkaus onnistui!'));
        }
    }
    
    public static function destroy($id) {
        $band = $band = Band::find($id);
        $band->destroy();
        Redirect::to('/band/', array('message' => 'Yhtyeen poisto onnistui!'));
    } 
}

