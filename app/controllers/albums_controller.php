<?php

class AlbumController extends BaseController {
    public static function index() {
        
        $albums = Album::all();
        View::make('album/index.html', array('albums' => $albums));
        
    }
}

