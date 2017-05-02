<?php

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');

    }


    public static function authenticate_user() {

        $params =  $_POST;

        $user = AppUser::authenticate($params['name'], $params['password']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Kirjautuminen epäonnistui', 'name' => $params['name']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/', array('message' => 'Kirjautuminen onnistui' . $user->name . '!'));
        }

    }

    public static function show($id) {
        self::check_logged_in();
        $user_albums = UserAlbum::findUserAlbums($id);
        $user = AppUser::find($id);
        View::make('user/show.html', array('user' => $user, 'user_albums' => $user_albums));
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function store() {

        $params = $_POST;

        if ($params['password'] != $params['password_confirmation']) {
          Redirect::to('/register/', array('error' => 'Virheellinen syöte!'));
        }

        $user = new AppUser(array(
           'name' => $params['name'],
           'password' => $params['password']
        ));

        $errors = $user->errors();

        if (count($errors) > 1) {
            Redirect::to('/register/', array('error' => 'Virheelliset tiedot lisäyksessä!'));

        } else {

            $user->save();
            Redirect::to('/band/', array('message' => 'Käyttäjä on luotu!'));
        }

    }

    public static function create() {

        View::make('user/new.html');

    }
}
