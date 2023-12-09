@extends('examen.home')
@section('titre', 'Candidats')

@section('content')
<input type="hidden" value="{{$candidat->IdCandidat}}" id="CANDIDAT_ID">
    <div class="container-fluid">
        <div class="row col-md-12 mt-5">
            <div id="success_message"></div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-center">
                      Information du candidat(e)
                    </div>
                    <div class="card-body">
                      <table class="table">
                          <tr>
                              <td>Candidat(e)</td>
                              <td>: <span class=""><b>{{$candidat->nom_candidat}}</b></span></td>
                          </tr>
                          <tr>
                            <td>Examen</td>
                            <td>: <span class=""><b>{{$candidat->nom_examen}}</b></span></td>
                        </tr>
                        <tr>
                            <td>Classe</td>
                            <td>: <span class=""><b>{{$candidat->nom_classe}}</b></span></td>
                        </tr>
                        <tr>
                            <td>Année</td>
                            <td>: <span class=""><b>2022</b></span></td>
                        </tr>
                      </table>
                      
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-center">
                      Notes du candidat(e)
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                            <tr>
                                <th>Matière</th>
                                <th>Note</th>
                                <th>Coef</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tb_liste">
                            {{-- <tr>
                                <td>Mathématique</td>
                                <td>10</td>
                                <td>4</td>
                                <td>40</td>
                                <td><button type="button" class="btn btn-primary btn-sm">m</button> | <button type="button" class="btn btn-danger btn-sm">s</button></td>
                            </tr> --}}
                        </tbody>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong></strong></td>
                            <td><strong><span id="SumCoefn"></span></strong></td>
                            <td><strong><span id="SumNoten"></span></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Moyenne</strong></td>
                            <td><strong><span id="Moyennen"></span></strong></td>
                        </tr>
                      </table>
                      <div class="text-center">
                        <a href="#impression" class="btnVoir btn btn-info btn-sm">Voir le rélevé</a>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-center">
                      Ajouter une note
                    </div>
                    <div class="card-body">
                        <p>Candidat : <b>{{$candidat->nom_candidat}}</b></p>
                        <ul id="errorList"></ul>
                        <input type="hidden" class="ref" value="{{$candidat->IdCandidat}}">
                        <label for="selectMatiere">Sélectionner la matière</label>
                        <select name="selectMatiere" class="form-control mb-3" id="selectMatiere">
                            @foreach ($matieres as $m)
                                <option value="{{$m->id}}">{{$m->nom_matiere}}</option>
                            @endforeach
                        </select>
                        <div class="form-floating mb-3">
                            <input type="number" min="0" class="laNote form-control" id="laNote" placeholder="nom">
                            <label for="laNote">Note</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" min="0" class="leCoef form-control" id="leCoef" placeholder="nom">
                            <label for="leCoef">Coefficient</label>
                        </div>
                        <div class="text-center">
                            <button class="btnAjout btn btn-info btn-sm">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divImpression">
        <div id="impression" class="impression card container col-md-12 p-5 mt-3">
            <div class="row">
                <div class="col-md-4 text-center">
                    <p>ASSOCIATION DES JEUNES POUR LE DEVELOPPEMENT DE NTSADJENI BARAKANI</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <h5>{{$candidat->nom_examen}}</h3>
                    <h6>{{$candidat->nom_classe}}</h6>
                    {{-- <p>Année : 2022</p> --}}
                    
                </div>
            </div>
            <div class="text-center">
                <h5>RELEVE DE NOTE</h5>
                <p>Obtenu(e) par : <strong>{{$candidat->nom_candidat}}</strong></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Epreuves</th>
                            <th>Note/20</th>
                            <th>Coefficient</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tb_releve">
                        <tr id="mat_releve">
                        </tr>
                        {{-- <tr>
                            <td>Arabe</td>
                            <td>11</td>
                            <td>2</td>
                            <td>22</td>
                        </tr> --}}
                        
                        
                    </tbody>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td style="background-color: darkgrey"></td>
                        <td><strong><span id="SumCoef"></span></strong></td>
                        <td><strong><span id="SumNote"></span></strong></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Moyenne générale</strong></td>
                                <td><strong><span id="Moyenne"></span></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <p>Decision du jury : <strong><span id="Jury"></span></strong></p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <p>Mention : <strong><span id="Mention"></span></strong></p>
                    
                </div>
            </div>
            <div class="text-center mt-5">Le Sécretaire</div>
        </div>

        <div class="text-center mt-3">
            <button onclick="imprimer('impression')" type="button" class="btn btn-info btn-sm">Imprimer en PDF</button>
        </div>
        </div>
        <div class="c"></div>

        <!-- Modal edit  -->
        <div class="modal fade" id="modalEditNote" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Modification d'une note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                    <div class="modal-body">
                      <input type="hidden" id="IDNote">
                      <ul id="errorListEdit"></ul>
                        <div class="container-fluid">
                            <div class="form-group mb-3">
                                <label for="selMatiere">Matières</label>
                                <select class="not form-control" name="" id="selMatiere">
                                  
                                    @foreach ($matieres as $m)
                                    <option value="{{$m->id}}">{{$m->nom_matiere}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" min="0" class="EditNote form-control" id="EditNote" placeholder="nom">
                                <label for="EditNote">Note</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" min="0" class="EditCoef form-control" id="EditCoef" placeholder="nom">
                                <label for="EditCoef">Coefficient</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn_edit_note btn btn-info">Modifier</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete  -->
      <div class="modal fade" id="deleteNote" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Suppression d'une note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_note_id">
                    <div class="p-3 text-center">
                        <h6>Vous êtes sûre de la suppression de ce donnée ?</h6> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn_sup_note btn btn-info">Oui supprimer</button>
                </div>
            </div>
        </div>
      </div>

    </div>
@endsection
@section('scriptJs')
<script>
    $(document).ready(function(){


    //show modal to delete
    $(document).on('click', '.BDelete', function(e){
        e.preventDefault();
        var n_id = $(this).val();
        $('#delete_note_id').val(n_id);
        $('#deleteNote').modal('show');
    });


    //delete 
    $(document).on('click', '.btn_sup_note', function(e){
            e.preventDefault();

            // var nt_id = $('#delete_note_id').val();
            // var data = { 
            //     'note_id': $('#delete_note_id').val(),
            //     'candidat_id' : $('#CANDIDAT_ID').val(),
            // };

            var note_id = $('#delete_note_id').val();
            var candidat_id = $('#CANDIDAT_ID').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: "/note/"+note_id+"/"+candidat_id,
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#deleteNote').modal('hide');
                    listeNotes();
                }
            });
    });

     //affiche modal to edit
     $(document).on('click', '.BEdit', function(e){
      e.preventDefault();
      var idEdit= $(this).val();
      $('#IDNote').val(idEdit);
      $('#errorListEdit').html("");

      $('#modalEditNote').modal('show');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type: "GET",
          url: "/notes/"+idEdit+"/edit",
          dataType: "json",
          success: function(response) {
              // console.log(response);
               $('#selMatiere').val(response.note.matiere_id);

              $('#EditNote').val(response.note.note);
              $('#EditCoef').val(response.note.coef);
          }
      });

    });

    //UPDATE Candidat
    $(document).on('click','.btn_edit_note', function(e){
      e.preventDefault();
      var note_id = $('#IDNote').val();
      var data = { 
        'note': $('#EditNote').val(),
        'coefficient': $('#EditCoef').val(),
        'matiere':$('#selMatiere').val(),
        'candidat_id' : $('#CANDIDAT_ID').val(),
      };

    //   console.log(note_id+" \n "+$('#EditNote').val()+" \n "+$('#EditCoef').val());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
          type: "PUT",
          url: "/notes/"+note_id,
          data: data,
          dataType: "json",
          success: function(response) {
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
                  $('#modalEditNote').modal('hide');
                  $('#modalEditNote').find('input').val("");
                  listeNotes();
              }
          }
      });

    });

    //Liste des notes
    listeNotes();
    function listeNotes(){
        var ref = $('.ref').val();
        $.ajax({
                type: "GET",
                url: "/notes/"+ref,
                dataType: "json",
                success: function (response) {
                    
                    $('#tb_liste').html("");$('#tb_releve').html("");
                    $('#SumCoef').html(response.sommeCoef);
                    $('#SumNote').html(response.sommeNote);
                    $('#Moyenne').html(response.moyenne);
                    $('#SumCoefn').html(response.sommeCoef);
                    $('#SumNoten').html(response.sommeNote);
                    $('#Moyennen').html(response.moyenne);
                    $('#Jury').html(response.jury);
                    $('#Mention').html(response.mention);



                    $.each(response.notes, function (key, item){
                        
                        $('#tb_liste').append('<tr>\
                            <td>'+item.nom_matiere+'</td>\
                                <td>'+item.note+'</td>\
                                <td>'+item.coef+'</td>\
                                <td>'+item.note*item.coef+'</td>\
                                <td><button type="button" value="'+item.idNote+'" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier" class="BEdit btn btn-outline-primary btn-sm text-info"><img src="{{asset("bootstrap-icons-1.8.1/pencil.svg")}}" alt=""></button> | \
                                    <button type="button" value="'+item.idNote+'" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer" class="BDelete btn btn-outline-danger btn-sm"><img src="{{asset("bootstrap-icons-1.8.1/trash.svg")}}" alt=""></button></td>\
                        </tr>');

                        $('#tb_releve').append('<tr>\
                            <td>'+item.nom_matiere+'</td>\
                                <td>'+item.note+'</td>\
                                <td>'+item.coef+'</td>\
                                <td>'+item.note*item.coef+'</td>\
                        </tr>');
                    }); 
                    
                }
            });
    }
    //Ajout une note
    $(document).on('click','.btnAjout', function(e){
        e.preventDefault();
        // console.log($('.laNote').val());
        // console.log($('.leCoef').val());
        // console.log($('#selectMatiere').val());
        var data = {
            'matiere' : $('#selectMatiere').val(),
            'note' : $('.laNote').val(),
            'coefficient' : $('.leCoef').val(),
            'reference' : $('.ref').val(),
            'candidat_id' : $('#CANDIDAT_ID').val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/notes",
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
                    // $('#addCandidat').modal('hide');
                    // $('#addCandidat').find('input').val("");
                    listeNotes();
                }
            }
        });


    });

    

});
</script>
<script>
    //impression
   // imprimer();
    function imprimer(impression){
        var restorepage=document.body.innerHTML;
        var printContent=document.getElementById(impression).innerHTML;
        
        document.body.innerHTML=printContent;
        window.print();
        document.body.innerHTML=restorepage;
    }

    //cache releve
    $(document).ready(function(){
        $(".divImpression").fadeOut(1, function(){
          $(".c").fadeIn(1000)
        });

        $(document).on('click', '.btnVoir', function(){
         $(".c").fadeOut(1, function(){
          $(".divImpression").fadeIn(1000)
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
          <form action="{{route('logout')}}" method="post">
           @csrf
          <button type="submit" class="btn btn-outline-success">Deconnexion</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
@endsection