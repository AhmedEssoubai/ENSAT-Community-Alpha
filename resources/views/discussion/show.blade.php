@extends('layouts.app')

@section('content')
<section id="content" class="pt-3 pb-5 text-left mx-auto bg-white page-spacing">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-9 p-0">
                <div class="post">
                    <div class="mr-3 avatar-40">
                        <img src="{{ $discussion->user->image }}" alt="profile image" class="img-fluid rounded-circle" />
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <strong class="text-black my-0 mr-2">{{ $discussion->user->firstname }} {{ $discussion->user->lastname }}</strong>
                                <strong class="text-mgray mr-2"> • </strong>
                                <small class="text-mgray">8 days ago</small>
                            </div>
                            <div class="d-flex align-items-center text-lgray">
                                <div class="d-flex mr-3">
                                    <span class="mr-2"><i class="fa fa-heart"></i></span>
                                    <span id="likes_{{ $discussion->id }}">{{ $discussion->favorited_users->count() }}</span>
                                </div>
                                <div class="d-flex mr-3">
                                    <span class="mr-2"><i class="fas fa-comment"></i></span>
                                    <span id="count">{{ $discussion->comments->count() }}</span>
                                </div>
                                <div>
                                    <a class="rbo-primary">GENERAL</a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h4 class="text-black mb-3">{{ $discussion->title }}</h4>
                            <p class="text-mgray mb-3">{{ $discussion->content }}</p>
                            @if (!empty($discussion->image))
                                <img src="/storage/{{ $discussion->image }}" class="img-fluid mb-3" alt="discussion image">
                            @endif
                            <div class="d-flex">
                                <div id="fa_{{ $discussion->id }}_fav" class="icon-hidden text-mgray mr-2
                                    @if ($discussion->is_liked())
                                        active
                                    @endif"  onclick="favorite({{ $discussion->id }})">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex ml-2 align-items-center dropdown">
                                    <small class="text-mgray icon-hidden" id="discussion_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></small>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="discussion_options">
                                        {{--<a class="dropdown-item" href="/discussions/{{ $discussion->id }}/editer">Edit</a>--}}
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_discussion">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post">
                    <input type="text" id="cmt_content" class="rkm-input mr-4 flex-grow-1" placeholder="Engage with the discussion..."/>
                    <button type="button" class="rb-primary px-4" onclick="addComment({{ $discussion->id }}, '{{ Auth::user()->image }}', '{{ Auth::user()->firstname }}' + ' ' + '{{ Auth::user()->lastname }}')">Replay</button>
                </div>
                <div id="comments">
                    @foreach($discussion->comments as $comment)
                    <div id="c_{{ $comment->id }}" class="post">
                        <div class="mr-3 avatar-40">
                            <img src="{{ $comment->user->image }}" alt="profile image" class="img-fluid rounded-circle" />
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center">
                                <strong class="text-black my-0 mr-2">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</strong>
                                <strong class="text-mgray mr-2"> • </strong>
                                <small class="text-mgray">8 days ago</small>
                            </div>
                            <div class="mt-3">
                                <p class="text-mgray mb-3">{{ $comment->content }}</p>
                                <div class="d-flex">
                                    <div class="d-flex ml-2 align-items-center dropdown">
                                        <small class="text-mgray icon-hidden" id="cmt_{{ $comment->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></small>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cmt_{{ $comment->id }}_options">
                                            @if ($comment->can_edit(Auth::user()))
                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#edit_comment" data-id="{{ $comment->id }}">Edit</button>
                                            @endif
                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_comment" data-id="{{ $comment->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-4">
                    <div class="modal fade" id="edit_comment" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Modifier le commentaire</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input id="comment-id" type="hidden" />
                                    <textarea class="form-control" id="comment-text"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="editComment()">Mettre à jour le commentaire</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete_comment" tabindex="-1" role="dialog" aria-labelledby="dc-modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <input id="d-comment-id" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dc-modalLabel">Delete a comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    are you sure of this
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteComment()">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete_discussion" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="dp-modalLabel">Delete the discussion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                are you sure of this
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a class="btn btn-danger" href="/discussions/d/{{ $discussion->id }}">Delete</a>
                            </div>
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
@endpush