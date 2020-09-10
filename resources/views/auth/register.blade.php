@extends('layouts.app')

@section('content')
<div class="container mt-5 animated fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="cardz">
                <div class="card-header" style="text-align:center;font-size:35px;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="col-md-6 offsetx-4" id="input1">
                                <label for="name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                 style="border-radius: 30px;">   

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6 offsetx-4" id="input2">
                                <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                 style="border-radius: 30px;">   

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6 offsetx-4" id="input3">
                                <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                                 style="border-radius: 30px;">   

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6 offsetx-4" id="input4">
                                <label for="password-confirm" class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                                 style="border-radius: 30px;">   
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-12 mt-2" style="border-radius:30px">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function response(){
        let wid = window.innerWidth || document.body.clientWidth
        var div1 = document.querySelector("#input1")
        var div2 = document.querySelector("#input2")
        var div3 = document.querySelector("#input3")
        var div4 = document.querySelector("#input4")
        if(wid > 660)
        {
            div1.classList.remove('col-md-4')
            div2.classList.remove('col-md-4')
            div3.classList.remove('col-md-4')
            div4.classList.remove('col-md-4')
            div1.classList.add('offset-2','col-md-8')
            div2.classList.add('offset-2','col-md-8')
            div3.classList.add('offset-2','col-md-8')
            div4.classList.add('offset-2','col-md-8')
        }else{
            div1.classList.add('col-md-4')
            div2.classList.add('col-md-4')
            div3.classList.add('col-md-4')
            div4.classList.add('col-md-4')
            div1.classList.remove('col-md-8','offset-2')
            div2.classList.remove('col-md-8','offset-2')
            div3.classList.remove('col-md-8','offset-2')
            div4.classList.remove('col-md-8','offset-2')
        }
    }
    window.addEventListener('resize',response)
    window.addEventListener('load',response)
</script>