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
                        <option value="2">Popular</option>
                        <option value="3">No Replies Yet</option>
                    </select>
                </div>
                <div>
                    <select id="cours" name="cours" class="custom-select rkm-select my-2">
                        <option selected value="0">All</option>
                        <option value="1">General</option>
                        <option value="2">Cloud</option>
                        <option value="3">Java</option>
                    </select>
                </div>
            </div>
            {{-- Discussions --}}
            <div class="posts-list">
                @foreach($class->discussions as $discussion)
                    <div id="p_{{ $discussion->id}}" class="posts-list-item d-flex">
                        <div class="mt-2 mr-4">
                            <img src="{{ $discussion->user->image }}" alt="profile image" class="avatar rounded-circle" title="{{ $discussion->user->firstname }} {{ $discussion->user->lastname }}"/>
                        </div>
                        <div class="mr-5">
                            <h5><a href="\discussions\{{ $discussion->id }}" class="text-dark line-clamp">{{ $discussion->title }}</a></h5>
                            <p class="text-dgray mb-2 line-clamp lc-2">{{ $discussion->content }}</p>
                            <div class="d-flex">
                                <small class="text-mgray">posted 8 days ago</small>
                                <div class="d-flex ml-2 align-items-center dropdown">
                                    <small class="text-mgray icon-hidden" id="discussion_{{ $discussion->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></small>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="discussion_{{ $discussion->id }}_options">
                                        {{--<a class="dropdown-item" href="/discussions/{{ $discussion->id }}/editer">Edit</a>--}}
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_discussion" data-id="{{ $discussion->id }}">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-1 d-flex align-items-center">
                            <div class="d-flex mr-3">
                                <span class="mr-2"><i class="fa fa-heart"></i></span>
                                {{ $discussion->favorited_users->count() }}
                            </div>
                            <div class="d-flex mr-3">
                                <span class="mr-2"><i class="fas fa-comment"></i></span>
                                {{ $discussion->comments->count() }}
                            </div>
                            <div>
                                <a class="rbo-primary">GENERAL</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($class->discussions->count() == 0)
                    <div class="text-muted text-center py-5 px-2">
                        <h2 class="my-3" style="font-size: 3em"><i class="fas fa-cloud-showers-heavy"></i></h2>
                        <h4 class="my-3">No discussions found</h4>
                        <h5 class="my-3">If you have any questions post them here</h5>
                    </div>
                @endif
            </div>
        </div>
        {{-- Side --}}
        <div class="col-3 d-none d-lg-block">
            <div class="mb-5 mx-3">
                <button class="rb-primary rbl w-100" data-toggle="modal" data-target="#new_discussion">NEW DISCUSSION</button>
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
        <div class="modal fade" id="delete_discussion" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <input id="d-post-id" type="hidden" />
                    <h5 class="modal-title" id="dp-modalLabel">Supprimer le discussion</h5>
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
        <div class="modal fade rkm-model" id="new_discussion" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
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
                                    <h2 class="mb-5 text-center text-black">New discussion</h2>
                                    <div class="form-group my-3">
                                        <label for="title" class="rkm-control-label">Title</label>
                                        <input type="text" name="title" maxlength="125" class="rkm-form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter Title" required />
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
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="rkm-control-label">Image</label>
                                                <div class="custom-file @error('image') is-invalid @enderror">
                                                    <input id="discussionImage" type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}">
                                                    <label class="custom-file-label" for="discussionImage">Choose image</label>
                                                </div>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="course" class="rkm-control-label">Course</label>
                                                <select id="course" name="cours" class="custom-select rkm-form-control">
                                                    <option selected value="0">General</option>
                                                    <option value="1">Python</option>
                                                    <option value="2">Cloud</option>
                                                    <option value="3">Java</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="class" value="{{ $class->id }}"/>
                                    <div class="form-groupe mt-4">
                                        <button type="submit" class="rb-primary rbl w-100">Publish</button>
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