@extends('layouts.app')
@section('content')
  <div class="row">    
    <div class=" fixed-homeGadget col-md-3 animated fadeIn" > 
      {{-- <div class="card mt-1 collapsed-card" id="vipPost" style="display: none;text-align:right">
        <div class="card-header">
          <h3 class="card-title" ><i class="fa fa-hashtag mr-1" ></i>{{__("ar.VIP")}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus" ></i></button>
            </div><br>
            <small>{{__('ar.VipContent')}}</small>
            
        </div>
        <div class="card-body"><h3>this is a vip Post body </h3></div>
      </div> --}}

      {{-- <div class="card mt-1 collapsed-card" id="publicChat" style="display: none;text-align:right">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-blog mr-1" ></i> {{__("ar.Dev blog")}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus" ></i></button>
            </div><br>
            <small>{{__('ar.DevContent')}}</small>
        </div>
        <div class="card-body p-0" style=" overflow-y: auto; max-height:140px;">
          <p class="form-control">some shit gose here</p>
        </div>
      </div>   --}}
          
      <div id="homeGadget" > @livewire('widgets')</div>	    
    </div>

    <div class="col-md-9 offset-3" id="centerFlow"> 
      <div class="row">
        <div class="col-md-8 animated slideInUp" >         
          {{-- @if($appSetting == true) --}}
          <div style="display:none">@livewire('donation')</div> 
          {{-- @endif          --}}
          @if($type == 'feeds' )
            @livewire('main') 
          @elseif($type == 'chats')
            @livewire('chats',Auth::user()->id)
          @elseif($type == 'saves')
            @livewire('saves',Auth::user()->id)
          @elseif($type == 'asks')
            @livewire('asks',Auth::user()->id)
          @elseif($type == 'orders')
            @livewire('orders',Auth::user()->id)
          @elseif($type == 'messages')
            @livewire('messages',$id)  
          @endif
        </div>

        <div class=" fixed-homePanel col-md-4 animated fadeIn">
          @if($type == 'messages')
          <div id="subChats" style="display:none;" >@livewire('subchat',Auth::user()->id)</div>
          @else
            @livewire('homepanel',Auth::user()->id)
            
            <h6 class="ml-3" id="motoSlogan"> 
              <small>Proud of what we are doing and you should be . </small><br>
              <script> 
                  var d = new Date();
                  var n = d.getFullYear();
                  document.write("helpak &copy;" + n)
              </script>
            </h6>	
          @endif           
        </div>      
      </div>        
    </div>

  </div>
      
  @toastr_css
@endsection




  