<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classe;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = DB::table('classes')->orderBy('nom_classe','ASC')->get();
        //$matieres = Matiere::all();

        return view('examen.matieres', compact('classes'));

    }

    public function getMatieresByExam($id){
       
            return response()->json([
                'matieres' => DB::table('matieres')->where('classe_id',$id)->orderBy('nom_matiere','ASC')->get()
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
            'coef' => 'required',
            'nom_matiere' => 'required|min:3'
        ]);
        if($valid->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valid->messages(),
            ]);
        }else{
            
            $matiere = new Matiere();
            $matiere->reference_matiere = uniqid();
            $matiere->nom_matiere = $request->input('nom_matiere');
            $matiere->coef = $request->input('coef');
            $matiere->classe_id = $request->input('classe');   
            $matiere->save();
            return response()->json([
                'status' => 200,
                'message' => 'Matière ajoutée avec succès !',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mat = Matiere::find($id);
        
        return response()->json([
            
            'matiere'=>$mat,
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
            'nom_matiere'=>'required|max:50|min:3',
            'coef' =>'required'
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $m = Matiere::find($id);
            $m->nom_matiere = $request->input('nom_matiere');
            $m->coef = $request->input('coef');
            $m->update();

            return response()->json([
                'status' => 200,
                'message' => 'Matière modifiée avec succès !',
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
        $ma = Matiere::find($id);
        $ma->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Matière supprimée avec succès !',
        ]);
    }
}
