@extends('layouts.app')

@section('content')
<section class="py-5 text-left">
    <div class="container pt-3">
        <div class="row mt-2 mb-3 border-bottom pb-3 d-flex justify-content-between">
            <h2 class="text-muted">My classes ({{ $classes->count() }})</h2>
            <h5 class="align-self-end"><a class="btn btn-primary" href="{{ route('classes.create') }}">New class  <i class="ml-2 fas fa-plus"></i></a></h5>
        </div>
        <div class="row mb-5">
            @foreach ($classes as $class)
            <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                <div class="card shadow-sm">
                    <div class="card-img-top img_box"><a href="/classes/{{ $class->id }}"><img class="img_self" src="{{ $class->image }}" alt="class image"></a></div>
                    <div class="card-body d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <a class="_link" href="/classes/{{ $class->id }}">{{ $class->label }}</a>
                                <span title="Privé" class="ml-2 text-muted align-self-center" style="font-size: 0.7em"><i class="fas fa-lock"></i></span>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">10 members</h6>
                        </div>
                        <div class="d-flex pr-2 dropdown align-self-center">
                            <span class="icon-mute" id="class_{{ $class->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="class_{{ $class->id }}_options">
                                <a class="dropdown-item" href="#">Administrateur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($classes->count() == 0)
                <div class="col text-muted text-center py-2 px-2 my-3">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">Aucun groupe à afficher</h4>
                    <h5 class="my-3">Cliquez sur "<i class="fas fa-plus"></i>" pour créer votre premier groupe</h5>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection