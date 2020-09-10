@extends('layouts.app')
@section('content')
<div style="overflow-x: hidden;">
    {{-- <div class="col-md-12 wide" > 
            @livewire('profile',$id)                             
    </div> --}}
    <div class="col-md-12 mt-0 flex wide row" id="profiel123">
        @if(Auth::user()->id == $id)
            <div class="col-md-7 wide" >
                @livewire('posts',$id) 
            </div>
            <div class="col-md-5 wide " id="profileInfoPanel">            
                @livewire('profilepanel',$id)
            </div>
        @elseif($setting->can_see_myinfo == 'no' && $setting->can_see_mypost == 'no')
            <div class="col-md-12 wide h-100 bg-light">
                <div class="dis-flex m-2">
                    <div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="../storage/users_images/{{$user->image}}" alt="User Avatar" style="width:60px;height: 60px;">
                        </div>
                    </div>
                    <div>
                        <h4 class="widget-user-username ml-2">{{$user->firstName}} {{$user->lastName}} <small>(&{{$user->name}})</small></h4>
                        <h6 class="widget-user-desc ml-2">Bio : {{$user->about}}</h6>
                        <p class=" ml-2 ">Sorry but this user is privacy lover </p>
                    </div>
                </div>                
            </div>
        @else
            @if($setting->can_see_mypost == 'links' &&  $setting->links == 'yes' || $setting->can_see_mypost == 'yes')
            <div class="col-md-7 wide"  >
                @livewire('posts',$id) 
            </div>
            @else 
            <div class="col-md-7 wide h-50">
                <p class="form-control mt-1 ">Post is private</p>
            </div>
            @endif
            @if($setting->can_see_myinfo == 'links' && $setting->links == 'yes' || $setting->can_see_myinfo == 'yes')
            <div class="col-md-5 wide" id="profileInfoPanel" >            
                @livewire('profilepanel',$id)
            </div>
            @else
            <div class="col-md-5 wide h-25">
                <p class="form-control mt-1 ">Info is private</p>
            </div>
            @endif
        @endif
    </div>
</div> 
    
@endsection
