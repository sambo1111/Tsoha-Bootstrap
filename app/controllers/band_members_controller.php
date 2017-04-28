<?php

class BandMemberController extends BaseController {

    public static function index() {


    }

    public static function show($id) {

        self::check_logged_in();
        $band_member = BandMember::find($id);

        View::make('band_member/show.html', array('band_member' => $band_member));

    }

    public static function create($id) {

        View::make('band_member/new.html', array('band_id' => $id));

    }

    public static function store() {

        $params = $_POST;

        $band_member = new BandMember(array(
           'name' => $params['name'],
           'description' => $params['description'],
           'band_id' => $params['band_id']
        ));

        $errors = $band_member->errors();

        if (count($errors) > 1) {
            Redirect::to('/band/', array('error' => 'Virheelliset tiedot jäsenen lisäyksessä!'));

        } else {

            $band_member->save();
            Redirect::to('/band/' . $band_member->band_id, array('message' => 'Kappale on lisätty kirjastoosi!'));
        }

    }

    public static function destroy($id) {
        $band_member = BandMember::find($id);
        $band_member->destroy();
        Redirect::to('/band/', array('message' => 'Jäsenen poisto onnistui!'));
    }
}
