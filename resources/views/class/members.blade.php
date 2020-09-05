@extends('layouts.app')

@section('content')
<section id="content" class="py-5 text-left mx-auto">
    <div class="container pt-3">
        <div class="row my-3 border-bottom py-3">
            <div class="col d-flex justify-content-between">
                <h2 class="text-muted">Professors</h2>
                <h5 class="align-self-end">
                    <span class="icon-mute" role="button" data-target="#new_professor" data-toggle="modal"><i class="fas fa-user-plus"></i></span>
                </h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6 my-3">
                <div class="d-flex bg-white shadow-sm p-4 align-items-center">
                    <div class="pr-3">
                        <img src="{{ $class->chef->user->image }}" class="img-fluid rounded-circle" width="78px"/>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <h5>{{ $class->chef->user->firstname }} {{ $class->chef->user->lastname }}</h5>
                    </div>
                </div>
            </div>
            @foreach($class->professors as $professor)
                <div id="professor{{ $professor->id }}" class="col-md-6 my-3 p-4">
                    <div class="d-flex bg-white shadow-sm p-4 align-items-center">
                        <div class="pr-3">
                            <img src="{{ $member->image }}" class="img-fluid rounded-circle" width="78px"/>
                        </div>
                        <h4 class="flex-grow-1">{{ $professor->firstname }} {{ $professor->lastname }}</h4>
                        <div class="d-flex pr-3 align-items-center dropdown">
                            <span class="icon-mute" id="member_{{ $member->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="member_{{ $member->id }}_options">
                                <a class="dropdown-item" href="/users/d/{{ $member->id }}">Ejecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade" id="new_professor" tabindex="-1" role="dialog" aria-labelledby="new_professor_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new_professor_title">Add professors</h5>
                    </div>
                    <div class="modal-body p-3">
                        <div id="selected_list" class="d-flex flex-wrap">
                            <input id="search_input" class="free lead flex-grow-1" maxlength="45"/>
                        </div>
                        <div class="border-bottom my-4"></div>
                        <div id="empty_list" class="p-3 align-items-center d-none">
                            <h6 class="text-muted"><span class="mr-3 lead"><i class="fas fa-user-slash"></i></span>Oops! no professor found</h6>
                        </div>
                        <div id="results_list" class="py-3 container overflow-auto" style="height: 40vh"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="send_members" type="button" class="btn btn-primary">Add</button>
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