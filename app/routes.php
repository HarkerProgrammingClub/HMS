<?php
Route::get('/', array('as' => 'home', 'uses' 	=> 'MainController@home')
Route::get('/', array('as' => 'login', 'uses' 	=> 'UserController@login'))