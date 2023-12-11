<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Releve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getCandidats($id){
        return response()->json([
            'candidats' => DB::table('candidats')->where('classe_id',$id)->orderBy('prenom_candidat','ASC')->get()
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
            'prenom_candidat' => 'required|min:2',
            'nom_candidat' => 'required|min:2'
        ]);
        if($valid->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $valid->messages(),
            ]);
        }else{
            
            $c = new Candidat();
            $c->reference_candidat = uniqid();
            $c->prenom_candidat = $request->input('prenom_candidat');
            $c->nom_candidat = $request->input('nom_candidat');
            $c->classe_id = $request->input('classe');   
            $c->save();
            $rel = new Releve();
            $rel->candidat_id = $c->id;
            $rel->classe_id = $c->classe_id;
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
        ->where('candidats.reference_candidat',$id)
        ->select('classes.id as idClasse','classes.nom_classe','candidats.*','candidats.id as IdCandidat','exams.*')
        ->first();

        $idClasse = $candidat->classe_id;
        $matieres = DB::table('matieres')->where('classe_id', $idClasse)->get();
        return view('examen.candidats.info', compact('candidat','matieres'));
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
            'prenom_candidat'=>'required|max:50|min:2',
            'nom_candidat'=>'required|max:50|min:2',
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $c = Candidat::find($id);
            $c->prenom_candidat = $request->input('prenom_candidat');
            $c->nom_candidat = $request->input('nom_candidat');
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
