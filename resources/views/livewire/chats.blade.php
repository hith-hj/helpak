<div class="" >
  {{-- style="height:100vh;overflow-y: auto;" --}}
    {{-- <div class="box-header with-border">
      <h3 class="box-title "> <i class="fa fa-comments fa-md m-2"></i>{{Auth::user()->name}} Chats</h3>
    </div> --}}
    @if(!empty($chats) && count($chats)>0)
      @foreach($chats as $chat)      
        <div class="box my-1 bg-light {{$loop->last ?'mb-5':''}} {{$chat->status == 'deleted'?'bg-dark':''}} " 
              style="border-radius:10px;box-shadow: 0px 1px 8px .1px #bbb;"
              data-toggle="tooltip" title="Chat is in {{$chat->status}} status"
              wire:click.prefetch="$refresh">
          <div class="box-header with-border ">
            <div class="float-right">
              @if($chat->unread > 0)
              <span data-toggle="tooltip" title="New Messages" class="badge bg-red">{{$chat->unread}}</span>
              @endif
              @if($chat->status != 'deleted')
              <a href="{{$chat->status != 'deleted'? route('messages', ['id'=>$chat->id]) :'disapled'}}" style="color:black">
              <button type="button" class="btn btn-tool" data-toggle="tooltip" title="open Chat"><i class="fa fa-comment" ></i></button></a>
              @endif
              <button type="button" class="btn btn-tool" data-toggle="dropdown"><i class="fa fa-ellipsis-v" data-toggle="tooltip" title="Chat setting Menu"></i></button>
              <div class="dropdown-menu dropdown-menu-right">      
                @if($chat->status != 'deleted' )  
                  <a class="btn btn-default dropdown-item " wire:click="blockChat({{$chat->id}})" >
                    <i class="fa fa-ban mr-2"></i>{{$chat->status == 'blocked'?'Unblock Chat':'Block Chat'}}</a>
                  {{-- <a class="btn btn-default dropdown-item " wire:click="muteChat({{$chat->id}})" >
                    <i class="fa fa-bell-slash mr-2"></i>{{$chat->status == 'muted'?'Unmute Chat':'Mute Chat'}}</a>                               --}}
                  <a class="btn btn-default dropdown-item " wire:click="deleteChat({{$chat->id}})" >
                    <i class="fa fa-trash mr-2"></i>{{$chat->status == 'deleted'?'Undelete Chat':'Delete Chat'}}</a>              
                @elseif($chat->done_by == Auth::user()->id)
                  <small>Chat is deleted by you</small>
                    <a class="btn btn-default dropdown-item " wire:click="deleteChat({{$chat->id}})" >
                      <i class="fa fa-trash mr-2"></i>{{$chat->status == 'deleted'?'Undelete Chat':'Delete Chat'}}</a>                  
                    <a class="btn btn-default dropdown-item " wire:click="deletePermanent({{$chat->id}})" >
                      <i class="fa fa-trash mr-2"></i>Delete permanent</a>  
                @else 
                  <small>Chat is deleted by {{$chat->first->id == Auth::user()->id ? $chat->second->name : $chat->first->name}} </small>
                  <a class="btn btn-default dropdown-item " wire:click="deletePermanent({{$chat->id}})" >
                    <i class="fa fa-trash mr-2"></i>Delete permanent</a> 
                @endif                                            
              </div>
            </div>           
            <h3>
              <img class="direct-chat-img m-1 mr-2" style="width:30px;height:30px;" src="../storage/users_images/{{$chat->first->id == Auth::user()->id ? $chat->second->image : $chat->first->image}} " alt="">
              {{$chat->first->id == Auth::user()->id ? $chat->second->name : $chat->first->name}} 
            </h3> 
            
          </div>        
          <div class="box-body" style="background-color:#eed;">
            <div class="direct-chat-messages" style="height:60px !important; overflow: hidden;padding:5px;padding-top: 0px !important;">
                <div class="direct-chat-msg {{$chat->msg->sender_id === Auth::user()->id ? 'right':''}}">
                  <div class=" {{$chat->msg->sender_id === Auth::user()->id ? 'mytxt-msg float-right ':'txt-msg float-left'}}" >
                    @if(preg_match('/[اأإء-ي]/ui', $chat->msg->message))
                        <p style="text-align:right">{{$chat->msg->message}}<small class=" mr-4">{{$chat->msg->created_at->format('H:i')}}</small></p>
                    @else 
                        <p>{{$chat->msg->message}}<small class=" ml-4">{{$chat->msg->created_at->format('H:i')}}</small></p>
                    @endif 
                  </div>
                </div>
            </div>
          </div>
        </div>
      @endforeach
    @else 
      @php 
          $trans = __('ar.Nothing yet');
      @endphp
      <div class="box-header with-border nothing-yet mt-2">
          @if(preg_match('/[اأإء-ي]/ui',$trans ))
              <h6 class="box-title" style="text-align:right">{{__('ar.Chats')}} - {{__('ar.Nothing yet')}} </h6>
          @else 
              <h6 class="box-title" style="text-align:left">{{__('ar.Chats')}} - {{__('ar.Nothing yet')}} </h6>
          @endif
      </div>
    @endif     
</div>
