@extends('examen.home')
@section('titre', 'Candidats')
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
                        <h4>Candidats
                            <a href="" class="btn btn-info float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addCandidat">Ajouter</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Listes des candidats</h5>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="ex">Classes</label>
                              <select class="sel_classe_id form-control" name="" id="cl">
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
                            <th>Candidats</th>
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

    

        
        <!-- Modal -->
        <div class="modal fade" id="addCandidat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Ajoût d'un(e) candidat(e)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul id="errorList"></ul>
                                <div class="container-fluid">
                                    <div class="form-group mb-3">
                                        <label for="ex">Classes</label>
                                        <select class="classe form-control" name="" id="cl">
                                          @foreach ($classes as $classe)
                                              <option value="{{ $classe->id }}">{{ $classe->nom_classe }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="nom_add form-control" id="floatingInput" placeholder="nom">
                                        <label for="floatingInput">Nom du candidat(e)</label>
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
        
        <!-- Modal edit  -->
        <div class="modal fade" id="modalEditCandidat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                      <div class="modal-header">
                              <h5 class="modal-title">Modification d'un(e) candidat(e)</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                  <div class="modal-body">
                    <input type="hidden" id="IDCandidat">
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
                              <label for="nomEdit">Nom du candidat(e)</label>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                      <button type="button" class="btn_edit_can btn btn-info">Modifier</button>
                  </div>
              </div>
          </div>
      </div>
        
      <!-- Modal Delete  -->
      <div class="modal fade" id="deleteCandidat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Suppression d'un(e) candidat(e)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_candidat_id">
                    <div class="p-3 text-center">
                        <h6>Vous êtes sûre de la suppression de ce donnée ?</h6> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn_sup_candidat btn btn-info">Oui supprimer</button>
                </div>
            </div>
        </div>
    </div>

        <script>
            var modelId = document.getElementById('addCandidat');
        
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
         
          //show info du candidat
        $(document).on('click', '.info_btn', function(e){
                e.preventDefault();
                var ref_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/candidats/"+ref_id,
                });
            });

    //affiche modal to edit
    $(document).on('click', '.edit_btn', function(e){
      e.preventDefault();
      // e.stopPropagation();
      var idEdit= $(this).val();
      $('#IDCandidat').val(idEdit);
      $('#errorListEdit').html("");
      // const id = String(e.target.value).trim()

      // console.log(id);

      $('#modalEditCandidat').modal('show');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: "GET",
          url: "/candidats/"+idEdit+"/edit",
          dataType: "json",
          success: function(response) {
              // console.log(response);
               $('#selectClasse').val(response.candidat.classe_id);

              $('#nomEdit').val(response.candidat.nom_candidat);
          }
      });

    });
         
    //UPDATE Candidat
    $(document).on('click','.btn_edit_can', function(e){
      e.preventDefault();
      var candidat_id = $('#IDCandidat').val();
      // var nom = $('.editnom').val();
      var data = { 
        'nom_candidat': $('#nomEdit').val(),
        'classe':$('#selectClasse').val(),
      };
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: "PUT",
          url: "/candidats/"+candidat_id,
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
                  $('#modalEditCandidat').modal('hide');
                  $('#modalEditCandidat').find('input').val("");
                  listeCandidats();
              }
          }
      });

    });
         
          //select  
         listeCandidats();
        function listeCandidats()
        {
          // Script for select Composante
    const selectTarget = document.querySelector('select#cl')
    // const tableTarget = document.querySelector('#table_services')
    if (selectTarget!=null) {
    selectTarget.addEventListener('change', function(event) {
      event.preventDefault()
      event.stopPropagation()
      const id = String(event.target.value).trim()
      // console.log(id);
      if(id != '' && id !='sel'){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "GET",
          url: "/getCandidatsByExam/"+id,
          dataType: "json",
          success: function(response){
            var i = 0;
            $('tbody').html("");
            $.each(response.candidats, function (key, item){
                i = i+1;
                $('tbody').append('<tr>\
                  <td>'+i+'</td>\
                  <td>'+item.nom_candidat+'</td>\
                  <td><a href="/candidats/'+item.id+'" class="inf_btn btn btn-sm btn-info">Info</a> | \
                    <button type="button" value="'+item.id+'" class="edit_btn btn btn-sm btn-success">Modifier</button> | \
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
            var candida_id = $(this).val();
            $('#delete_candidat_id').val(candida_id);
            $('#deleteCandidat').modal('show');
        });

        //delete 
        $(document).on('click', '.btn_sup_candidat', function(e){
                e.preventDefault();

                var can_id = $('#delete_candidat_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/candidats/"+can_id,
                    success: function(response) {
                        // console.log(response);
                        
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#deleteCandidat').modal('hide');
                        listeCandidats();
                    }
                });
        });

        //INSERT
        $(document).on('click', '.btn_ajout', function(event){
            event.preventDefault();
            var data = { 
              'classe': $('.classe').val(),
              'nom_candidat': $('.nom_add').val()
            };
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/candidats",
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
                        $('#addCandidat').modal('hide');
                        $('#addCandidat').find('input').val("");
                        listeCandidats();
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
            <a class="nav-link" href="{{route('classes.index')}}">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('matieres.index')}}">Matières</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{route('candidats.index')}}">Candidats</a>
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