@extends('layouts.app')

@section('content')
<div class="container mt-5 an1 animated slideInDown">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="cardz">
                <div class="card-header" style="text-align:center;font-size:35px;" >{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            

                            <div class="col-md-8 offsetx-2" id="input1">
                                <label for="email" class="ml-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" 
                                style="border-radius: 30px;" placeholder="Username@company.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            

                            <div class="col-md-8 offsetx-2" id="input2">
                                <label for="password" class="ml-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                style="border-radius: 30px;" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-md-3 offset-md-4 mt-2 pl-3 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                             <div class="col-md-4 pr-2">
                                
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div> 
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-12 mt-3" style="border-radius: 30px">
                                    {{ __('Login') }}
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

<style>
    .an1{
        transition: all .9s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
</style>

<script>
    function response(){
        let wid = window.innerWidth || document.body.clientWidth
        var div1 = document.querySelector("#input1")
        var div2 = document.querySelector("#input2")
        if(wid > 660)
        {
            div1.classList.remove('col-md-4')
            div2.classList.remove('col-md-4')
            div1.classList.add('offset-2' ,'col-md-8')
            div2.classList.add('offset-2','col-md-8')
        }else{
            div1.classList.add('col-md-4')
            div2.classList.add('col-md-4')
            div1.classList.remove('col-md-8','offset-2')
            div2.classList.remove('col-md-8','offset-2')
        }
    }
    window.addEventListener('resize',response)
    window.addEventListener('load',response)
</script>