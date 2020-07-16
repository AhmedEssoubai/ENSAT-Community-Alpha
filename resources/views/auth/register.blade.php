@extends('layouts.app')

@section('content')
<div>
    <section id="login">
        <div id="login_c" class="container px-0">
            <div class="row mx-0">
                <div id="forme" class="col-md-6 offset-sm-6 p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h2 class="pt-5 pb-3">
                            {{ __('Register') }}
                        </h2>

                        <h4 class="mb-5">
                            <button id="btn-std" type="button" onclick="account_type(0)">Student</button>
                            /
                            <button id="btn-prf" type="button" onclick="account_type(1)">Professor</button>
                        </h4>

                        <input type="hidden" name="atype" value="{{ old('atype', '0') }}" />
                        <div id="std-inputs">
                            <div class="form-group my-3">
                                <label for="class">Class :</label>
                                <select id="class" name="class" class="form-control @error('class') is-invalid @enderror">
                                    <option @if(old('class') == 'MBISD1') selected @endif value="MBISD1">MBISD1</option>
                                    <option @if(old('class') == 'MBISD2') selected @endif value="MBISD2">MBISD2</option>
                                    <option @if(old('class') == 'MSCEE1') selected @endif value="MSCEE1">MSCEE1</option>
                                    <option @if(old('class') == 'MSCEE2') selected @endif value="MSCEE2">MSCEE2</option>
                                    <option @if(old('class') == 'MCSC1') selected @endif value="MCSC1">MCSC1</option>
                                    <option @if(old('class') == 'MCSC2') selected @endif value="MCSC2">MCSC2</option>
                                    <option @if(old('class') == 'MPSI1') selected @endif value="MPSI1">MPSI1</option>
                                    <option @if(old('class') == 'MPSI2') selected @endif value="MPSI2">MPSI2</option>
                                </select>
                            </div>
                            <div class="form-groupe my-3">
                                <label class="control-label" for="std-id">Student id : </label>
                                <input id="std-id" name="std-id" type="text" class="form-control @error('std-id') is-invalid @enderror" placeholder="Entrez votre id" value="{{ old('std-id') }}" required autocomplete="std-id" />
    
                                @error('std-id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div id="prf-inputs">
                            <div class="form-groupe my-3">
                                <label class="control-label" for="prf-id">Professor id : </label>
                                <input id="prf-id" name="prf-id" type="text" class="form-control @error('prf-id') is-invalid @enderror" placeholder="Entrez votre id" value="{{ old('prf-id') }}" required autocomplete="prf-id" />

                                @error('prf-id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="lastname">Last name : </label>
                            <input id="nom" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Entrez votre nom" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus />

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="firstname">First name :</label>
                            <input id="firstname" name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" placeholder="Entrez votre prénom" value="{{ old('firstname') }}" required autocomplete="firstname" />

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="email">{{ __('E-Mail Address') }} :</label>
                            <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Entrez vote email" value="{{ old('email') }}" required autocomplete="email" />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  my-3">
                            <label for="password">{{ __('Password') }} :</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Tapez votre mot de passe" required autocomplete="password" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  my-3">
                            <label for="password_confirmation">{{ __('Confirm Password') }} :</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Veuillez confimer votre mot de passe" required autocomplete="password_confirmation" />
                        </div>
                        <div class="form-groupe mt-5">
                            <button type="submit" class="btn btn-primary btn-lg form-control">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5 class="text-secondary">
                        Si vous possédez déjà un compte. <a href="{{ route('login') }}" class="_link">Se connecter</a>
                    </h5>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    var type = 0;

    account_type(document.getElementsByName("atype").value);

    function account_type(t)
    {
        type = t;
        if (type === 1)
        {
            document.getElementById("prf-inputs").classList.remove("d-none");
            document.getElementById("std-inputs").classList.add("d-none");
            document.getElementById("btn-prf").classList.remove("btn-link");
            document.getElementById("btn-std").classList.remove("btn-link-na");
            document.getElementById("btn-std").classList.add("btn-link");
            document.getElementById("btn-prf").classList.add("btn-link-na");
            document.getElementById("std-id").required = false;
            document.getElementById("prf-id").required = true;
        }
        else
        {
            document.getElementById("std-inputs").classList.remove("d-none");
            document.getElementById("prf-inputs").classList.add("d-none");
            document.getElementById("btn-std").classList.remove("btn-link");
            document.getElementById("btn-prf").classList.remove("btn-link-na");
            document.getElementById("btn-prf").classList.add("btn-link");
            document.getElementById("btn-std").classList.add("btn-link-na");
            document.getElementById("std-id").required = true;
            document.getElementById("prf-id").required = false;
        }

    }
</script>
@endsection
