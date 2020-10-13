@extends('layouts.app')

@section('content')
<section class="pt-3 pb-5 text-left page-spacing bg-light">
    <div class="container pt-3">
        <div class="row mx-3 mt-2 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black"><strong>{{ $class->label }}</strong> groups</h3>
                <p class="text-muted">
                    There are {{ $class->groups->count() }} group
                </p>
            </div>
            @if (Auth::user()->is_professor())
            <h6>
                <button class="rb-primary rbl" data-toggle="modal" data-target="#new_group">NEW Group</button>
            </h6>
            @endif
        </div>
        <div class="row mb-5">
            @foreach ($class->groups as $group)
            <div class="col-sm-6 col-md-4 my-3 d-flex align-content-stretch">
                <div class="course-card m-1 flex-grow-1">
                    <div class="p-4 w-100">
                        <div class="d-flex justify-content-between">
                            <h5 class="lead mb-4 text-dark">
                                {{ $group->label }}
                            </h5>
                            <div class="d-flex pr-2 dropdown">
                                <span class="icon-hidden" id="class_{{ $class->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="class_{{ $class->id }}_options">
                                    <a class="dropdown-item" href="#">Administrateur</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            @foreach ($group->students as $student)
                                <div class="avatar-30 mr-2">
                                    <img class="img-fluid rounded-circle" src="{{ $student->user->image }}" alt="student_img" title="{{ $student->user->firstname }} {{ $student->user->lastname }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($class->groups->count() == 0)
                <div class="col text-muted text-center py-2 px-2 my-3">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">No group to display</h4>
                    <h5 class="my-3">Click on "NEW GROUP" to create the first group</h5>
                </div>
            @endif
        </div>
    </div>
    
    @if (Auth::user()->is_professor())
    <div class="modal fade rkm-model" id="new_group" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
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
                            <form class="col-sm-12 col-md-8 col-lg-6" method="POST" action="{{ route('classes.groups') }}">
                                @csrf
                                <h2 class="mb-5 text-center">New group</h2>
                                <div class="form-group my-3">
                                    <input type="text" name="label" maxlength="64" class="rkm-form-control my-2 @error('label') is-invalid @enderror" value="{{ old('label') }}" placeholder="Label" required />
                                    @error('label')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <div id="selected_list" class="d-flex flex-wrap">
                                        <input id="search_input" class="free lead flex-grow-1" maxlength="45" placeholder="Search for students..."/>
                                    </div>
                                    <div class="border-bottom my-4"></div>
                                    <div style="height: 25vh" class="overflow-auto">
                                        <div id="empty_list" class="p-3 align-items-center d-none">
                                            <h6 class="text-muted"><span class="mr-3 lead"><i class="fas fa-user-slash"></i></span>Oops! no students found</h6>
                                        </div>
                                        <div id="results_list" class="py-3 container"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="class" value="{{ $class->id }}"/>
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

@push('scripts')
    <script src="{{ asset('js/members-scripts.js') }}"></script>
    <script>
        src = "/search/students/";
        selected_name = "students";
    </script>
@endpush