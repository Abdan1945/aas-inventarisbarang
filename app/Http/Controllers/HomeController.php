<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // akan menampilkan view resources/views/home.blade.php
    }
}
