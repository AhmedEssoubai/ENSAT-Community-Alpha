@extends('layouts.app')

@section('content')
<section class="pt-3 pb-5 text-left page-spacing bg-light">
    <div class="container pt-3">
        <div class="row mx-3 mt-2 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black">Professors</h3>
                <p class="text-muted">
                    The class have {{ $class->professors->count() }} professors
                </p>
            </div>
            @if (Auth::user()->is_professor() && $class->is_chef(Auth::id()))
            <h6>
                <button class="rb-primary rbl" data-toggle="modal" data-target="#new_professor">Add Professors</button>
            </h6>
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-md-6 my-3 d-flex align-content-stretch">
                <div class="course-card m-1 flex-grow-1">
                    <div class="p-4 w-100">
                        <div class="d-flex align-items-center">
                            <div class="pr-3">
                                <img src="{{ $class->chef->user->image }}" class="img-fluid rounded-circle" width="78px"/>
                            </div>
                            <div class="flex-grow-1">
                                <h5>{{ $class->chef->user->firstname }} {{ $class->chef->user->lastname }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($class->professors as $professor)
                <div id="professor{{ $professor->id }}" class="col-md-6 my-3 d-flex align-content-stretch">
                    <div class="course-card m-1 flex-grow-1">
                        <div class="p-4 w-100">
                            <div class="d-flex align-items-center">
                                <div class="pr-3">
                                    <img src="{{ $professor->user->image }}" class="img-fluid rounded-circle" width="78px"/>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>{{ $professor->user->firstname }} {{ $professor->user->lastname }}</h5>
                                </div>
                                <!--<div class="d-flex pr-3 align-items-center dropdown">
                                    <span class="icon-mute" id="professor_{{ $professor->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="member_{{ $member->id }}_options">
                                        <a class="dropdown-item" href="/users/d/{{ $professor->id }}">Kick</a>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="rkm-line mt-5"></div>
        <div class="row mx-3 mt-5 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black">Students</h3>
                <p class="text-muted">
                    The class have {{ $class->students->count() }} students
                </p>
            </div>
        </div>
        <div class="row mt-3">
            @foreach($class->students as $student)
                <div id="student{{ $student->id }}" class="col-md-6 my-3 d-flex align-content-stretch">
                    <div class="course-card m-1 flex-grow-1">
                        <div class="p-4 w-100">
                            <div class="d-flex align-items-center">
                                <div class="pr-3">
                                    <img src="{{ $student->user->image }}" class="img-fluid rounded-circle" width="78px"/>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>{{ $student->user->firstname }} {{ $student->user->lastname }}</h5>
                                </div>
                                <!--<div class="d-flex pr-3 align-items-center dropdown">
                                    <span class="icon-mute" id="student_{{ $student->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="student_{{ $student->id }}_options">
                                        <a class="dropdown-item" href="/users/d/{{ $student->id }}">Kick</a>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade rkm-model" id="new_professor" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
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
                                <div class="col-sm-12 col-md-8 col-lg-6">
                                    <form action="{{ route('add.professors') }}" method="POST">
                                        @csrf
                                        <h2 class="mb-5 text-center text-black">Add professors</h2>
                                        <div id="selected_list" class="d-flex flex-wrap">
                                            <input id="search_input" class="free lead flex-grow-1" maxlength="45"/>
                                        </div>
                                        <div class="border-bottom my-4"></div>
                                        <div class="overflow-auto" style="height: 40vh">
                                            <div id="empty_list" class="p-3 align-items-center d-none">
                                                <h6 class="text-mgray"><span class="mr-3 lead"><i class="fas fa-user-slash"></i></span>Oops! no professor found</h6>
                                            </div>
                                            <div id="results_list" class="py-3 container overflow-auto"></div>
                                        </div>
                                        <div class="form-groupe mt-4">
                                            <button id="send_members" type="submit" class="rb-primary rbl w-100">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/members-scripts.js') }}"></script>
@endpush