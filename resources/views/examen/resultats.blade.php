@extends('examen.home')
@section('titre', $classe->nom_classe)
{{-- @section('description', 'Mon tableau de bord') --}}
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-center">
                    Statistique du {{$classe->nom_examen}}
                </div>
                <div class="card-body">
                    Classe : <strong><span>{{$classe->nom_classe}}</span></strong>
                    <p>Sur <strong><span>{{$nombreCandidat}}</span></strong> candidats :</p>
                    <ul>
                        <li><strong>{{$nombreCandidatAdmis}} admis</strong>  soit <strong>{{$pourAdmis}}</strong>%</li>
                        <li><strong>{{$nombreCandidatAuto}} autorisés</strong>  soit <strong>{{$pourAuto}}</strong>%</li>
                        <li><strong>{{$nombreCandidatRefus}} refusés</strong>  soit <strong>{{$pourRefus}}</strong>%</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-center">
                    Listes
                </div>
                <div class="card-body pt-5 pb-5">
                    <ul>
                        <li><a href="#all" class="btnAll">Liste de tous les candidats</a></li>
                        <li><a href="#reussi" class="btnAdmis">Liste des candidats admis et autorisés</a></li>
                        <li><a href="#refus" class="btnRefus">Liste les candidats refusés</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Listes des candidats --}}

    <div class="listeAll">
        <div id="all" class="impression card container col-md-12 p-5 mt-3">
            <div class="row">
                <div class="col-md-4 text-center">
                    <p>ASSOCIATION DES JEUNES POUR LE DEVELOPPEMENT DE NTSADJENI BARAKANI</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <h5>{{$classe->nom_examen}}</h3>
                    <h6>{{$classe->nom_classe}}</h6>
                    {{-- <p>Année : 2022</p> --}}
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h5 class="text-center">LISTE DES CANDIDATS</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom et prénom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach ($listes as $l)
                            <?php $i++; ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$l->nom_candidat}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
            <div class="text-center mt-5">Le Sécretaire</div>
        </div>

        <div class="text-center mt-3">
            <button onclick="imprimer('all')" type="button" class="btn btn-info btn-sm">Imprimer en PDF</button>
        </div>
    </div>

    {{-- Listes admis --}}

    <div class="listeAdmis">
        <div id="reussi" class="impression card container col-md-12 p-5 mt-3">
            <div class="row">
                <div class="col-md-4 text-center">
                    <p>ASSOCIATION DES JEUNES POUR LE DEVELOPPEMENT DE NTSADJENI BARAKANI</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <h5>{{$classe->nom_examen}}</h3>
                    <h6>{{$classe->nom_classe}}</h6>
                    {{-- <p>Année : 2022</p> --}}
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h5 class="text-center">LISTE DES CANDIDATS ADMIS</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom et prénom</th>
                                <th>Mention</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $h=0;
                            $mention = "";
                            ?>
                            @foreach ($listeAdmis as $la)
                            <?php $h++;
                                if($la->moyenne >= 10 && $la->moyenne <12){
                                    $mention = "Passable";
                                }elseif($la->moyenne >= 12 && $la->moyenne <14){
                                    $mention = "Assez-bien";
                                }elseif($la->moyenne >= 14 && $la->moyenne <16){
                                    $mention = "Bien";
                                }elseif($la->moyenne >= 16 && $la->moyenne <17){
                                    $mention = "Très-bien";
                                }elseif ($la->moyenne > 17) {
                                    $mention = "Excellent";
                                }
                            ?>
                            <tr>
                                <td>{{$h}}</td>
                                <td>{{$la->nom_candidat}}</td>
                                <td>{{$mention}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    
                    <h5 class="text-center">LISTE DES CANDIDATS AUTORISéS</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom et prénom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k=0; ?>
                            @foreach ($listeAuto as $lau)
                            <?php $k++; ?>
                            <tr>
                                <td>{{$k}}</td>
                                <td>{{$lau->nom_candidat}}</td>
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="text-center mt-5">Le Sécretaire</div>
        </div>

        <div class="text-center mt-3">
            <button onclick="imprimer('reussi')" type="button" class="btn btn-warning btn-sm">Imprimer en PDF</button>
        </div>
    </div>

    {{-- Listes des candidats refusés --}}

    <div class="listeRefus">
        <div id="refus" class="impression card container col-md-12 p-5 mt-3">
            <div class="row">
                <div class="col-md-4 text-center">
                    <p>ASSOCIATION DES JEUNES POUR LE DEVELOPPEMENT DE NTSADJENI BARAKANI</p>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <h5>{{$classe->nom_examen}}</h3>
                    <h6>{{$classe->nom_classe}}</h6>
                    {{-- <p>Année : 2022</p> --}}
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h5 class="text-center">LISTE DES CANDIDATS REFUSES</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom et prénom</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $z=0; ?>
                            @foreach ($listeRefus as $lf)
                            <tr>
                            <?php $z++; ?>
                                <td>{{$z}}</td>
                                <td>{{$lf->nom_candidat}}</td>
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
            <div class="text-center mt-5">Le Sécretaire</div>
        </div>

        <div class="text-center mt-3">
            <button onclick="imprimer('refus')" type="button" class="btn btn-dark btn-sm">Imprimer en PDF</button>
        </div>
    </div>

</div>
@endsection

@section('scriptJs')
<script>

</script>
<script>
    //impression
   // imprimer();
    function imprimer(id){
        var restorepage=document.body.innerHTML;
        var printContent=document.getElementById(id).innerHTML;
        
        document.body.innerHTML=printContent;
        window.print();
        document.body.innerHTML=restorepage;
    }

    //cache releve
    $(document).ready(function(){
        $(".listeAdmis").fadeOut(1, function(){
          $(".listeAll").fadeIn(1000)
        });

        $(".listeRefus").fadeOut(1, function(){
          $(".listeAll").fadeIn(1000)
        });

        $(document).on('click', '.btnAll', function(){
         $(".listeAdmis").fadeOut(1, function(){
          $(".listeAll").fadeIn(1000)
         });
         $(".listeRefus").fadeOut(1, function(){
          $(".listeAll").fadeIn(1000)
         });
        });

        $(document).on('click', '.btnAdmis', function(){
         $(".listeAll").fadeOut(1, function(){
          $(".listeAdmis").fadeIn(1000)
         });
         $(".listeRefus").fadeOut(1, function(){
          $(".listeAdmis").fadeIn(1000)
         });
        });

        $(document).on('click', '.btnRefus', function(){
         $(".listeAll").fadeOut(1, function(){
          $(".listeRefus").fadeIn(1000)
         });
         $(".listeAdmis").fadeOut(1, function(){
          $(".listeRefus").fadeIn(1000)
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
            <a class="nav-link " href="{{route('parametre')}}">Paramètres</a>
          </li>
        </ul>
        <div class="d-flex">
          <input class="form-control me-2" type="texy" value="" disabled>
          <a class="btn btn-outline-success" href="">Deconnexion</a>
        </div>
      </div>
    </div>
  </nav>
@endsection