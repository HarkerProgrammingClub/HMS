<?php
Route::get('/', array('as' => 'home', 'uses' 	=> 'MainController@home'));
Route::get('/login', array('as' => 'login', 'uses' 	=> 'UserController@login'));