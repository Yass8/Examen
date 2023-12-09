<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('examen.examens');
    }

    public function liste()
    {
        $examens = Exam::all();
        return response()->json([
            'examens'=>$examens,
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
        $validator = Validator::make($request->all(), [
            'nom'=>'required|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        } else {
            $maxId = Exam::max('id');
          
            $reference = 0;
            if(isset($maxId) && !isNull($maxId)){
                $reference = $maxId + 1;
            }else{
                $reference = 1;
            }
            
            $exam = new Exam();
            $exam->reference_exam = Hash::make($reference.'Exa');
            $exam->nom_examen = $request->input('nom');
            $exam->save();
            return response()->json([
                'status'=>200,
                'message'=>'Examen ajouté avec succès !',
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
        $exam = Exam::find($id);
        // $exam->delete();
        return response()->json([
            
            'exam'=>$exam,
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
            'nom'=>'required|max:50|min:3'
        ]);

        if($valider->fails()){
            return response()->json([
                'status' => 400,
                'erreurs' => $valider->messages(),
            ]);
        }else{
            $exam = Exam::find($id);
            $exam->nom_examen = $request->input('nom');
            $exam->update();

            return response()->json([
                'status' => 200,
                'message' => 'Examen modifié avec succès !',
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
        $exam = Exam::find($id);
        $exam->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Examen supprimé avec succès !',
        ]);
    }
}
