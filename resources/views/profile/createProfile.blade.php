@extends('layouts.app')
@section('content')
{{-- @if(count($errors)>0 && $errors->any())
    <div class="row">
        @foreach($errors->all() as $error )
            {{$error}}
        @endforeach
    </div>
@endif --}}
@if(App::getLocale() == 'ar')
    <div class="row" style="text-align:right">
@else 
    <div class="row" style="text-align:left">
@endif
    <div class="col-md-2"></div>
    <div class="col-md-8 card p-2 m-2">
        <div class="w-100 mt-2">
            <div class="alert alert-primary" role="alert" style="background-color: #00647f !important;">
              <h4 class="alert-heading">{{__('ar.thanks')}}</h4>
              <p>{{__('ar.made it')}} </p>
              <hr>
              <p class="mb-0">{{__('ar.fill profile')}}</p>
            </div>
          </div> 
        <form class="needs-validation mt-1" action="/getinformation" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.fName')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="first_name" placeholder="First"  
                            value="{{old('first_name')}}" style="@error('first_name') border:2px solid red @enderror ">
                    </div>
                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.lName')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="last_name" placeholder="Last"
                            value="{{old('last_name')}}" style="@error('last_name') border:2px solid red @enderror " >
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.Gender')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <select class="form-control" id="exampleFormControlSelect1" name="gender">
                            <option>{{__('ar.male')}}</option>
                            <option>{{__('ar.female')}}</option>
                        </select>
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.pAge')}}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="numeric" class="form-control" name="age" placeholder="Age" 
                            value="{{old('age')}}" style="@error('age') border:2px solid red @enderror " >
                    </div>                    
                </div>
                <div class="col-md-6 mb-1">
                    <label for="">{{__('ar.pImage')}}</label>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span id="span" class="input-group-text">Profile Picture</span>
                          <img id="pImage" style="display:none;height:40px !important;width:40px !important;border-radius:8px;" class=" img-sm" alt="">
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile_picture" onchange="
                          var img = document.querySelector('#pImage')
                          img.setAttribute('src',window.URL.createObjectURL(files[0]))
                          img.style.display='block'
                          document.querySelector('#span').style.display='none'
                          ">
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
                        <input type="text" class="form-control" inputmode="numeric" name="phone" placeholder="Phone" pattern="(09){1}\d{8}" 
                            value="{{old('phone')}}" style="@error('phone') border:2px solid red @enderror " 
                            title="دخل رقم سوري شغال ">

                    </div>                    
                </div>
                <div class="col-md-12 ">
                    <div class="form-row">
                        <div class="col-md-3 mb-1">
                            <label for="">{{__('ar.city')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                </div>                                
                                <select class="form-control" name="city" style="@error('city') border:2px solid red @enderror ">
                                    <option>Damascus</option>
                                    <option>Alepo</option>
                                    <option>Latakia</option>
                                    <option>Tartos</option>
                                    <option>Homs</option>
                                    <option>Daraa</option>
                                    <option>Swida</option>
                                    <option>Hasaka</option>
                                    <option>dir Alzor</option>
                                </select>                    
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-1">
                            <label for="validationTooltip04">{{__('ar.area')}}</label>
                            <input type="text" class="form-control" name="area" 
                                    style="@error('area') border:2px solid red @enderror " placeholder="Area" value="{{old('area')}}">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="">{{__('ar.fAddress')}} ({{__('ar.details')}})</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map"></i></span>
                                </div>
                                <input type="text" class="form-control" name="full_address"
                                    style="@error('full_address') border:2px solid red @enderror " placeholder="Details" value="{{old('full_address')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <label for="">{{__('ar.pDescription')}} </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                        </div>
                    <textarea type="text" class="form-control" name="bio" placeholder="Bio" 
                            style="@error('bio') border:2px solid red @enderror " >{{old('bio')}}</textarea>
                    </div>
                </div>
            </div>            
            <button class="btn btn-primary col-12" type="submit">Done</button>
            @csrf
        </form>
    </div>
</div>

@endsection