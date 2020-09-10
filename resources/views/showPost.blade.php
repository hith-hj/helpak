@extends('layouts.app')
@section('content')
{{-- <div id="firstNavigation">@livewire('navbar',Auth::user()->id)</div>  
<div id="secondNavigation">@livewire('secondnav',Auth::user()->id)</div> --}}
@auth
{{-- @livewire('feeds'); --}}
@livewire('showpost',$id,$type) 
@else 
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            opssss..
            <div class="links"><label>it's look like you are not signed in or no registerd yet </label></div>
            
        </div>
    </div>
</div>

@endauth


@endsection