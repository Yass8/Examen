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
                        <h4>Examens
                            <a href="" class="btn btn-info float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addExam">Ajouter</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Listes des Examens</h5>
                        
                    </div>
                    <div class="container">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Examens</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>

    

        
        <!-- Add eexam -->
        <div class="modal fade" id="addExam" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Ajoût d'un examen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <ul id="errorList"></ul>
                        <div class="container-fluid">
                            <div class="form-floating mb-3">
                                <input type="text" name="nom" class="nom form-control" id="nom" placeholder="nom">
                                <label for="nom">Nom de l'examen</label>
                              </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_add_exam btn btn-info" {{--onclick="ok()"--}}>Enregistrer</button>
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
                                <input type="text" class="editnom form-control" id="nom" placeholder="nom">
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
                            <h5>Vous êtes sûre de la suppression de ce donnée ?</h5> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_sup_exam btn btn-info" {{--onclick="ok()"--}}>Oui supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            var modelId = document.getElementById('addExam');
        
            modelId.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  let button = event.relatedTarget;
                  // Extract info from data-bs-* attributes
                  let recipient = button.getAttribute('data-bs-whatever');
        
                // Use above variables to manipulate the DOM
            });
        </script>
        
@endsection

@section('scriptJs')
    <script>
        
        
        $(document).ready(function () {
            
        //select  
        listeExam();
        function listeExam()
        {
            $.ajax({
                type: "GET",
                url: "/examList",
                dataType: "json",
                success: function (response) {
                    var i = 0;
                    $('tbody').html("");
                    $.each(response.examens, function (key, item){
                        i = i+1;
                        $('tbody').append('<tr>\
                            <td>'+i+'</td>\
                            <td>'+item.nom_examen+'</td>\
                            <td><a href="/examens/'+item.reference_exam+'" class="acces btn btn-primary btn-sm">Acceder</a></td>\
                        </tr>');
                    }); 
                }
            });
        }   
        /*<td><button type="button" value="'+item.id+'" class="delete_btn btn btn-danger btn-sm">Supprimer</button> | \
                                <button type="button" value="'+item.id+'" class="edit_btn btn btn-warning btn-sm">Modifier</button></td>\*/
            //show modal to edit
            /*$(document).on('click', '.edit_btn', function(e){
                e.preventDefault();
                var exm_id = $(this).val();
                $('#errorListEdit').html("");
                $('#edit_exam_id').val(exm_id);
                $('#ModalEditExam').modal('show');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/examens/"+$('#edit_exam_id').val()+"/edit",
                    dataType: "json",
                    success: function(response) {
                        //console.log(response);
                        $('.editnom').val(response.exam.nom_examen);
                    }
                });
                
            });*/


            //update 
            $(document).on('click', '.btn_edit_exam', function(e){
                e.preventDefault();
                var exam_id = $('#edit_exam_id').val();
                // var nom = $('.editnom').val();
                var data = { 'nom': $('.editnom').val() };

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
                            listeExam();
                        }
                    }
                });
            });

            //show modal to delete
            $(document).on('click', '.delete_btn', function(e){
                e.preventDefault();
                var exam_id = $(this).val();
                $('#delete_exam_id').val(exam_id);
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
                        listeExam();
                    }
                });
            });



            //insert    
            $(document).on('click', '.btn_add_exam', function(e){
                e.preventDefault();
                // console.log('ok');
                var data = { 'nom': $('.nom').val() };
                // console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/examens",
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
                            $('#addExam').modal('hide');
                            $('#addExam').find('input').val("");
                            listeExam();
                        }
                    }
                });
            });
            
        });
    </script>
@endsection

@section('menu')
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container-fluid">
      <a class="navbar-brand text-danger" href="#" style="font-family: montserrat">Examen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{route('examens.index')}}">Examens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('classes.index')}}">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('matieres.index')}}">Matières</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('candidats.index')}}">Candidats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('parametre')}}">Paramètres</a>
          </li>
        </ul>
        <div class="d-flex">
          <input class="form-control me-2" type="texy" value="Yassir Ali" disabled>
          <a class="btn btn-outline-success" href="">Deconnexion</a>
        </div>
      </div>
    </div>
  </nav>
@endsection