<?php

class AlbumController extends BaseController {
    public static function index() {
        
        $albums = Album::all();
        View::make('album/index.html', array('albums' => $albums));
        
    }
    
    public static function show($id) {
        
        $album = Album::find($id);
        View::make('album/show.html', array('album' => $album));
        
    }
}

