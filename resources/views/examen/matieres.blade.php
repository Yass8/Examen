@extends('examen.home')
@section('titre', 'Matières')
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
                        <h4>Matières
                            <a href="" class="btn btn-info float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addMat">Ajouter</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Listes des matières</h5>
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="exa">Classes</label>
                              <select class="sel_exam_id form-control" name="" id="exa">
                                <option value="sel" class="btn_select">Selectionner une classe</option>
                                @foreach ($classes as $classe)
                                      <option value="{{ $classe->id }}" class="btn_select">{{ $classe->nom_classe }}</option>
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
                            <th>Matière</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                          {{-- <php $j = 0; ?>
                          @foreach ($matieres as $matiere)
                          <php $j = $j+1; ?>
                          <tr>
                            <td>{{ $j }}</td>
                            <td>{{ $matiere->nom }}</td>
                            <td><button type="button"
                             onclick='
                             {{--document.getElementById("selectExam").value="{{ $matiere->id }}";-}}document.getElementById("nomEdit").value="{{ $matiere->nom }}"' value="{{ $matiere->id }}" class="edit_btn btn btn-primary btn-sm">Modifier</button> | 
                              <button type="button" value="{{ $matiere->id }}" class="delete_btn btn btn-danger btn-sm">Supprimer</button></td>
                          </tr>
                          @endforeach --}}
                        
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>

    

        
        <!-- Modal -->
        <div class="modal fade" id="addMat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Ajoût d'une matière</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                    <div class="modal-body">
                      <ul id="errorListAdd"></ul>
                        <div class="container-fluid">
                            <div class="form-group mb-3">
                                <label for="ex">Classes</label>
                                <select class="exam form-control" name="" id="ex">
                                  @foreach ($classes as $classe)
                                      <option value="{{ $classe->id }}">{{ $classe->nom_classe }}</option>
                                  @endforeach
                                </select>
                              </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="name form-control" id="floatingInput" placeholder="nom">
                                <label for="floatingInput">Nom de la matière</label>
                              </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_add_mat btn btn-info">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit  -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                      <div class="modal-header">
                              <h5 class="modal-title">Modification d'une matière</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                  <div class="modal-body">
                    <input type="hidden" id="IDMatiere">
                    <ul id="errorListEdit"></ul>
                      <div class="container-fluid">
                          <div class="form-group mb-3">
                              <label for="selectClasse">Classes</label>
                              <select class="classe form-control" name="" id="selectClasse">
                                
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom_classe }}</option>
                                @endforeach
                              </select>
                            </div>
                          <div class="form-floating mb-3">
                              <input type="text" class="name form-control" id="nomEdit" placeholder="nom">
                              <label for="nomEdit">Nom de la matiere</label>
                            </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                      <button type="button" class="btn_edit_mat btn btn-info">Enregistrer</button>
                  </div>
              </div>
          </div>
      </div>
        
      <!-- Modal Delete matiere -->
      <div class="modal fade" id="deleteMatiere" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Suppression d'une matière</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_matiere_id">
                    <div class="p-3 text-center">
                        <h6>Vous êtes sûre de la suppression de ce donnée ?</h6> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn_sup_matiere btn btn-info">Oui supprimer</button>
                </div>
            </div>
        </div>
    </div>
        <script>
            var modelId = document.getElementById('addMat');
        
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

    listeMatieres();
    function listeMatieres(){
      //selection affichage
    // Script for select Composante
    const selectTarget = document.querySelector('select#exa')
    // const tableTarget = document.querySelector('#table_services')
    if (selectTarget!=null) {
    selectTarget.addEventListener('change', function(event) {
      event.preventDefault()
      event.stopPropagation()
      const id = String(event.target.value).trim()
      // console.log(id);
      if(id != '' && id!='sel'){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: "/getMatieresByExam/"+id,
          dataType: "json",
          success: function(response){
            var i = 0;
            $('tbody').html("");
            $.each(response.matieres, function (key, item){
                i = i+1;
                $('tbody').append('<tr>\
                    <td>'+i+'</td>\
                    <td>'+item.nom_matiere+'</td>\
                    <td><button type="button" value="'+item.id+'" class="edit_btn btn btn-primary btn-sm">Modifier</button> | \
                      <button type="button" value="'+item.id+'" class="delete_btn btn btn-danger btn-sm">Supprimer</button></td>\
                </tr>');
            });
          }
        });

          // console.log(id);
        
      }
    })
    }
    }

    //affiche modal to edit
    $(document).on('click', '.edit_btn', function(e){
      e.preventDefault();
 

      $('#modalEdit').modal('show');

      var idEdit= $(this).val();
      $('#IDMatiere').val(idEdit);
      $('#errorListEdit').html("");

      $('#modalEdit').modal('show');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // console.log(idEdit);

      $.ajax({
          type: "GET",
          url: "/matieres/"+idEdit+"/edit",
          dataType: "json",
          success: function(response) {
              // console.log(response);
               $('#selectClasse').val(response.matiere.classe_id);

              $('#nomEdit').val(response.matiere.nom_matiere);
          }
      });

    });
    
    //UPDATE MATIERE
    $(document).on('click','.btn_edit_mat', function(e){
      e.preventDefault();
      var mat_id = $('#IDMatiere').val();
      // var nom = $('.editnom').val();
      var data = { 
        'nom_matiere': $('#nomEdit').val(),
        'classe':$('#selectClasse').val(),
      };

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "PUT",
          url: "/matieres/"+mat_id,
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
                  $('#modalEdit').modal('hide');
                  $('#modalEdit').find('input').val("");
                  listeMatieres();
              }
          }
      });

    });

    //insert
    $(document).on('click', '.btn_add_mat', function(e){
      e.preventDefault();

      var data = { 
        'classe': $('.exam').val(),
        'nom_matiere': $('.name').val()
      };
      // console.log(data);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // console.log(data);
      $.ajax({
        type: "POST",
        url: "/matieres",
        data: data,
        dataType: "json",
        success: function(response) {
          // console.log(response);
          if(response.status == 400){
            $('#errorListAdd').html("");
            $('#errorListAdd').addClass('alert alert-danger');
            
            $.each(response.erreurs, function(key, erreu_values) {
                $('#errorListAdd').append('<li>'+erreu_values+'</li>');
            });
          }else{
            $('#errorListAdd').html("");
            $('#success_message').addClass('alert alert-success');
            $('#success_message').text(response.message);
            $('#addMat').modal('hide');
            $('#addMat').find('input').val("");
            listeMatieres();
          }
        }
      });
      listeMatieres();
    });

    //show modal to delete
    $(document).on('click', '.delete_btn', function(e){
        e.preventDefault();
        var matiere_id = $(this).val();
        $('#delete_matiere_id').val(matiere_id);
        $('#deleteMatiere').modal('show');
    });

    //delete 
    $(document).on('click', '.btn_sup_matiere', function(e){
            e.preventDefault();

            var matiere_id = $('#delete_matiere_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/matieres/"+matiere_id,
                success: function(response) {                    
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#deleteMatiere').modal('hide');
                    listeMatieres();
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
            <a class="nav-link" href="{{route('classes.index')}}">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{route('matieres.index')}}">Matières</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('candidats.index')}}">Candidats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{route('parametre')}}">Paramètres</a>
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