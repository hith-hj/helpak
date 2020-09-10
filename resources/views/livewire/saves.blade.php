<div class="mt-2">
    @if($saves != null && count($saves) > -1 && count($saves) > 0 )
        @foreach($saves as $save)
        <div class="card ">
            <div class="card-header" style="border-radius:5px;border-top:4px solid {{$save->type == 'ask'?'#009e80':'#00647b'}};padding-left:.5rem !important;">          
            <div class="user-block">
                        <img class="img-circle" src="../storage/users_images/{{$save->user_info->image}}" height="40" width="40" >
                        <span class="username">
                        <a href="/profile/{{$save->user_info->id}}" data-turbolinks-action="replace" >
                            <h5 style="font-weight:600;color:black;">{{$save->user_info->name}}</h5>
                        </a>
                        </span>                        
                        <span class="description">{{__('ar.Saved at')}} - {{$save->created_at->diffForHumans()}}</span>           
            </div> 
            <div class="card-tools">
                <div class="dropdown" >
                    @if($save->post_type == 'service')
                        <i class="fa fa-hand-holding-heart" style="color:#009e80" data-toggle="tooltip" title="this post is a service from a good person"></i>
                    @else 
                        <i class="far fa-handshake" style="color:#00647b" data-toggle="tooltip" title="this post is a Dakish"></i>
                    @endif                                              
                    <button type="button" class="btn btn-tool" data-toggle="dropdown"><i class="fa fa-ellipsis-v "></i></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="btn btn-default dropdown-item" wire:click="deleteSave({{$save->id}})"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete')}}</a>                           
                    </div>                        
                </div>                      
            </div>          
            </div>
            <div class="card-body">              
                <a href="/post/show/{{$save->post_id}}/{{$save->post_type}}" style="color:black"><p>{{$save->post_info->content}}</p>
                <small>Post Created at - {{$save->post_info->created_at->diffForHumans()}}</small></a>
            </div>
        </div>    
        @endforeach
    @else 
        @php 
            $trans = __('ar.Nothing yet');
        @endphp
        <div class="box-header with-border nothing-yet">
            @if(preg_match('/[اأإء-ي]/ui',$trans ))
                <h6 class="box-title" style="text-align:right">{{__('ar.Saves')}} - {{__('ar.Nothing yet')}} </h6>
            @else 
                <h6 class="box-title" style="text-align:left">{{__('ar.Saves')}} - {{__('ar.Nothing yet')}} </h6>
            @endif
        </div>
    @endif
</div>


