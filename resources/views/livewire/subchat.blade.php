<div class="mt-1 px-1" >
    <div class="card box-success direct-chat direct-chat-success">
        @if(isset($chats) && count($chats)>-1)
        <div class="card-header">
          <h3 class="card-title">{{__('ar.Chats')}}</h3>
            {{-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div> --}}
        </div>
        <div class="card-body p-0" style="display: block; overflow-y: auto; max-height:100%;">        
            <ul class="products-list product-list-in-card px-2">
              @foreach($chats as $chat)
              <a href="{{route('messages', ['id'=>$chat->id])}}" style="color:black;background-color:transparent;" class="card p-1 bg-light">
              <li class="item">
                <div class="product-img">
                    <img 
                    src="../storage/users_images/{{$chat->first->id == Auth::user()->id ? $chat->second->image : $chat->first->image}} "
                    alt="" style="border-radius:50px;width:40px !important;height:40px !important;">
                    {{-- {{$chat->first->id == Auth::user()->id ? $chat->second->name : $chat->first->name}}   --}}
                </div>
                <div class="product-info">
                    @foreach($chat->msgs as $msg)
                        <div class="direct-chat-msg {{$msg->sender_id === Auth::user()->id ? 'right':''}}">
                            <div class="direct-chat-info clearfix ">
                                <span class="direct-chat-name pull-left">{{$msg->secondPart->name}}</span>
                                <span class="direct-chat-timestamp pull-right">{{$msg->created_at->diffForHumans()}}</span>
                            </div>
                            <div class="direct-chat-text" style="margin-left: -10px;margin-right: 5px;" >
                               <small>{{$msg->message}}</small> 
                            </div>
                        </div>
                    @endforeach
                </div>
              </li></a>
              @endforeach
            </ul>      
        </div>
        @else
        <div class="card-header">
          <h3 class="card-title">Can't fetch your chat now</h3>
            <div class="card-tools mt-2">
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <br>
            <small>nothing new yet</small>
        </div>
        @endif
      </div>   
</div>
