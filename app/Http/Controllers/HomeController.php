<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hak_akses == 'admin') {
            return view('admin.dashboard');
        } else if(Auth::user()->hak_akses == 'guru') {
            return view('home')->with('success', 'AKSES - GURU');
        } else if(Auth::user()->hak_akses == 'siswa') {
            return view('home')->with('success', 'AKSES - SISWA');
        } 
    }
}
