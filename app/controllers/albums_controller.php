<?php

class AlbumController extends BaseController {
    public static function index() {
        
        $albums = Album::all();
        View::make('album/index.html', array('albums' => $albums));
        
    }
    
    public static function show($id) {
        
        $album = Album::find($id);
        $album_tracks = Track::findAlbumTracks($id);
        
        View::make('album/show.html', array('album' => $album, 'album_tracks' => $album_tracks));
        
    }
    
    public static function create($id) {
        
        View::make('album/new.html', array('band_id' => $id));
        
    }
    
    public static function store() {
        
        $params = $_POST;
        
        $album = new Album(array(
           'name' => $params['name'],
           'release_date' => $params['release_date'],
           'description' => $params['description'],
           'band_id' => $params['band_id']
        ));
        
        $errors = $album->errors();
        
        if (count($errors) > 1) {
            Redirect::to('/album/', array('message' => 'Virheelliset tiedot lisäyksessä!'));
         
        } else {
            
            $album->save();
            Redirect::to('/band/' . $album->band_id, array('message' => 'Albumi on lisätty kirjastoosi!'));
        }
        
    }
}

