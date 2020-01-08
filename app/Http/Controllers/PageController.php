<?php
namespace App\Http\Controllers;

class PageController extends Controller {
	public function about()
	{
		//return "About Us";
		return view('about');
	}

	public function contact()
	{
		//return "Contact";
		return view('contact');
	}
}