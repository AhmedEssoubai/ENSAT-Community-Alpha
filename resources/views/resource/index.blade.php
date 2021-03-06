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
            {{-- Resources --}}
            <div class="posts-list">
                @foreach($class->resources as $resource)
                    <div id="p_{{ $resource->id}}" class="posts-list-item d-flex">
                        <div class="d-flex align-items-center mr-4">
                            <img src="{{ $resource->course->professor->user->image }}" alt="profile image" class="avatar-60 rounded-circle" title="{{ $resource->course->professor->user->firstname }} {{ $resource->course->professor->user->lastname }}"/>
                        </div>
                        <div class="mr-2">
                            <p class="d-flex">
                                <a href="" class="mr-2 _link text-dgray text-up"><strong>{{ $resource->course->short_title }}</strong></a>
                                <span class="text-lgray">• 8 DAYS AGO </span>
                            </p>
                            <h4 class="mb-4"><a href="\resources\{{ $resource->id }}" class="text-dark line-clamp">{{ $resource->title }}</a></h4>
                            <p class="text-dgray mb-2 line-clamp lc-3">{{ $resource->content }}</p>
                            <div class="d-flex">
                                <div class="d-flex align-items-center dropdown">
                                    <span class="text-mgray icon-hidden" id="resource_{{ $resource->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="resource_{{ $resource->id }}_options">
                                        {{--<a class="dropdown-item" href="#">Edit</a>--}}
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_resource" data-id="{{ $resource->id }}">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($class->resources->count() == 0)
                    <div class="text-muted text-center py-5 px-2">
                        <h2 class="my-3" style="font-size: 3em"><i class="fas fa-cloud-showers-heavy"></i></h2>
                        <h4 class="my-3">Ce class est mort</h4>
                        <h5 class="my-3">Apportez-lui la vie par vos posts</h5>
                    </div>
                @endif
            </div>
        </div>
        {{-- Side --}}
        <div class="col-3 d-none d-lg-block">
            <div class="mb-5 mx-3">
                <button class="rb-primary rbl w-100" data-toggle="modal" data-target="#new_discussion">new resource</button>
            </div>
            {{-- Assignments list --}}
            {{--<div class="py-3 mb-4 border-rounded">
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
            </div>--}}
            {{-- Annoucments list --}}
            {{--<div class="py-3 mb-4 border-rounded">
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
            </div>--}}
            {{-- Students list --}}
            <div class="py-3 mb-4 border-rounded">
                <h6 class="text-dark mx-3 mb-3">Class students</h6>
                <div class="container">
                    <div class="row mx-1">
                        @foreach ($class->students as $student)
                            <div class="col-2 my-1 px-1">
                                <img class="img-fluid rounded-circle" src="{{ $student->user->image }}" alt="student_img" title="{{ $student->user->firstname }} {{ $student->user->lastname }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="/classes/{{ $class->id }}/members" class="_link px-3"><small>Show all</small></a>
                </div>
            </div>
        </div>
        <div class="modal fade rkm-model" id="delete_resource" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog rkm-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-header border-0 right-corner">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <span class="lead">Are you sure of you wanna delete this resource?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletePost()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade rkm-model" id="new_discussion" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
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
                                <form class="col-sm-12 col-md-8 col-lg-6" method="POST" enctype="multipart/form-data" action="{{ route('resources') }}">
                                    @csrf
                                    <div class="mb-5 d-flex justify-content-between align-items-center">
                                        <h2 class="text-center">New resource</h2>
                                        <button type="submit" class="rb-primary rbl">Publish</button>
                                    </div>
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
                                        <label for="content" class="rkm-control-label">Content</label>
                                        <textarea id="content" class="rkm-form-control @error('content') is-invalid @enderror" name="content" rows="4" placeholder="Enter Content" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="course" class="rkm-control-label">Course</label>
                                        <select id="course" name="course" class="custom-select rkm-form-control @error('course') is-invalid @enderror" required>
                                            <option disabled @empty(old('course')) selected @endif value>-- Select resource course --</option>
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
@endpush