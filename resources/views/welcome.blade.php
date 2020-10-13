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
                    <p style="font-size: 1.5em; color: rgba(255, 255, 255, 0.7)" class="lead">
                        Do not take life too seriously. You will never get out of it alive.
                    </p>
                    <div class="mt-5">
                        <a href="{{ route('register') }}" class="rb-white">
                            Get started now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="properties" class="py-5 text-center bg-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-share"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Share it easily</h5>
                            <p class="card-text">Using ENSAT Community offers the opportunity to share course, exercice, exam with the community(your students, teacher or everyone) fast, simple and easy.                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage it now</h5>
                            <p class="card-text">Using ENSAT Community helps you to manage your students, their notes, documents and sessions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-icon">
                            <i class="far fa-eye"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Stream it or watch it</h5>
                            <p class="card-text">Teachers are able to stream their own lives and watch them as well as students, and there is also an opportunity to contribute with each other (Chat room, whiteboard)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection