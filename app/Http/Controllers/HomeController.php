<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('resim_yukle','vericek');
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
     
    public function resim_yukle()
    {
        return view('resim_yukle');
    }

     public function vericek()
    {
        
        $tumResimler = Image::orderBy('id', 'desc')->take(1)->get();
        
       return view('/resim_yukle', compact('tumResimler'));
    }
    public function imagePage(){
        return view("admin.imageList");
    }
    public function setProfilePage(){

        return view("admin.setProfile");
    }
}
