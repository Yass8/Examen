<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Parametre as ModelsParametre;
use Illuminate\Http\Request;

class parametre extends Controller
{
    public function index() {
        // $param = new ModelsParametre();
        // $param->nom = "Nom de l'établissement";
        // $param->save();
        return view('examen.parametre');
    }

    public function show(){
        return response()->json([
            'etablissement' => ModelsParametre::find(1),
        ]);
    }

    public function edit(Request $request){
        $nom = $request->input('nom');

        $etab = ModelsParametre::find(1);
        $etab->nom = $nom;
        $etab->update();
        return response()->json([
            'status'=>200,
            'message'=>'Etablissement modifié avec succès !',
        ]);
    }
}
