@extends('layouts.class')

@section('content-2')
<div class="container px-0">
    <div class="row">
        <div class="col-lg-9">
            {{-- Filters --}}
            <div class="mb-5 px-4 d-flex">
                <div class="mr-4">
                    <select id="cours" name="cours" class="custom-select rkm-select my-2">
                        <option selected value="0">Latest</option>
                        <option value="1">Oldest</option>
                    </select>
                </div>
                <div>
                    <select id="cours" name="cours" class="custom-select rkm-select my-2">
                        <option selected value="0">All</option>
                        <option value="1">Cloud</option>
                        <option value="2">Java</option>
                    </select>
                </div>
            </div>
            {{-- Assignments --}}
            <div class="posts-list">
                @foreach($class->assignments as $assignment)
                    <div id="p_{{ $assignment->id}}" class="posts-list-item d-flex">
                        <div class="d-flex align-items-center mr-4">
                            <img src="{{ $assignment->course->professor->user->image }}" alt="profile image" class="avatar-60 rounded-circle" title="{{ $assignment->course->professor->user->firstname }} {{ $assignment->course->professor->user->lastname }}"/>
                        </div>
                        <div class="mr-2">
                            <p class="d-flex">
                                <a href="" class="mr-2 _link text-dgray text-up"><strong>{{ $assignment->course->short_title }}</strong></a>
                                <span class="text-lgray">• 8 DAYS AGO </span>
                            </p>
                            <h4 class="mb-4"><a href="\assignments\{{ $assignment->id }}" class="text-dark line-clamp">{{ $assignment->title }}</a></h4>
                            <p class="text-dgray mb-2 line-clamp lc-3">{{ $assignment->objectif }}</p>
                            <div class="d-flex">
                                <span class="mr-3 text-red">Deadline: {{ $assignment->deadline }}</span>
                                <div class="d-flex align-items-center dropdown">
                                    <span class="text-mgray icon-hidden" id="assignment_{{ $assignment->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="assignment_{{ $assignment->id }}_options">
                                        <a class="dropdown-item" href="#">Éditer</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_post" data-id="{{ $assignment->id }}">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($class->assignments->count() == 0)
                    <div class="text-muted text-center py-5 px-2">
                        <h2 class="my-3" style="font-size: 3em"><i class="fas fa-cloud-showers-heavy"></i></h2>
                        <h4 class="my-3">No assignment to display</h4>
                    </div>
                @endif
            </div>
        </div>
        {{-- Side --}}
        <div class="col-3 d-none d-lg-block">
            <div class="mb-5 mx-3">
                <button class="rb-primary rbl w-100" data-toggle="modal" data-target="#new_assignment">new assignment</button>
            </div>
            {{-- Assignments list --}}
            <div class="py-3 mb-4 border-rounded">
                <h6 class="text-dark mx-3 mb-3">This week assignments</h6>
                <div class="rkm-list-group">
                    <a href="#" class="list-group-item d-flex align-items-center border-0">
                        <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
                    </a>
                    <a href="#" class="list-group-item d-flex align-items-center border-0">
                        <small>Non in dolores odio.</small>
                    </a>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="_link px-3"><small>Show all</small></a>
                </div>
            </div>
            {{-- Annoucments list --}}
            <div class="py-3 mb-4 border-rounded">
                <h6 class="text-dark mx-3 mb-3">This week annoucments</h6>
                <div class="rkm-list-group">
                    <a href="#" class="list-group-item d-flex align-items-center border-0">
                        <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
                    </a>
                    <a href="#" class="list-group-item d-flex align-items-center border-0">
                        <small>Non in dolores odio.</small>
                    </a>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="_link px-3"><small>Show all</small></a>
                </div>
            </div>
            {{-- Students list --}}
            <div class="py-3 mb-4 border-rounded">
                <h6 class="text-dark mx-3 mb-3">Class students</h6>
                <div class="container">
                    <div class="row mx-1">
                        <div class="col-2 my-1 px-1" title="Consectetur Adipisicing">
                            <img src="img/avatar-0.png" class="img-fluid rounded-circle"/>
                        </div>
                        <div class="col-2 my-1 px-1" title="Possimus Cupiditate">
                            <img src="img/avatar-1.jpeg" class="img-fluid rounded-circle"/>
                        </div>
                        <div class="col-2 my-1 px-1" title="Dolor Sit">
                            <img src="img/avatar-2.jpg" class="img-fluid rounded-circle"/>
                        </div>
                        <div class="col-2 my-1 px-1" title="Dolor Sit">
                            <img src="img/avatar-2.jpg" class="img-fluid rounded-circle"/>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="_link px-3"><small>Show all</small></a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete_assignment" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <input id="d-post-id" type="hidden" />
                    <h5 class="modal-title" id="dp-modalLabel">Delete the assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    are you sure of this
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletePost()">Delete</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade rkm-model" id="new_assignment" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog rkm-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0 right-corner">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container h-100 py-5">
                            <div class="row justify-content-md-center h-100 align-items-center pt-3">
                                <form class="col-sm-12 col-md-8 col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('assignments') }}">
                                    @csrf
                                    <div class="mb-5 d-flex justify-content-between align-items-center">
                                        <h2 class="text-center">New assignment</h2>
                                        <button type="submit" class="rb-primary rbl">Publish</button>
                                    </div>
                                    <div class="form-group my-3">
                                        <input type="text" name="title" maxlength="125" class="rkm-form-control my-2 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Title" required />
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group my-3">
                                        <textarea class="rkm-form-control @error('objectif') is-invalid @enderror" name="objectif" rows="4" placeholder="Objectif" required>{{ old('objectif') }}</textarea>
                                        @error('objectif')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group my-3">
                                        <select id="course" name="course" class="custom-select rkm-form-control @error('course') is-invalid @enderror" required>
                                            <option disabled @empty(old('course')) selected @endif value>-- Select assignment course --</option>
                                            @foreach ($prof_courses as $course)
                                                <option @if(old('course') == '{{$course->id}}') selected @endif value="{{$course->id}}">{{$course->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('course')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-row align-items-center">
                                        <div class="col-7 my-3">
                                            <input type="datetime-local" name="deadline" class="rkm-form-control my-2 @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}" placeholder="Deadline" required />
                                            @error('deadline')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-5 my-3">
                                            <select id="assigned_type" name="assigned_type" class="custom-select rkm-form-control @error('assigned_type') is-invalid @enderror" required>
                                                <option @if(old('assigned_type') == '0') selected @endif value="0">Individuals</option>
                                                <option @if(old('assigned_type') == '1') selected @endif value="1">Groups</option>
                                            </select>
                                            @error('assigned_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group my-3" style="border-bottom: 1px solid rgba(114, 114, 114, 0.5)">
                                        <button id="assigned-btn" type="button" class="btn-free w-100 text-left text-dgray lead mb-2">
                                            All students
                                        </button>
                                        <div id="assigned-list" style="display: none; border-top: 1px solid rgba(114, 114, 114, 0.2)">
                                            <div class="custom-control custom-checkbox my-3">
                                                <input type="checkbox" class="custom-control-input" id="opt-0">
                                                <label class="custom-control-label w-100" for="opt-0">All students</label>
                                            </div>
                                        </div>
                                        @error('assigned')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" onclick="create_attachment('attachments_list')" class="rbo-secondary mt-3 pl-3"><span class="mr-2"><i class="fas fa-paperclip"></i></span> Add attachment</button>
                                        <div id="attachments_list" class="my-4">
                                        </div>
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
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset("js/files-scripts.js") }}"></script>
    <script type="text/javascript" src="{{ asset("js/assignment-form.js") }}"></script>
@endpush