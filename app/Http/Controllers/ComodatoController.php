<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comodato;

class ComodatoController extends Controller
{
    public function index()
    {       
        $comodatos = Comodato::all();
        return view('portal_it.layouts.index_comodatos', compact('comodatos'));
    }

    public function create(){

    }

    public function store(){
        
    }
}
