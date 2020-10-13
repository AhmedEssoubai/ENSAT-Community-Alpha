@extends('layouts.app')

@section('content')
<section class="pt-3 pb-5 text-left page-spacing bg-light">
    <div class="container pt-3">
        <div class="row mx-3 mt-2 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black">Pending</h3>
                <p class="text-muted">
                    There are <span id="count">{{ $pending->count() }}</span> @if ($user_tab_index == 0) students @else professors @endif in pending
                </p>
            </div>
        </div>
        <div id="list" class="row mt-3">
            @foreach($pending as $user)
                <div id="pending{{ $user->id }}" class="col-md-6 my-3 d-flex align-content-stretch">
                    <div class="course-card m-1 flex-grow-1">
                        <div class="p-4 w-100">
                            <div class="d-flex align-items-center">
                                <div class="pr-3">
                                    <img src="{{ $user->image }}" class="img-fluid rounded-circle" width="78px"/>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                                    @if ($user_tab_index == 0)
                                        <p class="text-mgray">{{ $user->profile->classe->label }}</p>
                                    @endif
                                </div>
                                <div class="align-self-center d-flex">
                                    <div class="mx-4 icon-g"><a title="Accept" onclick="action('{{ route('admin.users.accept', ['user' => $user->id]) }}', {{ $user->id }})"><span><i class="fa fa-check"></i></span></a></div>
                                    <div class="mx-3 icon-r"><a title="Reject" onclick="action('/users/d/{{ $user->id }}', {{ $user->id }})"><span><i class="fa fa-times"></i></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($pending->count() == 0)
            <div class="col text-muted text-center py-2 px-2">
                <h2 class="my-3" style="font-size: 3em"><i class="fab fa-cloudversify"></i></h2>
                <h4 class="my-3">No users in pending list</h4>
            </div>
            @endif
        </div>
        <div class="rkm-line mt-5"></div>
        <div class="row mx-3 mt-5 mb-3 pb-3 d-flex justify-content-between">
            <div>
                <h3 class="text-black">Members</h3>
                <p class="text-muted">
                    There are {{ $members->count() }} member
                </p>
            </div>
        </div>
        <div class="row mt-3">
            @foreach($members as $user)
                <div id="member{{ $user->id }}" class="col-md-6 my-3 d-flex align-content-stretch">
                    <div class="course-card m-1 flex-grow-1">
                        <div class="p-4 w-100">
                            <div class="d-flex align-items-center">
                                <div class="pr-3">
                                    <img src="{{ $user->image }}" class="img-fluid rounded-circle" width="78px"/>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                                    @if ($user_tab_index == 0)
                                        <p class="text-mgray">{{ $user->profile->classe->label }}</p>
                                    @endif
                                </div>
                                <div class="d-flex pr-3 align-items-center dropdown">
                                    <span class="icon-mute" id="member_{{ $user->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="member_{{ $user->id }}_options">
                                        <a class="dropdown-item" href="/users/d/{{ $user->id }}">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($members->count() == 0)
            <div class="col text-muted text-center py-2 px-2">
                <h3 class="col my-4 text-muted text-center"><i class="far fa-frown"></i> The community is empty</h3>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        var count = {{ $pending->count() }};
    </script>
    <script src="{{ asset('js/admin-users-scripts.js') }}"></script>
@endpush