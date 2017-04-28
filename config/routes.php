<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->post('/album', function() {
     AlbumController::store();
  });

  $routes->get('/album/new/:id', function($id) {
     AlbumController::create($id);
  });

  $routes->get('/album/', function() {
    AlbumController::index();
  });

  $routes->get('/album/:id', function($id) {
    AlbumController::show($id);
  });

  $routes->post('/album/:id/destroy', function($id){
    AlbumController::destroy($id);
  });

  $routes->post('/album/:id', function($id) {
    UserAlbumController::store($id);
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

  $routes->get('/login', function(){

    UserController::login();
  });

  $routes->post('/login', function(){

    UserController::authenticate_user();
  });

  $routes->get('/user/:id', function($id) {

      UserController::show($id);
  });

  $routes->get('/track/', function() {
      TrackController::index();
  });

  $routes->post('/track', function() {
      TrackController::store();
  });

  $routes->get('/track/new/:id', function($id) {
      TrackController::create($id);
  });


  $routes->get('/track/:id', function($id){
      TrackController::show($id);
  });

  $routes->get('/band_member/new/:id', function($id) {
      BandMemberController::create($id);
  });

  $routes->post('/band_member', function() {
      BandMemberController::store();
  });

  $routes->get('/band_member/:id', function($id){
      BandMemberController::show($id);
  });

  $routes->post('/band_member/:id/destroy', function($id){
    BandMemberController::destroy($id);
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });
