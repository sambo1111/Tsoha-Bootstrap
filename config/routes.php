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
