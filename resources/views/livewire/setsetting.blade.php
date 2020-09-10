<div >
    @php 
       $lang =  session()->get('lang');
       if($lang == 'ar')
            $marg = 'mr-1';
        else
            $marg = 'ml-1'; 
    @endphp
    <div class="col-md-12 card mt-1 align-content-center" dir="{{ session()->get('lang') == 'ar' ? 'rtl' : 'ltr'}}">
        <div class="col-md-12 my-1 mt-2" name="phone">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text ">{{__('ar.phone')}} : <strong class="{{$marg}}">{{strToUpper($setting->phone)}}</strong></span>
                        </div>
                        <select class="form-control" wire:click.debounce.60s="updateSet('phone')" wire:model="phone">
                            <option value="no">{{__('ar.no')}}</option>
                            <option value="yes" >{{__('ar.yes')}}</option>
                        </select>                  
                    </div>                   
                </div>
            </div>                                   
        </div>
        <div class="col-md-12 my-1" name="address">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{__('ar.address')}} : <strong class="{{$marg}}"> {{strToUpper($setting->address)}}</strong></span>
                        </div>
                        <select class="col-auto form-control" wire:click.debounce.60s="updateSet('address')" wire:model="address">
                            <option value="no">{{__('ar.no')}}</option>
                            <option value="yes">{{__('ar.yes')}}</option>
                        </select>                            
                    </div> 
                </div>
            </div>                                   
        </div>
        <div class="col-md-12 my-1" name="message">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{__('ar.message')}} : <strong class="{{$marg}}">{{strToUpper($setting->can_send_message)}}</strong></span>
                        </div>
                        <select class="col-auto form-control" wire:click.debounce.60s="updateSet('can_send_message')" wire:model="message">
                            <option value="no">{{__('ar.none')}}</option>
                            <option value="links">{{__('ar.links')}}</option>
                            <option value="yes">{{__('ar.all')}}</option>
                        </select>                        
                    </div> 
                </div>
            </div>                                   
        </div>
        <div class="col-md-12 my-1" name="profiel info">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{__('ar.info')}} : <strong class="{{$marg}}">{{strToUpper($setting->can_see_myinfo)}}</strong></span>
                        </div>
                        <select class="col-auto form-control" wire:click.debounce.60s="updateSet('can_see_myinfo')" wire:model="info">
                            <option value="no">{{__('ar.none')}}</option>
                            <option value="links">{{__('ar.links')}}</option>
                            <option value="yes">{{__('ar.all')}}</option>
                        </select>                        
                    </div> 
                </div>
            </div>                                   
        </div>
        <div class="col-md-12 my-1" name="timeline">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{__('ar.post')}} : <strong class="{{$marg}}">{{strToUpper($setting->can_see_mypost)}}</strong></span>
                        </div>
                        <select class="col-auto form-control" wire:click.debounce.60s="updateSet('can_see_mypost')" wire:model="post">
                            <option value="no">{{__('ar.none')}}</option>
                            <option value="links">{{__('ar.links')}}</option>
                            <option value="yes">{{__('ar.all')}}</option>
                        </select>                        
                    </div> 
                </div>
            </div>                                   
        </div>
        <div class="col-md-12 my-1" name="rate">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend ">
                            <span class="input-group-text">
                                {{__('ar.rate')}} : <strong class="{{$marg}}">{{strToUpper($setting->can_rate)}}</strong></span>                            
                        </div>
                        <select class="col-auto form-control" wire:click.debounce.60s="updateSet('can_rate')" wire:model="rate">
                            <option value="no">{{__('ar.none')}}</option>
                            <option value="links">{{__('ar.links')}}</option>
                            <option value="yes">{{__('ar.all')}}</option>
                        </select>                        
                    </div> 
                </div>
            </div>                                   
        </div><hr>
        <div class="col-md-12 my-1" name="delete my accoutn">
            <div class="form-row">
                <div class="col-auto">
                    <a href="{{route('editProfile')}}"><button class="btn btn-default btn-sm">{{__('ar.EditMyPro')}}</button></a>                  
                </div>
                <div class="col-auto">
                    <div class="dis-flex">
                        <a class="nav-link" data-toggle="tooltip" title="Exit" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                           <button class="btn btn-danger btn-sm" onclick="emit()">{{__('ar.DeleteAcc')}}</button>   
                      </a> 
                      </div>                     
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                                    
                </div>
                {{-- <div class="col-md-3">
                    btn one 
                </div>
                <div class="col-md-3">
                    btn one 
                </div>
                <div class="col-md-3">
                    btn one 
                </div> 
                <div class="col-md-3">
                    btn one 
                </div> --}}
            </div>                                   
        </div>
        <hr>
        @if(App::getLocale() == 'en')
            <small style="margin-left:12px;" class="mb-5">Just to make it clear and we said it befor links which we are talking about is
                when you and any othe user share some references like a service you both rate or asked for ,
                or when one of you act on the other stuff rating redoing that kind of stuff 
            </small>
        @else 
            <small style="text-align:right">
                فقط لتوضيح الأمر الروابط يلي عم نحكي عنها
                    هي بس تشترك أنت وأي شخص تاني ببعض المراجع مثل الخدمة التي تقيمها أو تطلبها 
                ، أو بس تتفاعلو عمنشورات بعض هون بنأنشئ بينكون رابط عنا مشان نسبيا نربط المجتمع ببعضو 
            </small>
        @endif
    </div>

</div>

<script>
    function emit(){
        window.Livewire.emit('accountDeleted')
    }
</script>