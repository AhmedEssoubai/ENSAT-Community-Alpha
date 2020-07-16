@extends('layouts.app')

@section('content')
<div>
    <section id="welcome" class="py-5">
        <div class="container">
            <div class="row mx-5">
                <div class="col-sm-12 col-lg-8 text-left text-white pt-md-5">
                    <h1 class="display-2 mt-5 mb-5 pt-5">
                        <strong>KEEP GOING</strong>
                    </h1>
                    <p style="font-size: 1.6em;" class="lead">
                        Do not take life too seriously. You will never get out of it alive.
                    </p>
                    <div class="mt-5">
                        <a href="register.html" class="btn btn-primary btn-lg text-white">
                            S'inscrire
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="properties" class="py-5 text-center bg-white">
        <div class="container">
            <div class="row text-left">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="card">
                        <img class="card-img-top w-50 m-auto" src="img/prop-0.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Partagez facilement avec qui vous voulez</h5>
                            <p class="card-text">le partage en utilisant Bisd Community, c'est simple et rapide.Un simple lien vous permet de partager toutes sortes de fichiers (photo, vidéo, dossier compressé, etc.) avec qui vous voulez</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="card">
                        <img class="card-img-top w-50 m-auto" src="img/prop-1.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Gérez vos groupes.</h5>
                            <p class="card-text">avec Bisd Community, vous pouvez facilement importer des fichiers et partager des documents avec les personnes concernées, en créant un groupe, en ajoutant une liste de membres et en invitant ces derniers à accéder à un dossier partagé.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="card">
                        <img class="card-img-top w-50 m-auto" src="img/prop-2.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Recevez des notifications</h5>
                            <p class="card-text">Soyez averti au moment précis où un utilisateur commenter à votre publication ou a partager dans votre groupe.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="card">
                        <img class="card-img-top w-50 m-auto" src="img/prop-3.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Etudier avec les autres</h5>
                            <p class="card-text">posez des questions, partagez des cours,exercices... et partagez des connaissences avec les autres</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 text-center bg-faded">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="mb-5">
                        <h1 class="text-primary pb-3">
                            ENSAT Community
                        </h1>
                        <p class="lead pb-3">
                            ENSAT Community est un site de partage pour les étudiants afin de partager des cours, des exercices, poser des questions ; pour partager les connaissences.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection