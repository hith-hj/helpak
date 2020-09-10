<div class="card card-primary card-outline mt-1 " id="homePanel" >
    <div class="">
        @if(isset($info))
            <div class="card-full">
                <a href="/profile/{{$info->id}}" data-turbolinks-action="replace">
                    @if(Auth::user()->image != 'image.jpg')
                        <div class="fill" style=";background-image: url('../../../storage/users_images/{{Auth::user()->image}}');"></div>  
                    @else 
                    <div class="fill" style=";background-image: url('../../../storage/users_images/{{Auth::user()->image}}');
                    background-size: contain;background-repeat: no-repeat;background-position-x: center;"></div>
                    @endif
                </a>
                <div class="col-auto">
                    <p class="text-muted text-center">
                        @for($i = 0 ; $i<=$info->rate ; $i+= $info->rate/($info->rate/100))
                        <i class="fa fa-star fa-xs " style="color:gold;font-weight: 600;font-size: .5rem;" data-toggle="tooltip" title="gold star"></i>
                        @endfor
                    </p>
                </div>            
            </div>
            <div class="card-body ">
                <div class="p-0" style="display: block;">
                    <ul class="products-list product-list-in-card px-1" style="text-align:right">
                        <a href="{{route('home')}}">
                            <li class="list-group-item mt-1 " onclick="setNav('#homebtn')" id="homebtn">
                                <h6 style="color:#000">  {{__('ar.Home')}} <i class="fa fa-home fa-xs ml-1 "></i> </h6>
                            </li>
                        </a>
                        <a href="{{route('chats')}}">
                            <li class="list-group-item mt-1" onclick="setNav('#messagebtn')" id="messagebtn">
                                <h6 style="color:#000"> {{__('ar.Chats')}} <i class="fa fa-comments fa-xs ml-1 "></i></h6>
                            </li>
                        </a>
                        <a href="{{route('asks')}}">
                            <li class="list-group-item mt-1" onclick="setNav('#asksbtn')" id="asksbtn">
                                <h6 style="color:#000">{{__('ar.Asks')}} <i class="fa fa-paper-plane fa-xs ml-1 "></i></h6>
                            </li>
                        </a>
                        <a href="{{route('saved')}}">
                            <li class="list-group-item my-1" onclick="setNav('#savedbtn')" id="savedbtn">
                                <h6 style="color:#000">{{__('ar.Saved Posts')}} <i class="fa fa-save fa-xs ml-1 "></i></h6>
                            </li>
                        </a>
                    </ul>
                </div>            
            </div>     
        @else 
            none is available
        @endif
        <hr>
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