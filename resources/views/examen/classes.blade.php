@extends('examen.home')
@section('titre', 'Classes')
{{-- @section('description', 'Mon tableau de bord') --}}

@section('menu-header')
<div class="container header"> 
    <h1 class="page-header">
        Classes
    </h1>
    
  <a href="#">Home</a>
    <a href="">Classes</a>
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
                        <h4>Classes
                            <a href="" class="btn btn-info float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addCla">Ajouter</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Listes des classes</h5>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="ex">Examens</label>
                              <select class="form-control" name="" id="ex">
                              <option value="sel">Selectionner l'examen</option>
                                @foreach ($exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->nom_examen}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                    <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>N°</th>
                            <th>Classes</th>
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

    

        
        <!-- Modal d'ajout -->
        <div class="modal fade" id="addCla" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Ajoût d'une classe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul id="errorList"></ul>
                                <div class="container-fluid">
                                    <div class="form-group mb-3">
                                        <label for="ex">Examens</label>
                                        <select class="examen form-control" name="" id="ex">
                                          @foreach ($exams as $exam)
                                              <option value="{{$exam->id}}">{{$exam->nom_examen}}</option>
                                          @endforeach
                                        </select>
                                      </div>
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
        
        <!-- Modal Delete classe -->
        <div class="modal fade" id="deleteClasse" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                      <div class="modal-header">
                              <h5 class="modal-title">Suppression d'une classe</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                  <div class="modal-body">
                      <input type="hidden" id="delete_classe_id">
                      <div class="p-3 text-center">
                          <h6>Vous êtes sûre de la suppression de ce donnée ?</h6> 
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                      <button type="button" class="btn_sup_classe btn btn-info" {{--onclick="ok()"--}}>Oui supprimer</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Modal edit classe -->
      <div class="modal fade" id="modalEditClasse" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Modification d'une matière</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                <div class="modal-body">
                  <input type="hidden" id="IDClasse">
                  <ul id="errorListEdit"></ul>
                    <div class="container-fluid">
                        <div class="form-group mb-3">
                            <label for="selectExamen">Examens</label>
                            <select class="exam form-control" name="" id="selectExamen">
                              {{-- <option>BEPC</option>
                              <option>BACCALAUREAT</option> --}}
                              @foreach ($exams as $exam)
                                  <option value="{{ $exam->id }}">{{ $exam->nom_examen }}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="name form-control" id="nomEdit" placeholder="nom">
                            <label for="nomEdit">Nom de la classe</label>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn_edit_classe btn btn-info">Modifier</button>
                </div>
            </div>
        </div>
    </div>
        <script>
            var modelId = document.getElementById('addCla');
        
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
        $(document).ready(function(){
         
         //affiche modal to edit
    $(document).on('click', '.edit_btn', function(e){
      e.preventDefault();
      // e.stopPropagation();
      var idEdit= $(this).val();
      $('#IDClasse').val(idEdit);
      $('#errorListEdit').html("");
      // const id = String(e.target.value).trim()

      // console.log(id);

      $('#modalEditClasse').modal('show');
      // $('#selectExam').val(id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // console.log(idEdit);

      $.ajax({
          type: "GET",
          url: "/classes/"+idEdit+"/edit",
          dataType: "json",
          success: function(response) {
              // console.log(response);
               $('#selectExamen').val(response.classe.exam_id);

              $('#nomEdit').val(response.classe.nom_classe);
          }
      });

    });
         
    //UPDATE CLASSE
    $(document).on('click','.btn_edit_classe', function(e){
      e.preventDefault();
      var classe_id = $('#IDClasse').val();
      // var nom = $('.editnom').val();
      var data = { 
        'nom_classe': $('#nomEdit').val(),
        'examen':$('#selectExamen').val(),
      };

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "PUT",
          url: "/classes/"+classe_id,
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
                  $('#errorListEdit').addClass('');

                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message);
                  $('#modalEditClasse').modal('hide');
                  $('#modalEditClasse').find('input').val("");
                  listeClasses();
              }
          }
      });

    });
         
          //select  
         listeClasses();
        function listeClasses()
        {
          // Script for select Composante
    const selectTarget = document.querySelector('select#ex')
    // const tableTarget = document.querySelector('#table_services')
    if (selectTarget!=null) {
    selectTarget.addEventListener('change', function(event) {
      event.preventDefault()
      event.stopPropagation()
      const id = String(event.target.value).trim()
      // console.log(id);
      if(id != '' && id !='sel'){
        // $.ajaxSetup({
        //   headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //   }
        // });
        $.ajax({
          type: "GET",
          url: "/getClassesByExam/"+id,
          dataType: "json",
          success: function(response){
            var i = 0;
            $('tbody').html("");
            $.each(response.classes, function (key, item){
                i = i+1;
                $('tbody').append('<tr>\
                  <td>'+i+'</td>\
                  <td>'+item.nom_classe+'</td>\
                  <td><a href="/classes/'+item.id+'" class="info_btn btn btn-sm btn-info">Info&&Resultat</a> | \
                    <button type="button" value="'+item.id+'" class="edit_btn btn btn-sm btn-warning">Modifier</button> | \
                  <button type="button" value="'+item.id+'" class="delete_btn btn btn-danger btn-sm">Supprimer</button></td>\
                </tr>');
            });
          }
        });
      }
    })
    }
  }
        //show modal to delete
        $(document).on('click', '.delete_btn', function(e){
                e.preventDefault();
                var classe_id = $(this).val();
                $('#delete_classe_id').val(classe_id);
                $('#deleteClasse').modal('show');
            });

        //delete 
        $(document).on('click', '.btn_sup_classe', function(e){
                e.preventDefault();

                var classe_id = $('#delete_classe_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/classes/"+classe_id,
                    success: function(response) {
                        // console.log(response);
                        
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#deleteClasse').modal('hide');
                        listeClasses();
                    }
                });
            });

        //INSERT
        $(document).on('click', '.btn_ajout', function(event){
            event.preventDefault();
            // var nom = $('.nom_add').val();
            // var exam = $('.examen').val();
            var data = { 
              'examen': $('.examen').val(),
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
                        listeClasses();
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
            <a class="nav-link" href="{{route('examens.index')}}">Examens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{route('classes.index')}}">Classes</a>
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