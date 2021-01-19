<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Album;

class FrontendController extends Controller
{
    public function index(){
        $albums = Album::latest()->paginate(50);
        return view('album.albumHome', compact('albums'));
    }
}