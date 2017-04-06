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
        $user = AppUser::find($id);
        View::make('user/show.html', array('user' => $user));
    }
}
