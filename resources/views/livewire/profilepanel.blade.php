<div class="card mb-5" >
    <div class="" id="fixedProfile" style="border-radius: 5px;">
        <div class="card-header ">
            <div class="dis-flex " style="float: right">
                <div>
                    <h4 class="widget-user-username mr-2"><small>(&{{$info->name}})</small> {{$info->firstName}} {{$info->lastName}} </h4>
                    <h6 class="widget-user-desc mr-2">Bio : {{$info->about}}</h6>
                </div>
                <div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="../storage/users_images/{{$info->image}}" alt="User Avatar" style="width:60px;height: 60px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-widget widget-user">           
                <div class="box-footer ">
                <div style="display: flex">
                    <div class="col-sm-4 border-right">
                        <div class="description-block" >
                            <h5 class="description-header">{{$info->service}}</h5>
                            <span class="description-text">Service</span>
                        </div>                
                    </div>                    
                    <div class="col-sm-4 border-right">
                        <div class="description-block"style="margin: 3px 0 !important;">                           
                            <small class="description-header ">
                            @for($i = 0 ; $i<=$info->rate ; $i+= $info->rate/($info->rate/100))
                            <i class="fa fa-star fa-xs " style="color:gold;font-weight: 600;font-size: .6rem;" data-toggle="tooltip" title="gold star"></i>
                            @endfor
                            </small><br>
                            <span class="description-text">Rate</span>
                        </div>                
                    </div>
                    
                    <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">{{$info->dakish}}</h5>
                        <span class="description-text">Dakish</span>
                    </div>                
                    </div>       
                </div>      
                </div>
                <div class="box-footer ">
                <div class="dis-flex">
                @if($user_id != Auth::user()->id)
                    @if($info->allowedRate == true && $info->setting->can_rate !== 'no' )
                        <div class="col-sm-6">
                        <div class="description-block">
                            <span class="description-text">
                            <button class="btn btn-default form-control" wire:click="rateUser()">
                                <i class="far fa-thumbs-up mr-1"></i> {{__('ar.Rate')}}
                            </button>
                            </span>
                        </div>                
                        </div>
                    @else 
                        <div class="col-sm-6">
                        <div class="description-block">
                            <span class="description-text">
                            <button class="btn btn-default form-control" 
                                data-toggle="tooltip" title="Rate is blocked for until {{$info->nextDateToAllow}}" disabled>
                                <i class="fa fa-ban mr-1"></i> {{__('ar.Rate')}}
                            </button>
                            </span>
                        </div>                
                        </div>
                    @endif
                    @if($info->setting->can_send_message !== 'no' )
                        <div class="col-sm-6">
                        <div class="description-block">
                            <span class="description-text">
                            <button class="btn btn-default form-control" wire:click="$set('message', true)">
                                <i class="far fa-comment mr-1"></i> {{__('ar.Message')}}
                            </button>
                            </span>
                        </div>                            
                        </div>
                    @endif
                    @endif
                </div>
                @if($message == true)
                    <div class="">
                    <div class="row float-right">
                        <button class="btn btn-sm" wire:click="sendMessage()"><i class="fa fa-check"></i></button>
                        <button class="btn btn-sm" wire:click="$set('message', false)" ><i class="fa fa-times"></i></button>
                    </div> 
                    <textarea type="text" wire:transition.slide.down class="form-control form-control-sm input-group-text my-2" wire:model="msgContent" wire:keydown.enter.prevent="sendMessage()"></textarea>
                    </div> 
                @endif 
                </div>
            </div>
        </div>
        @if(isset($info))
            <div class="card-body box-profile" style="border-top:1px solid #d2cdcd">             
                <div class="" >                  
                    <div class="card-body p-0" style="display: block;text-align: right; " >
                        <ul class="products-list product-list-in-card px-2" dir="rtln">
                            <li class=" mt-1">
                                <a class="">{{$info->rate}} : </a><b >{{__("ar.Points")}}</b><i class="far fa-star ml-2"></i> 
                            </li> 
                            <li class=" mt-1">
                                <a class="">{{$info->email}} : </a><b >{{__("ar.Email")}}</b><i class="far fa-envelope ml-2"></i> 
                            </li> 
                            <li class=" mt-1">
                                <a class="">{{$info->gender}} : </a> <b>{{__('ar.Gender')}} </b> <i class=" float-right far fa-user ml-2"></i> 
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->age}} : </a> <b>{{__('ar.Age')}} </b> <i class=" ml-2 float-right far fa-clock"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->phone}} : </a> <b>{{__('ar.Uphone')}} </b> <i class=" ml-2 float-right fa fa-phone" style="color:#000"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->address}} : </a> <b>{{__('ar.Uaddress')}} </b> <i class=" ml-2 float-right far fa-map"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class=""> ( {{$info->created_at->diffForHumans()}} ) {{$info->created_at->format('M d ')}}  : </a> <b>{{__('ar.with')}}</b> <i class=" ml-2 float-right far fa-calendar"> </i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->service}} : </a><b>{{__('ar.Services')}}</b> <i class=" ml-2 float-right fa fa-hand-holding-heart fa-sm " style="color:#000" ></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->dakish}} : </a><b>{{__('ar.Dakish')}}</b> <i class=" ml-2 float-right far fa-handshake fa-sm " ></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->likes}} : </a><b>{{__('ar.Likes')}}</b> <i class=" ml-2 float-right far fa-star"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->redos}} : </a> <b>{{__('ar.Redos')}}</b> <i class=" ml-2 float-right fa fa-retweet" style="color:#000"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->asks}} : </a><b>{{__('ar.Asks')}}</b> <i class=" ml-2 float-right far fa-paper-plane"></i>  
                            </li>
                            <li class=" mt-1">
                               <a class="">{{$info->links}} : </a><b>{{__('ar.Links')}}</b>  <i class=" ml-2 float-right fa fa-link" style="color:#000"> </i>  
                            </li>
                        </ul>
                    </div>
                </div>
                @if($info->user_id == Auth::user()->id)
                <a href="/profile/{{$info->id}}" data-turbolinks-action="replace" class="btn btn-primary btn-block mt-2"><b>Edit my info</b></a>
                @endif
            </div>     
        @else 
            none is available
        @endif
    </div>
</div>

{{-- 
                              bronze #cd7f32
                              silver #aaa9ad
                              gold   #d4af37
                              platinum #e5e4e2
                              dark platinum #584f3f 
                              diamond #b9f2ff
                              --}}