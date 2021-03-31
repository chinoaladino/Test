<?php

namespace App\Http\Controllers;

use App\Models\Razas;
use Illuminate\Http\Request;

class RazaController extends Controller
{

    public function index()
    {
        $razas = Razas::orderBy('id', 'desc')->get();
        return view('razas.index', compact('razas'));
    }


    public function create()
    {
        return view('razas.create');
    }


    public function store(Request $request)
    {
        $raza = Razas::where('nombreRaza', $request->nombreRaza)->get()->first();
        if ($raza) {
            return json_encode('existe');
        } else if (!$raza) {
            $raza = new Razas();
            $raza->nombreRaza = $request->nombreRaza;
            $raza->save();
            return json_encode('Ingresado');
        }
    }


    public function show($id)
    {
        $raza = Razas::find($id);
        return view('razas.show', compact('raza'));
    }


    public function edit(Razas $razas)
    {
        return view('razas.edit', compact('razas'));
    }


    public function update(Request $request, $id)
    {
        $raza = Razas::where('nombreRaza',$request->nombreRaza)->get()->first();
        if ($raza) {
            return json_encode('existe');
        } else if (!$raza) {
            $razas =  Razas::find($id);
            $razas->nombreRaza = $request->nombreRaza;
            $razas->save();
            return json_encode('update');
        }
    }


    public function destroy($id)
    {
        $raza = Razas::find($id);
        $raza->delete();
        return redirect()->route('razas.index');
    }
}
