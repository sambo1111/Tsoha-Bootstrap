<?php

class TrackController extends BaseController {
    
    public static function index() {
        
        $tracks = Track::all();
        View::make('track/index.html', array('tracks' => $tracks));
        
    }
    
    public static function show($id) {
        
        $track = Track::find($id);
        View::make('track/show.html', array('track' => $track));
        
    }
    
}

