@extends('examen.home')
@section('titre', 'Examens')
{{-- @section('description', 'Mon tableau de bord') --}}

@section('menu-header')
<div class="container header"> 
    <h1 class="page-header">
        Candidats
    </h1>
    
  <a href="#">Home</a>
    <a href="">Candidats</a>
  <a href="" class="active">Données</a>

                
</div>
@endsection
@section('content')
    <!-- /. ROW  --> 

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>{{$exam->nom_examen}}
                            <a href="" data-nom="{{$exam->nom_examen}}" data-id="{{$exam->id}}" class="delete_btn btn btn-outline-danger float-end btn-sm m-1">Suprimer</a>
                            <a href="" data-nom="{{$exam->nom_examen}}" data-id="{{$exam->id}}" class="edit_btn btn btn-outline-info float-end btn-sm m-1">Modifier</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Listes des Classes de {{$exam->nom_examen}}</h5>
                        
                    </div>
                    <div class="container">
                    <a href="" class="btn btn-info btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#addCla">Ajouter une classe</a>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Classes</th>
                                <th>Nombre des Candidats</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($classes as $classe)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$classe->nom_classe}}</td>
                                <td>{{Illuminate\Support\Facades\DB::table('candidats')->where('classe_id',$classe->id)->count(); }}</td>
                                <td><a href="{{ route('classes.show', $classe->reference_classe) }}" class="btn btn-outline-info btn-sm">Voir</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Edit exam -->
        <div class="modal fade" id="ModalEditExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Modification d'un examen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <ul id="errorListEdit"></ul>
                        <input type="hidden" id="edit_exam_id">
                        <div class="container-fluid">
                            <div class="form-floating mb-3">
                                <input type="text" class="editnomInput form-control" id="nom" placeholder="nom">
                                <label for="nom">Nom de l'examen</label>
                              </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_edit_exam btn btn-info">Modifier</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete exam -->
        <div class="modal fade" id="deleteExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Suppression d'un examen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_exam_id">
                        <div class="p-3 text-center">
                            <p class="warniig"></p>
                            <p>Vous allez perdre toutes les données concernant l'examen.</p> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_sup_exam btn btn-info" {{--onclick="ok()"--}}>Oui supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Modal d'ajout d'une classe-->
        <div class="modal fade" id="addCla" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Ajoût d'une classe de l'examen {{$exam->nom_examen}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul id="errorList"></ul>
                                <div class="container-fluid">
                                    <input type="hidden" class="form-control ExamenId" value="{{$exam->id}}">
                                    
                                    <div class="form-floating mb-3">
                                        <input type="text" class="nom_add form-control" id="nom_add" placeholder="nom">
                                        <label for="nom_add">Nom de la classe</label>
                                      </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn_ajout btn btn-info">Enregistrer</button>
                            </div>
                </div>
            </div>
        </div>
@endsection

@section('scriptJs')
    <script>
        
        
        $(document).ready(function () {
            $(document).on('click', '.edit_btn', function(e){
                e.preventDefault();
                var btnEdit = document.querySelector('.edit_btn');
                let idExam = btnEdit.dataset.id;
                let nomExam = btnEdit.dataset.nom;
                
                $('#errorListEdit').html("");
                $('#edit_exam_id').val(idExam);
                $('.editnomInput').val(nomExam);
                $('#ModalEditExam').modal('show');
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $.ajax({
                //     type: "GET",
                //     url: "/examens/"+$('#edit_exam_id').val()+"/edit",
                //     dataType: "json",
                //     success: function(response) {
                //         //console.log(response);
                //         $('.editnom').val(response.exam.nom_examen);
                //     }
                // });
                
            });


            //update 
            $(document).on('click', '.btn_edit_exam', function(e){
                e.preventDefault();
                var exam_id = $('#edit_exam_id').val();
                // var nom = $('.editnom').val();
                var data = { 'nom': $('.editnomInput').val() };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: "/examens/"+exam_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        //console.log(response);
                        if(response.status == 400){
                            $('#errorListEdit').html("");
                            $('#errorListEdit').addClass('alert alert-danger');

                            $.each(response.erreurs, function(key, err_values) {
                                $('#errorListEdit').append('<li>'+err_values+'</li>');
                            });
                        }else{
                            $('#errorListEdit').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#ModalEditExam').modal('hide');
                            $('#ModalEditExam').find('input').val("");
                            location.reload();
                        }
                    }
                });
            });

            //show modal to delete
            $(document).on('click', '.delete_btn', function(e){
                e.preventDefault();
                var exam_id = $(this).val();

                var btnDEL = document.querySelector('.edit_btn');
                let idExam = btnDEL.dataset.id;
                let nomExam = btnDEL.dataset.nom;
                
                
                $('#delete_exam_id').val(idExam);
                $('.warniig').html("Vous êtes sûre de la suppression <b>"+nomExam+"</b>  ?");

                
                $('#deleteExam').modal('show');
            });
            //delete 
            $(document).on('click', '.btn_sup_exam', function(e){
                e.preventDefault();

                var exam_id = $('#delete_exam_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/examens/"+exam_id,
                    success: function(response) {
                        // console.log(response);
                        
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#deleteExam').modal('hide');
                        window.location.href = "/examens";

                    }
                });
            });
            

            //AJOUT D UNE CLASSE
        $(document).on('click', '.btn_ajout', function(event){
            event.preventDefault();
            var data = { 
              'examen': $('.ExamenId').val(),
              'nom_classe': $('.nom_add').val()
            };
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/classes",
                data: data,
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    if(response.status == 400)
                    {
                        $('#errorList').html("");
                        $('#errorList').addClass('alert alert-danger');

                        $.each(response.errors, function(key, err_values) {
                            $('#errorList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else
                    {
                        $('#errorList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#addCla').modal('hide');
                        $('#addCla').find('input').val("");
                        
                        location.reload();
                    }
                }
            });

        });
        });
    </script>
@endsection