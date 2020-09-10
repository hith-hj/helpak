<div class="mt-1" >
  <div class="box box-widget widget-user">
    {{-- <div class="widget-user-header bg-gradient-blue" style="height:175px !important">
      <h3 class="widget-user-username">{{$pinfo->name}}</h3>
      <h5 class="widget-user-desc">{{$pinfo->email}}</h5> 
      
    </div> --}}
    
    <div class="box-footer bg-light ">
      <div style="display: flex">
        <div class="col-sm-4 border-right">
          <div class="description-block" >
            <h5 class="description-header">{{$pinfo->service}}</h5>
            <span class="description-text">Service</span>
          </div>                
        </div>
        
        <div class="col-sm-4 border-right">
          <div class="description-block"style="margin: 3px 0 !important;">            
            
            <small class="description-header ">
              @for($i = 0 ; $i<=$pinfo->rate ; $i+= $pinfo->rate/($pinfo->rate/50))
              <i class="fa fa-star fa-xs " style="color:gold;font-weight: 600;font-size: .4rem;" data-toggle="tooltip" title="gold star"></i>
              @endfor
            </small><br>
            <span class="description-text">Rate</span>
          </div>                
        </div>
        
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">{{$pinfo->dakish}}</h5>
            <span class="description-text">Dakish</span>
          </div>                
        </div>       
      </div>      
    </div>
    <div class="box-footer bg-light">
      <div class="dis-flex">
        @if($user_id != Auth::user()->id)
          @if($pinfo->allowedRate == true && $pinfo->setting->can_rate !== 'no' )
            <div class="col-sm-6">
              <div class="description-block">
                <span class="description-text">
                  <button class="btn btn-default form-control" wire:click="rateUser()">
                    <i class="far fa-thumbs-up mr-1"></i> Rate
                  </button>
                </span>
              </div>                
            </div>
          @else 
            <div class="col-sm-6">
              <div class="description-block">
                <span class="description-text">
                  <button class="btn btn-default form-control" 
                    data-toggle="tooltip" title="Rate is blocked for until {{$pinfo->nextDateToAllow}}" disabled>
                    <i class="fa fa-ban mr-1"></i> Rate
                  </button>
                </span>
              </div>                
            </div>
          @endif
          @if($pinfo->setting->can_send_message !== 'no' )
            <div class="col-sm-6">
              <div class="description-block">
                <span class="description-text">
                  <button class="btn btn-default form-control" wire:click="$set('message', true)">
                    <i class="far fa-comment mr-1"></i> Message
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