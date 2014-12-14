<?php

class MainController extends BaseController {
	public function home() {
		return View::make('home')
	}
}
