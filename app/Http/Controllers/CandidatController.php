<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Releve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = DB::table('classes')->orderBy('nom_classe','ASC')->get();
        
        return view('examen.candidats', compact('classes'));

    }

    public function getCandidatsByExam($id){
        return response()->json([
            'candidats' => DB::table('candidats')->where('classe_id',$id)->orderBy('nom_candidat','ASC')->get()
        ]);
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
            'classe' => 'required',
            'nom_candidat' => 'required|min:3'
        ]);
        if($valid->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $valid->messages(),
            ]);
        }else{
            $maxId = Candidat::max('id');
          
            $reference = 0;
            if(isset($maxId) && !is_null($maxId)){
                $reference = $maxId + 1;
            }else{
                $reference = 1;
            }
            $c = new Candidat();
            $c->reference_candidat = Hash::make($reference.'can');
            $c->nom_candidat = $request->input('nom_candidat');
            $c->classe_id = $request->input('classe');   
            $c->save();
            $der = Candidat::max('id');
            $can = DB::table('candidats')->where('id',$der)->first();
            $rel = new Releve();
            $rel->candidat_id = $der;
            $rel->classe_id = $can->classe_id;
            $rel->save();

            return response()->json([
                'status' => 200,
                'message' => 'Candidat(e) ajouté(e) avec succès !',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidat = DB::table('candidats')
        ->join('classes','candidats.classe_id','=','classes.id')
        ->join('exams','classes.exam_id','=','exams.id')
        ->where('candidats.id',$id)
        ->select('classes.id as idClasse','classes.nom_classe','candidats.*','candidats.id as IdCandidat','exams.*')
        ->first();

        $idClasse = $candidat->classe_id;
        $matieres = DB::table('matieres')->where('classe_id', $idClasse)->get();
        return view('examen.info', compact('candidat','matieres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c = Candidat::find($id);
        
        return response()->json([
            
            'candidat'=>$c,
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
            'nom_candidat'=>'required|max:50|min:3',
            'classe' =>'required'
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $c = Candidat::find($id);
            $c->nom_candidat = $request->input('nom_candidat');
            $c->classe_id = $request->input('classe');
            $c->update();

            return response()->json([
                'status' => 200,
                'message' => 'Candidat(e) modifié(e) avec succès !',
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
        $ca = Candidat::find($id);
        $ca->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Candidat(e) supprimé(e) avec succès !',
        ]);
    }
}
