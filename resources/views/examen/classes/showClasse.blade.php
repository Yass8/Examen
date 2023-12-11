@extends('examen.home')
@section('content')
    <!-- /. ROW  --> 

    <div class="container py-5">
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info btnAfficheListCandidat">Candidats</button>
                <button type="button" class="btn btn-outline-info btnAfficheListMatiere">Matières</button>
            </div>

            <input type="hidden" value="{{$classe->id}}" class="IDCLASSE">

            <div class="col-md-12 mt-3 divListCandidat">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des candidats de la classe de {{$classe->nom_classe}}
                            <a href="" class="btn btn-outline-dark float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addCandidat">Ajouter un candidat</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="table-responsive"
                        >
                            <table
                                class="table table-striped table-bordered"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tbListCand">
                                    @php
                                        $ij = 0;
                                    @endphp
                                    @foreach ($candidats as $cand)
                                    @php
                                        $ij++;
                                    @endphp
                                    <tr class="">
                                        <td>{{$ij}}</td>
                                        <td>{{$cand->prenom_candidat}}</td>
                                        <td>{{$cand->nom_candidat}}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary">Voir</button>
                                            <button type="button" class="btn btn-outline-warning">Edit</button>
                                            <button type="button" class="btn btn-outline-danger">Supprimer</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3 divListMatiere">
                <div id="success_message_mat"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Liste des matières de la classe de {{$classe->nom_classe}} 
                            <a href="" class="btn btn-outline-secondary float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addMat">Ajouter une matière</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="table-responsive"
                        >
                            <table
                                class="table table-striped table-bordered"
                            >
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom de la matière</th>
                                        <th scope="col">Coef</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="tbListMat">
                                    <tr class="">
                                        <td>R1C1</td>
                                        <td>R1C2</td>
                                        <td>R1C3</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary">Voir</button>
                                            <button type="button" class="btn btn-outline-warning">Edit</button>
                                            <button type="button" class="btn btn-outline-danger">Supprimer</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- //LES MODALS --}}

    <!-- Modal Ajout matiere -->
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
                        <div class="form-floating mb-3">
                            <input type="text" class="nomMat form-control" id="floatingInput" placeholder="nom">
                            <label for="floatingInput">Nom de la matière</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" min="1" class="coef form-control" id="floatingInputCf" placeholder="coef">
                            <label for="floatingInputCf">Coefficient</label>
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

    <!-- Modal edit matiere  -->
    <div class="modal fade" id="modalEditMat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Modification d'une matière</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                <div class="modal-body">
                  <input type="hidden" id="IDMatiere">
                  <ul id="errorListEditMat"></ul>
                    <div class="container-fluid">
                        <input type="hidden" class="idMAT">
                        <div class="form-floating mb-3">
                            <input type="text" class="nameMat form-control" id="nomEditm" placeholder="nom">
                            <label for="nomEditm">Nom de la matiere</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="edit_coef form-control" id="nomcoef" placeholder="nom">
                            <label for="nomcoef">Coefficient</label>
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

    {{-- ------------------------------------------------------------------------------------ --}}
    <!-- Modal aJOUT CANDIDAT-->
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
                                <input type="hidden" class="classe" id="cl" value="{{ $classe->id }}">
                                <div class="form-floating mb-3">
                                    <input type="text" class="prenom_add form-control" id="floatingInput" placeholder="prénom">
                                    <label for="floatingInput">Prénom du candidat(e)</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="nom_add form-control" id="floatingInput2" placeholder="nom">
                                    <label for="floatingInput2">Nom du candidat(e)</label>
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

    <!-- Modal edit Candidat  -->
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
                        <div class="form-floating mb-3">
                            <input type="text" class="lastname form-control" id="prenomEdit" placeholder="prénom">
                            <label for="prenomEdit">Prénom du candidat(e)</label>
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

    <!-- Modal Delete candidat -->
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
    
@endsection
@section('scriptJs')
<script> 
    $(document).ready(function () {
        $(".divListMatiere").fadeOut();
        lesBoutons();
        listeCandidats();
        listeMatieres();

        //insert matiere
        $(document).on('click', '.btn_add_mat', function(e){
            e.preventDefault();
            var idClasse = $('.IDCLASSE').val();
            var data = { 
                'classe': idClasse,
                'nom_matiere': $('.nomMat').val(),
                'coef': $('.coef').val()
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
                    $('#success_message_mat').addClass('alert alert-success');
                    $('#success_message_mat').text(response.message);
                    $('#addMat').modal('hide');
                    $('#addMat').find('input').val("");
                    listeMatieres();
                }
                }
            });
            listeMatieres();
        });

        //affiche modal to edit
        $(document).on('click', '.edit_btn_mat', function(e){
            e.preventDefault();

            $('#modalEditMat').modal('show');

            var idEdit= $(this).val();
            $('.idMAT').val(idEdit);
            $('.nameMat').val($(this).data('nom_mat'));
            $('.edit_coef').val($(this).data('coef'));
            $('#errorListEditMat').html("");
        });

        //UPDATE MATIERE
        $(document).on('click','.btn_edit_mat', function(e){
            e.preventDefault();
            var mat_id = $('.idMAT').val();
            // var nom = $('.editnom').val();
            var data = { 
                'nom_matiere': $('.nameMat').val(),
                'coef': $('.edit_coef').val(),

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
                        $('#errorListEditMat').html("");
                        $('#errorListEditMat').addClass('alert alert-danger');

                        $.each(response.erreurs, function(key, err_values) {
                            $('#errorListEditMat').append('<li>'+err_values+'</li>');
                        });
                    }else{
                        $('#errorListEditMat').html("");
                        $('#errorListEditMat').addClass('');

                        $('#success_message_mat').addClass('alert alert-success');
                        $('#success_message_mat').text(response.message);
                        $('#modalEditMat').modal('hide');
                        $('#modalEditMat').find('input').val("");
                        listeMatieres();
                    }
                }
            });

        });

        //show modal to delete
        $(document).on('click', '.delete_btn_mat', function(e){
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
                        $('#success_message_mat').addClass('alert alert-success');
                        $('#success_message_mat').text(response.message);
                        $('#deleteMatiere').modal('hide');
                        listeMatieres();
                    }
                });
        });

        function listeMatieres(){
        
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            type: "GET",
            url: "/getMatieresByExam/"+$('.IDCLASSE').val(),
            dataType: "json",
            success: function(response){
                var i = 0;
                $('.tbListMat').html("");
                $.each(response.matieres, function (key, item){
                    i = i+1;
                    $('.tbListMat').append('<tr>\
                        <td>'+i+'</td>\
                        <td>'+item.nom_matiere+'</td>\
                        <td>'+item.coef+'</td>\
                        <td><button type="button" data-nom_mat="'+item.nom_matiere+'" data-coef="'+item.coef+'" value="'+item.id+'" class="edit_btn_mat btn btn-primary btn-sm">Modifier</button> | \
                        <button type="button" value="'+item.id+'" class="delete_btn_mat btn btn-danger btn-sm">Supprimer</button></td>\
                    </tr>');
                });
            }
            });
            
        }

        //show modal to delete
        $(document).on('click', '.delete_btn', function(e){
            e.preventDefault();
            var candida_id = $(this).val();
            $('#delete_candidat_id').val(candida_id);
            $('#deleteCandidat').modal('show');
        });

        //delete candidat
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

        //affiche modal to edit
        $(document).on('click', '.edit_btn', function(e){
            e.preventDefault();
            // e.stopPropagation();
            var idEdit= $(this).val();
            
            let prenom = $(this).data('prenom');
            let nom = $(this).data('nom');

            $('#IDCandidat').val(idEdit);
            $('.lastname').val(prenom);
            $('.name').val(nom);

            $('#errorListEdit').html("");
            // const id = String(e.target.value).trim()      
            $('#modalEditCandidat').modal('show');
        });

        //UPDATE Candidat
        $(document).on('click','.btn_edit_can', function(e){
            e.preventDefault();
            var candidat_id = $('#IDCandidat').val();
            // var nom = $('.editnom').val();
            var data = { 
                'prenom_candidat': $('#prenomEdit').val(),
                'nom_candidat': $('#nomEdit').val(),
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
        

        //INSERT CANDIDAT
        $(document).on('click', '.btn_ajout', function(event){
            event.preventDefault();
            var data = { 
              'classe': $('.classe').val(),
              'prenom_candidat': $('.prenom_add').val(),
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

        function listeCandidats()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var idClasse = $('.IDCLASSE').val();
            
            $.ajax({
                type: "GET",
                url: "/getCandidats/"+idClasse,
                dataType: "json",
                success: function(response){
                    var i = 0;
                    $('.tbListCand').html("");
                    $.each(response.candidats, function (key, item){
                        i = i+1;
                        $('.tbListCand').append('<tr>\
                        <td>'+i+'</td>\
                        <td>'+item.prenom_candidat+'</td>\
                        <td>'+item.nom_candidat+'</td>\
                        <td><a href="/candidats/'+item.reference_candidat+'" class="inf_btn btn btn-outline-primary">Voir</a> | \
                            <button type="button" data-prenom="'+item.prenom_candidat+'" data-nom="'+item.nom_candidat+'" value="'+item.id+'" class="edit_btn btn btn-outline-warning">Modifier</button> | \
                        <button type="button" value="'+item.id+'" class="delete_btn btn btn-outline-danger">Supprimer</button></td>\
                        </tr>');
                    });
                }
            });
        }


        function lesBoutons() {
            $(document).on('click', '.btnAfficheListCandidat', function(e){
            e.preventDefault();
            $(".divListCandidat").fadeIn();
            $(".divListMatiere").fadeOut();

            $(".btnAfficheListCandidat").removeClass("btn-outline-info");
            $(".btnAfficheListCandidat").addClass("btn-info");

            $(".btnAfficheListMatiere").removeClass("btn-info");
            $(".btnAfficheListMatiere").addClass("btn-outline-info");
            
        });
        $(document).on('click', '.btnAfficheListMatiere', function(e){
            e.preventDefault();
            $(".divListMatiere").fadeIn();
            $(".divListCandidat").fadeOut();
            
            $(".btnAfficheListMatiere").removeClass("btn-outline-info");
            $(".btnAfficheListMatiere").addClass("btn-info");

            $(".btnAfficheListCandidat").removeClass("btn-info");
            $(".btnAfficheListCandidat").addClass("btn-outline-info");
            
        });
        }
    });
</script>
@endsection