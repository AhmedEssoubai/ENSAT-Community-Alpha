@extends('layouts.app')

@section('content')
<section id="content" class="pt-3 pb-5 text-left mx-auto bg-white page-spacing">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-9 p-0">
                <div class="post">
                    <div class="mr-3 avatar-40">
                        <img src="{{ $resource->course->professor->user->image }}" alt="profile image" class="img-fluid rounded-circle" />
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center">
                            <strong class="text-dgray my-0 mr-2">{{ $resource->course->professor->user->firstname }} {{ $resource->course->professor->user->lastname }}</strong>
                            <strong class="text-mgray mr-2"> • </strong>
                            <small class="text-mgray">8 days ago</small>
                        </div>
                        <div class="mt-3">
                            <h4 class="text-black mb-3">{{ $resource->title }}</h4>
                            <p id="post_content" class="text-mgray mb-3">{{ $resource->content }}</p>
                            {{--@if (!empty($resource->image))
                                <img src="/storage/{{ $discussion->image }}" class="img-fluid mb-3" alt="discussion image">
                            @endif--}}
                            {{-- Attachments --}}
                            @if ($resource->files->count() > 0)
                                <div class="mt-4 d-flex flex-wrap">
                                    @foreach($resource->files as $file)
                                        <a href="/files/r/{{ $file->id }}" target="_blank" class="btn btn-os mr-4 my-2"><i class="fas fa-file-download mr-2"></i> {{ $file->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="d-flex">
                                <div class="d-flex ml-2 align-items-center dropdown">
                                    <small class="text-mgray icon-hidden" id="resource_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></small>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="resource_options">
                                        <a class="dropdown-item" href="/resources/{{ $resource->id }}/edit">Edit</a>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_resource">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete_resource" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dp-modalLabel">Delete the resource</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            are you sure of this
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a class="btn btn-danger" href="/resources/d/{{ $resource->id }}">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Side --}}
            <div class="col-3 d-none d-lg-block">
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset("js/post-scripts.js") }}"></script>
    <script type="text/javascript">
        bringFullLifeToLinks("post_content");
    </script>
@endpush