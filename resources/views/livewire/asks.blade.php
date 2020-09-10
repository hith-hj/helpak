<div class="mt-2" >
  <div class="nav nav-pills nav-justified bg-light rounded-sm">
    <span class="nav-item nav-link " wire:click.prevent="$set('typeAsk', 'reciver_id')" >{{__('ar.Recived')}}</span>
    <span class="nav-item nav-link " wire:click.prevent="$set('typeAsk', 'sender_id')" >{{__('ar.Sent')}}</span>
  </div>
  @if(count($asks)>-1 && count($asks)>0 )
        @foreach($asks as $ask)
          <div class="{{$loop->last ? 'mb-5':''}}" wire:click.prefetch="getAsks">
            @if($ask->reciver_id == Auth::user()->id)
              <div class="card mt-1 {{$loop->last ?'mb-2':''}}">
                <div class="card-header" style="border-radius:5px;border-top:4px solid {{$ask->type == 'ask'?'#009e80':'#00647b'}};padding-left:.5rem !important;">          
                  <div class="user-block">
                    <img class="img-circle" src="../storage/users_images/{{$ask->sender->image}}" height="40" width="40" >
                    <span class="username">
                      <a href="/profile/{{$ask->sender_id}}" data-turbolinks-action="replace" >
                        <h5 style="font-weight:600;color:black;">{{$ask->sender->name}}</h5>
                      </a>
                    </span>                        
                    <span class="description">{{__('ar.Shared')}} - {{$ask->created_at->diffForHumans()}}</span>              
                  </div>
                </div>
                <div class="card-body ml-2">
                  <p>this is {{$ask->type}} on your <a href="{{route('showPost',[$ask->post_id,$ask->post_type])}}" 
                    style="color:black">{{$ask->post_type}} : {{$ask->post}}</a></p>
                  @if($ask->post_type == 'dakish')
                    <p>with message : {{$ask->message}}</p>
                  @endif
                </div>
                <div class="card-footer">
                  @switch($ask->status)
                      @case('waiting')
                          <div class="nav nav-pills nav-justified">
                            <button wire:click="accept({{$ask->id}})" class="btn btn-outline-success nav-item ">{{__('ar.Accept')}}</button>
                            <button wire:click="ignore({{$ask->id}})" class="ml-1 btn btn-outline-dark nav-item ">{{__('ar.Ignore')}}</button>
                            <button wire:click="reject({{$ask->id}})" class="ml-1 btn btn-outline-danger nav-item ">{{__('ar.Reject')}}</button>
                            <button wire:click="delete({{$ask->id}})" class="ml-1 btn btn-outline-danger nav-item ">{{__('ar.Delete Ask')}}</button>
                          </div>
                          @break
                      @case('accepted')
                          <div class="alert alert-success">
                            <small>You accepted this {{$ask->type}}  {{$ask->updated_at->diffForHumans()}} , good for you</small>
                          </div>
                          @break
                      @case('rejected')
                          <div class="alert alert-danger">
                            <small>You rejected this {{$ask->type}}  {{$ask->updated_at->diffForHumans()}}</small>
                          </div>
                          @break
                      @case('ignored')
                            <div class="alert alert-dark row">
                              <label>You ignored this {{$ask->type}} You should Delete it .</label>
                              <button type="submit" wire:click="delete({{$ask->id}})" class="btn btn-outline-dark col-md-4 mx-1">Delete</button>
                            </div>             
                          @break
                      @default                  
                  @endswitch
                </div> 
              </div>
            @else 
              <div class="card m-2 {{$loop->last ?'mb-5':''}}">
                <div class="card-header" style="border-radius:5px;border-top:4px solid {{$ask->type == 'ask'?'green':'blue'}};padding-left:.5rem !important;">          
                  <div class="user-block">
                    <img class="img-circle" src="../storage/users_images/{{$ask->reciver->image}}" height="40" width="40" >
                    <span class="username">
                      <a href="/profile/{{$ask->reciver_id}}" data-turbolinks-action="replace" >
                        <h5 style="font-weight:600;color:black;">{{$ask->reciver->name}}</h5>
                      </a>
                    </span>                        
                    <span class="description">{{__('ar.Shared Publicly')}} - {{$ask->created_at->diffForHumans()}}</span>              
                  </div>
                  {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-toggle="dropdown" ><i class="fa fa-ellipsis-v "></i></button>
                      <div class="dropdown-menu">
                          <a class="btn btn-default dropdown-item " ><i class="fa fa-save mr-2"></i>{{__('ar.Save Post')}}</a>                                
                          <a class="btn btn-default dropdown-item " ><i class="fa fa-copy mr-2"></i> {{__('ar.Copy Link')}}</a>
                          <a class="btn btn-default dropdown-item "><i class="fa fa-ban mr-2"></i> {{__('ar.Report Post')}}</a>                                                   
                      </div> 
                  </div> --}}
                </div>
                <div class="card-body ml-2">
                  <p>you send {{$ask->type}} on <a href="{{route('showPost',[$ask->post_id,$ask->post_type])}}" 
                    style="color:black">{{$ask->post_type}} : {{$ask->post}}</a></p>
                  @if($ask->post_type == 'dakish')
                    <p>with message : {{$ask->message}}</p>
                  @endif
                </div>
                <div class="card-footer">
                  @switch($ask->status)
                      @case('waiting')
                          <div class="alert alert-dark">
                            <small>No Response yet</small>
                          </div>
                          @break
                      @case('accepted')
                          <div class="alert alert-success">
                            <small>this {{$ask->type}} is Accepted {{$ask->updated_at->diffForHumans()}} , good for you</small>
                          </div>
                          @break
                      @case('rejected')
                          <div class="alert alert-danger">
                            <small>this {{$ask->type}} is Rejected {{$ask->updated_at->diffForHumans()}}</small>
                          </div>
                          @break
                      @case('ignored')
                            <div class="alert alert-dark row">
                              <label>Sorry This Request is ignored You can delete it</label>
                              <button type="submit" wire:click="delete({{$ask->id}})" class="btn btn-outline-dark col-md-4 mx-1">Delete</button>
                            </div>             
                          @break
                      @default                  
                  @endswitch
                </div> 
              </div>
            @endif
          </div>        
        @endforeach
      {{-- </div>  --}}
  @else
    @php 
        $trans = __('ar.Nothing yet');
    @endphp
    <div class="box-header with-border nothing-yet mt-1">
        @if(preg_match('/[اأإء-ي]/ui',$trans ))
            <h6 class="box-title" style="text-align:right">{{__('ar.Asks')}} - {{__('ar.Nothing yet')}} </h6>
        @else 
            <h6 class="box-title" style="text-align:left">{{__('ar.Asks')}} - {{__('ar.Nothing yet')}} </h6>
        @endif
    </div>
  @endif 
</div> 
