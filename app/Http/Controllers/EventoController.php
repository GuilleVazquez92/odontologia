<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calendario.index');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $evento = Evento::create($request->all());
    }

  
    public function show(Evento $evento)
    {
        $evento = Evento::all();
        return response()->json($evento);
    }

   
    public function edit(Evento $id)
    {
        $evento = Evento::find($id);
        return response()->json($evento);
    }

   
    public function update(Request $request, Evento $evento)
    {
        //
    }

  
    public function destroy(Evento $evento)
    {
        //
    }
}
