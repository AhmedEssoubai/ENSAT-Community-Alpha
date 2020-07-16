@extends('layouts.app')

@section('content')
<section id="content" class="py-5 text-left mx-auto">
    <div class="container pt-5 mt-3">
        <div class="row bg-white shadow-sm">
            <div class="col p-0 border">
                <div id="cover" style="background-image: url('{{ $groupe->image }}')"></div>
                <div class="container p-4">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h2 class="mb-3 text-primary">
                                {{ $groupe->label }}
                            </h2>
                            <p class="lead mt-2">
                                Students : {{ $groupe->members_count() }}
                            </p>
                        </div>
                    </div>
                    <ul id="groupe-nav" class="nav nav-pills nav-fill border">
                        <li class="nav-item">
                          <a class="nav-link active p-3" href="#"><i class="fas fa-users mr-2"></i> Community</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-3" href="#"><i class="fas fa-book mr-2"></i> Documents</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-3" href="#"><i class="fas fa-clipboard-list mr-2"></i> Assigments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @yield('content-2')
        </div>
    </div>
</section>
@endsection