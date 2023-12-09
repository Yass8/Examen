<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //
    public function updateMoyenne($id){
        $notes = DB::table('notes')
        ->join('matieres','matieres.id','=','notes.matiere_id')
        ->where('notes.candidat_id',$id)
        ->select('notes.*','notes.id as idNote','matieres.*')
        ->orderBy('matieres.nom_matiere','ASC')
        ->get();
        $s_notes = array();$s_coefs = array();
        foreach ($notes as $n) {

            array_push($s_notes, $n->note*$n->coef);
            array_push($s_coefs, $n->coef);
        }
        $sommeNote = array_sum($s_notes);
        $sommeCoef = array_sum($s_coefs);
        $moy = number_format($sommeNote/$sommeCoef,2);

        $releve = DB::table('releves')->where('candidat_id',$id)->first();
        $releve->moyenne = $moy;
        $releve->update();
    }
}
