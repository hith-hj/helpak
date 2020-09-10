@extends('layouts.app')
@section('content')

<div class="row ">
    <div class="col-md-2"></div>
    @if(App::getLocale() == 'ar')
    <div class="col-md-8 card p-2 m-2 " style="max-height:40rem;overflow-y:auto;text-align:right">
    @else 
        <div class="col-md-8 card p-2 m-2 " style="max-height:40rem;overflow-y:auto;">
    @endif
    
        @if($message == 'success')
            <span class="alert alert-success">
                <strong class="text-light">
                    {{$message}}
                </strong>
            </span>
        @endif
        <form class="needs-validation mt-3" action="/updateProfile" method="POST" enctype="multipart/form-data">
 
            <div class="form-row">
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.fName')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="first_name" placeholder="First"  
                            style="@error('first_name') border:2px solid red @enderror " value="{{Auth::user()->firstName}}">
                    </div>
                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.lName')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="last_name" placeholder="Last"
                             style="@error('last_name') border:2px solid red @enderror " value="{{Auth::user()->lastName}}">
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.Gender')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" ><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="" value="{{Auth::user()->gender}}" class="form-control" disabled>
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.pAge')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                        <input type="numeric" class="form-control" name="age" placeholder="Age" 
                            style="@error('age') border:2px solid red @enderror " value="{{Auth::user()->age}}">
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.pImage')}}</label>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend" style="">
                          <span class="input-group-text" style="padding: .1rem .75rem !important;"><img class="img-circle img-sm" src="../../storage/users_images/{{Auth::user()->image}}" alt=""></span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile_picture">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>            
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.pPhone')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                        </div>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" pattern="(09)[2-9]{8}" 
                            style="@error('phone') border:2px solid red @enderror " value="{{Auth::user()->phone}}">
                    </div>                    
                </div>
                <div class="col-md-12 ">
                    <label for="">{{__('ar.fAddress')}} ({{__('ar.details')}})</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                        </div>
                    <textarea type="text" class="form-control" name="address" placeholder="Bio" 
                            style="@error('bio') border:2px solid red @enderror ">{{Auth::user()->address}}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <label for="">{{__('ar.pDescription')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                        </div>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio" 
                            style="@error('bio') border:2px solid red @enderror ">{{Auth::user()->about}}</textarea>
                    </div>
                </div>
            </div>            
            <button class="btn btn-primary col-12 my-2" type="submit">Save</button>
            @csrf
        </form>
    </div>
</div>
@endsection
                    