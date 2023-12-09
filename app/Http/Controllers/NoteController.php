<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Releve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'matiere' => 'required',
            'note' => 'required',
            'coefficient' => 'required',
            'reference' => 'required'
        ]);
        if($valid->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $valid->messages(),
            ]);
        }else{
            $n = new Note();
            $n->note = $request->input('note');
            $n->coef = $request->input('coefficient');
            $n->candidat_id = $request->input('reference');   
            $n->matiere_id = $request->input('matiere');   
            $n->save();
        $id_candidat = $request->input('candidat_id');
            // updateMoyenne($id_candidat);
        $notes = DB::table('notes')
        ->join('matieres','matieres.id','=','notes.matiere_id')
        ->where('notes.candidat_id',$id_candidat)
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

        DB::table('releves')
            ->where('candidat_id', $id_candidat)
            ->update(['moyenne' => $moy]);


            return response()->json([
                'status' => 200,
                'message' => 'Note ajoutée avec succès !',
            ]);
        }
    }

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes = DB::table('notes')
        ->join('matieres','matieres.id','=','notes.matiere_id')
        ->where('notes.candidat_id',$id)
        ->select('notes.*','notes.id as idNote','matieres.*')
        ->orderBy('matieres.nom_matiere','ASC')
        ->get();
        // dd($notes);
        $s_notes = array();$s_coefs = array();
        foreach ($notes as $n) {

            array_push($s_notes, $n->note*$n->coef);
            array_push($s_coefs, $n->coef);
        }
        $sommeNote = array_sum($s_notes);
        $sommeCoef = array_sum($s_coefs);
        $moy = 0;
        try {
        $moy = number_format($sommeNote/$sommeCoef,2);
            
        } catch (\Throwable $th) {
            //throw $th;
        }

        $jury = "";$mention = "";
        if ($moy < 10 && $moy >=8) {
            $jury = "Autorisé(e)";
            
        } elseif($moy>=10 && $moy<12) {
            $jury = "Admis(e)";
            $mention = "Passable";
        } elseif($moy>=12 && $moy<14) {
            $jury = "Admis(e)";
            $mention = "Assez-bien";
        } elseif($moy>=14 && $moy<16) {
            $jury = "Admis(e)";
            $mention = "Bien";
        } elseif($moy>=16 && $moy=17) {
            $jury = "Admis(e)";
            $mention = "Très bien";
        } elseif($moy>17) {
            $jury = "Admis(e)";
            $mention = "Excellent";
        } elseif($moy<8) {
            $jury = "Refusé(e)";
        }

        return response()->json([
            'notes' => $notes,
            'sommeNote' => $sommeNote,
            'sommeCoef' => $sommeCoef,
            'moyenne' => $moy,
            'jury' => $jury,
            'mention' => $mention
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $n = Note::find($id);
        
        return response()->json([
            
            'note'=>$n,
        ]);
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
        $valider = Validator::make($request->all(), [
            'note'=>'required',
            'coefficient' =>'required',
            'matiere' => 'required'
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $n = Note::find($id);
            $n->note = $request->input('note');
            $n->coef = $request->input('coefficient');
            $n->matiere_id = $request->input('matiere');
            $n->update();

            $id_candidat = $request->input('candidat_id');
            // updateMoyenne($id_candidat);
        $notes = DB::table('notes')
        ->join('matieres','matieres.id','=','notes.matiere_id')
        ->where('notes.candidat_id',$id_candidat)
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

        DB::table('releves')
            ->where('candidat_id', $id_candidat)
            ->update(['moyenne' => $moy]);

            return response()->json([
                'status' => 200,
                'message' => 'Note modifiée avec succès !',
            ]);
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
        $no = Note::find($id);
        $no->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Note supprimée avec succès !',
        ]);
    }

    public function suppression($note_id,$candidat_id){
        // $id = $request->input('note_id');
        
        // $no = Note::find($id);
        // $no->delete();
        DB::table('notes')->delete($note_id);

        // $id_candidat = $request->input('candidat_id');
        // updateMoyenne($id_candidat);
        $notes = DB::table('notes')
        ->join('matieres','matieres.id','=','notes.matiere_id')
        ->where('notes.candidat_id',$candidat_id)
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

        DB::table('releves')
            ->where('candidat_id', $candidat_id)
            ->update(['moyenne' => $moy]);
        return response()->json([
            'status'=>200,
            'message'=>'Note supprimée avec succès !',
        ]);
    }
}
