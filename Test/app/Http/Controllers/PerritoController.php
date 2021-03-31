<?php

namespace App\Http\Controllers;

use App\Models\Perrito;
use App\Models\Razas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PerritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perritos = Perrito::select('perritos.id','perritos.nombre','perritos.color','razas.nombreRaza')
        ->join('razas','perritos.razas_id','=','razas.id')
        ->get();
        return view('perritos.index',compact('perritos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $razas = Razas::orderBy('id', 'asc')->get();
        return view('perritos.create', compact('razas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perrito = Perrito::where('nombre', $request->nombre)->get()->first();
        

        if ($perrito) {
            return json_encode('existe');
        } else {
            $perrito = new Perrito();
            $perrito->nombre = $request->nombre;
            $perrito->color = $request->color;
            $perrito->razas_id = $request->razaid;
            $perrito->save();
            return json_encode('agregado');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perrito $perrito)
    {

        $perritos = Perrito::select('perritos.id','perritos.nombre','perritos.color','perritos.created_at','razas.nombreRaza')
        ->join('razas','perritos.razas_id','=','razas.id')
        ->where('perritos.id',  $perrito->id)
        ->get()
        ->first();
        return view('perritos.show',compact('perritos'));
    }

    public function edit($perrito)
    {
        $perritos = Perrito::find($perrito);
        $razas = Razas::orderBy('id', 'asc')->get();
        return view('perritos.edit',compact('perritos'), compact('razas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perritos = Perrito::where('nombre',$request->nombre)->get()->first();

        if ($perritos) {    
            return json_encode('existe');
        }
        else if (!$perritos) {
            $perrito = Perrito::find($id);
            $perrito->nombre = $request->nombre;
            $perrito->color = $request->color;
            $perrito->razas_id = $request->razaid;
            $perrito->save();
            return json_encode('update');
            
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perrito = Perrito::find($id);
        $perrito->delete();
        return redirect()->route('perritos.index');
    }
}
