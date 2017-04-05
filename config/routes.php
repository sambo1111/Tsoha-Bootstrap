<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/album/', function() {
    AlbumController::index();
  });
  
  $routes->get('/album/1', function() {
    HelloWorldController::album_show();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
   $routes->get('/album/1/edit', function() {
    HelloWorldController::album_edit();
  });
  
    $routes->get('/band/', function() {
    BandController::index();
  });
  
  $routes->post('/band', function(){
    BandController::store();
  });
  
  $routes->get('/band/new', function(){
    BandController::create();
  });
  
   $routes->get('/band/:id', function($id){
    BandController::show($id);
  });
  
  $routes->get('/band/:id/edit', function($id){
    BandController::edit($id);
  });
  
  $routes->post('/band/:id/edit', function($id){

    BandController::update($id);
  });

  $routes->post('/band/:id/destroy', function($id){

    BandController::destroy($id);
  });
 
