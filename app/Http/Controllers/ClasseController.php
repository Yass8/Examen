<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Classe;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = DB::table('exams')->orderBy('nom_examen','ASC')->get();
        return view('examen.classes', compact('exams'));
        
    }

    public function classeList(){
        
        $classes = DB::table('classes')->orderBy('nom_classe','ASC')->get();
        return response()->json([
            'classes' => $classes
        ]);
    }

    public function getClassesByExam($id){
        $classes = DB::table('classes')->where('exam_id',$id)->orderBy('nom_classe','ASC')->get();
        return response()->json([
            'classes' => $classes
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
            'examen' => 'required',
            'nom_classe' => 'required|min:3'
        ]);
        if($valid->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $valid->messages(),
            ]);
        }else{
            $maxId = Classe::max('id');
            // dd($maxId);
            $reference = 0;
            if(isset($maxId) && !is_null($maxId)){
                $reference = $maxId + 1;
            }else{
                $reference = 1;
            }
            $classe = new Classe();
            $classe->reference_classe = Hash::make($reference.'Cl');
            $classe->nom_classe = $request->input('nom_classe');
            $classe->exam_id = $request->input('examen');   
            $classe->save();
            return response()->json([
                'status' => 200,
                'message' => 'Classe ajoutée avec succès !',
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
        $classe = DB::table('exams')
        ->join('classes','exams.id','=','classes.exam_id')
        ->where('classes.id',$id)
        ->select('exams.*','classes.*')
        ->first();
        $listes = DB::table('candidats')->where('classe_id',$id)->orderBy('nom_candidat','ASC')->get();
        $nombreCandidat = count($listes);
        
        $listeAdmis = DB::table('releves')
        ->join('candidats','releves.candidat_id','=','candidats.id')
        ->where('releves.classe_id',$id)->where('releves.moyenne','>',9)
        ->select('releves.*','candidats.*')
        ->orderBy('candidats.nom_candidat','ASC')
        ->get();
        $nombreCandidatAdmis = count($listeAdmis);
        $pourAdmis = 0;
        try {    
            $pourAdmis = number_format(($nombreCandidatAdmis/$nombreCandidat)*100,2);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $listeAuto = DB::table('releves')
        ->join('candidats','releves.candidat_id','=','candidats.id')
        ->where('releves.classe_id',$id)->where('moyenne','>',7)->where('moyenne','<',10)
        ->select('releves.*','candidats.*')
        ->orderBy('candidats.nom_candidat','ASC')
        ->get();
        $nombreCandidatAuto = count($listeAuto);
        $pourAuto = 0;
        try {    
            $pourAuto = number_format(($nombreCandidatAuto/$nombreCandidat)*100,2);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $listeRefus = DB::table('releves')
        ->join('candidats','releves.candidat_id','=','candidats.id')
        ->where('releves.classe_id',$id)->where('releves.moyenne','<',8)
        ->select('releves.*','candidats.*')
        ->orderBy('candidats.nom_candidat','ASC')
        ->get();
        $nombreCandidatRefus = count($listeRefus);
        $pourRefus = 0;
        try {    
            $pourRefus = number_format(($nombreCandidatRefus/$nombreCandidat)*100,2);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('examen.resultats', compact('listeAdmis','listeAuto','listeRefus','pourRefus','nombreCandidatRefus','pourAuto','nombreCandidatAuto','nombreCandidatAdmis','pourAdmis','classe','nombreCandidat','listes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Classe::find($id);
        
        return response()->json([
            
            'classe'=>$class,
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
            'nom_classe'=>'required|max:50|min:3',
            'examen' =>'required'
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $classe = Classe::find($id);
            $classe->nom_classe = $request->input('nom_classe');
            $classe->exam_id = $request->input('examen');
            $classe->update();

            return response()->json([
                'status' => 200,
                'message' => 'Classe modifiée avec succès !',
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
        $classe = Classe::find($id);
        $classe->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Classe supprimée avec succès !',
        ]);
    }
}
