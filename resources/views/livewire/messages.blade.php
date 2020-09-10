<div class="card mt-1" >
  @if(!empty($msgs) && count($msgs)>0)
      <div class="box box-success  direct-chat direct-chat-success mt-2" >
        <div class="box-header with-border">
          <div class="float-right">
            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-green mr-3">{{$totalMsgs}}</span>          
          </div>
           <h3 class="box-title ml-2">
             <a href="{{route('profile',['id'=>$fp->id])}}">
              <img class="direct-chat-img mr-2" src="../storage/users_images/{{$fp->image}}" alt="Message User Image"></a>
             {{$fp->name}}
          </h3> 
        </div>       
        <div class=" box-body"   >
          <div class="" id="msgsDiv" onscroll="headeronscroll()" 
          style="max-height:100%;height:70vh;overflow-y: auto;background-color:#eed" wire:poll="getMessages({{$chatid}})" >
            @foreach($msgs as $msg)
              <div class="direct-chat-messages"  >
                <div class=" {{$msg->sender_id === Auth::user()->id ? 'mytxt-msg float-right ':'txt-msg float-left'}}">
                  @if($msg->status !='blocked')
                    @if(preg_match('/[اأإء-ي]/ui', $msg->message))
                        <p style="text-align:right">{{$msg->message}} <small class=" mr-4">{{$msg->created_at->format('H:i')}} 
                          {{$msg->sender_id == Auth::user()->id ? $msg->viewed == 2 ? '✓✓' : '✓' : '' }}  </small></p>
                    @else 
                        <p>{{$msg->message}} <small class=" ml-4">{{$msg->created_at->format('H:i')}}  
                          {{$msg->sender_id == Auth::user()->id ? $msg->viewed == 2 ? '✓✓' : '✓' : '' }}  </small></p>
                    @endif 
                  @elseif($msg->status !='blocked' && $msg->done_by != Auth::user()->id) 
                    <small>{{$msg->message}} || {{$msg->status == 'blocked'?'this msg is blocked':''}}</small>
                  @endif                  
                </div> 
              </div>
            @endforeach
          </div>          
        </div>
    </div>
    @if($chat_it->status != 'blocked')    
      {{-- <div class="input-group mb-3 mt-1 px-1" onmouseover="scrollToDown()" >
          @if($newMsgs > 0)
            <div class="input-group-prepend">
              {{-- <span class="input-group-text" id="basic-addon1"><i class="fa fa-star"></i></span> 
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-circle fa-xs animated flash" style="color:red"></i></span>
            </div>
          @endif  
          <input type="text" class="form-control" placeholder="Your msg here" 
          wire:model="msgContent"  wire:keydown.enter.prevent="sendMsg({{$chatid}})">
          <div class="input-group-append">
            {{-- <span class="input-group-text" id="basic-addon1"><i class="fa fa-star"></i></span> 
            <span class="input-group-text" id="basic-addon2" wire:click="sendMsg({{$chatid}})" ><i class="fa fa-paper-plane"></i></span>
          </div>
      </div> --}}
      <div class="input-group input-group-md"  onmouseover="scrollToDown()" > 
        <input type="text" class="form-control msg-input" placeholder="Your msg here" 
          wire:model="msgContent"  wire:keydown.enter.prevent="sendMsg({{$chatid}})"> 
          <div class="input-group-append ">    
            @if($newMsgs > 0)
                <i class="fa fa-circle fa-xs animated flash"style="color:red;padding: 10px; margin-left: -40px; z-index: 10;" onclick="scrollToDown()()"></i>
            @else 
                <i class="fas fa-paper-plane" wire:click="sendMsg({{$chatid}})" style="padding: 10px; margin-left: -40px; z-index: 10;"></i>  
            @endif         
          </div>           
      </div> 
    @endif
  @else 
    <div class="alert alert-info alert-dismissible mt-2">
      <h4><i class="icon fa fa-info"></i> No Messages yet</h4>
    </div>
  @endif

  {{-- <audio src="../../../storage/app_media/send_msg.mp3" id="send_msg" autoplay="false"></audio> --}}
</div>
{{-- 
   
  
 
  {{$msg->sender == Auth::user()->id ? $msg->viewed == 2 ? '✓✓' : '✓' : '' }}  



  --}}
