<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('login.html');
    }
    
    public static function album_list() {
      View::make('suunnitelmat/album_list.html');
    }
    
    public static function album_show() {
      View::make('suunnitelmat/album_show.html');
    }
    
    public static function album_edit() {
      View::make('suunnitelmat/album_edit.html');
    }
    
    public static function login() {
      View::make('login.html');
    }
  } 
