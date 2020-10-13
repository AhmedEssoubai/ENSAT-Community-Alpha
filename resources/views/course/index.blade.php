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
            @if (Auth::user()->is_professor())
            <h6>
                <button class="rb-primary rbl" data-toggle="modal" data-target="#new_cours">NEW Course</button>
            </h6>
            @endif
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
                    <h4 class="my-3">No course to display</h4>
                </div>
            @endif
        </div>
    </div>
    @if (Auth::user()->is_professor())
    <div class="modal fade rkm-model" id="new_cours" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
        <div class="modal-dialog rkm-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 right-corner">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container h-100">
                        <div class="row justify-content-md-center h-100 align-items-center">
                            <form class="col-sm-12 col-md-8 col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('discussions') }}">
                                @csrf
                                <h2 class="mb-5 text-center text-black">New cours</h2>
                                <div class="form-group my-3">
                                    <label for="title" class="rkm-control-label">Title</label>
                                    <input id="title" type="text" name="title" maxlength="125" class="rkm-form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter Title" required />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="short_title" class="rkm-control-label">Short Title</label>
                                    <input id="short_title" type="text" name="short_title" maxlength="125" class="rkm-form-control @error('short_title') is-invalid @enderror" value="{{ old('short_title') }}" placeholder="Enter Short Title" required />
                                    @error('short_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="description" class="rkm-control-label">Description</label>
                                    <textarea id="description" class="rkm-form-control @error('description') is-invalid @enderror" name="description" rows="4" placeholder="Enter Description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                                <div class="form-groupe mt-4">
                                    <button type="submit" class="rb-primary rbl w-100">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection