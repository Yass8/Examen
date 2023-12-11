@extends('examen.home')
@section('titre', 'Dashboard')
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
                <div class="card">
                    <div class="card-header">
                        <h4>Dashboard
                            {{-- <a href="" class="btn btn-info float-end btn-sm" data-bs-toggle="modal" data-bs-target="#addMat">Ajouter</a> --}}
                        </h4>
                    </div>
                    <div class="card-body">
                      <?php 
                      //BEPC
                        $tt_bepc=array();$tb_admis = array();$tb_refus = array();
                        foreach($listeTroi as $lt){
                          if ($lt->moyenne > 7) {
                          array_push($tb_admis,1);   
                          }
                          if ($lt->moyenne < 8) {
                          array_push($tb_refus,1);   
                          }
                          array_push($tt_bepc,1);
                        }  
                        //BAC
                        $tt_bac=array();$tb_admisb = array();$tb_refusb = array();
                        foreach($listeBac as $lb){
                          if ($lb->moyenne > 7) {
                          array_push($tb_admisb,1);  
                          }elseif ($lb->moyenne < 8) {
                          array_push($tb_refusb,1);   
                          }
                          array_push($tt_bac,1);
                        }
                      ?>
                        <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-header bg-warning">
                                  Nombre de candidats
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">{{array_sum($tt_bepc)}} candidats du BEPC</h5>
                                  <h5 class="card-title">{{array_sum($tt_bac)}} candidats du BACCALAUREAT</h5>
                                  {{-- <h5 class="card-title">.</h5> --}}
                                  
                                </div>
                                <div class="card-footer text-muted bg-warning">
                                  Soit {{array_sum($tt_bepc)+array_sum($tt_bac)}} candidats
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-header bg-info">
                                  Résultats du BEPC
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">{{array_sum($tb_admis)}} admis</h5>
                                  {{-- <h5 class="card-title">{{array_sum($tb_auto)}} autorisés</h5> --}}
                                  <h5 class="card-title">{{array_sum($tb_refus)}} réfusés</h5>
                                </div>
                                <div class="card-footer text-muted bg-info">
                                  <a href="{{route('classes.index')}}">Listes</a>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-header bg-success">
                                    Résultats du BACCALAUREAT
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">{{array_sum($tb_admisb)}} admis</h5>
                                    {{-- <h5 class="card-title">{{array_sum($tb_autob)}} autorisés</h5> --}}
                                    <h5 class="card-title">{{array_sum($tb_refusb)}} réfusés</h5>
                                  </div>
                                  <div class="card-footer text-muted bg-success">
                                    <a href="{{route('classes.index')}}">Listes</a>
                                  </div>
                              </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
        
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
            <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
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
            <a class="nav-link" href="{{route('candidats.index')}}">Candidats</a>
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
@section('2content')
    
@endsection