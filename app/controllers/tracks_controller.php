<?php

class TrackController extends BaseController {

    public static function index() {

        $tracks = Track::all();
        View::make('track/index.html', array('tracks' => $tracks));

    }

    public static function show($id) {

        self::check_logged_in();
        $track = Track::find($id);
        View::make('track/show.html', array('track' => $track));

    }

    public static function create($id) {

        View::make('track/new.html', array('album_id' => $id));

    }

    public static function store() {

        $params = $_POST;

        $track = new Track(array(
           'name' => $params['name'],
           'track_length' => $params['track_length'],
           'album_id' => $params['album_id']
        ));

        $errors = $track->errors();

        if (count($errors) > 1) {
            Redirect::to('/album/', array('error' => 'Virheelliset tiedot lisäyksessä!'));

        } else {

            $track->save();
            Redirect::to('/album/' . $track->album_id, array('message' => 'Kappale on lisätty kirjastoosi!'));
        }

    }

}
