@extends('layouts.app')

@section('content')
<section class="pt-3 pb-5 text-left page-spacing bg-light">
    <div class="container pt-3">
        <div class="row mx-3 mt-2 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black">My courses</h3>
                <p class="text-muted">
                    You have {{ $class->courses->count() }} course
                </p>
            </div>
            <h6 class="">
                <button class="rb-primary rbl" data-toggle="modal" data-target="#new_cours">NEW Course</button>
            </h6>
        </div>
        <div class="row mb-5">
            @foreach ($class->courses as $cours)
            <div class="col-sm-6 col-md-4 my-3 d-flex align-content-stretch">
                <div class="course-card m-1">
                    <div class="card-border"></div>
                    <div class="p-4">
                        <h5 class="lead mb-4">
                            <a href="#" class="text-dark">{{ $cours->title }}</a>
                        </h5>
                        <p class="small text-muted mb-4 line-clamp lc-4">
                            {{ $cours->description }}
                        </p>
                        <p class="text-muted">
                            {{ $cours->professor->user->firstname }} {{ $cours->professor->user->lastname }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($class->courses->count() == 0)
                <div class="col text-muted text-center py-2 px-2 my-3">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">Aucun cour à afficher</h4>
                    <h5 class="my-3">Cliquez sur "<i class="fas fa-plus"></i>" pour créer votre premier cour</h5>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="new_cours" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">New cours</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="new_cours_form" enctype="multipart/form-data" action="{{ route('classes.courses.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="title" maxlength="125">
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Short title:</label>
                        <input type="text" name="short_title" class="form-control" id="title" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <input type="hidden" name="class_id" value="{{ $class->id }}" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="new_cours_form" class="btn btn-primary">Create</button>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection