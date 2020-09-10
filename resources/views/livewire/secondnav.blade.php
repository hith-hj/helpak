<div class="w-100 fixed-secondNav animated slideInDown ">
    
    <nav  class="navbar-static-top navbar navbar-expand navbar-white navbar-light my-0 row bg-helpack"  >          
    
      <div class="h-100 w-12 ">
        {{-- <h6 class="col-12" style="padding-left: 0 !important;padding-right: 0 !important;">
          <a href="{{route('home')}}">Iserve</a></h6> --}}
          {{-- <a href="{{route('profile',['id'=>Auth::user()->id])}}"><img class="img-circle img-sm mt-1" src="../../../storage/users_images/{{Auth::user()->image}}" alt="Alt Text"></a> --}}

            <a href="{{route('home')}}"><img src="../../../storage/app_images/icon2.png" style="width:45px" alt=""></a>
          
       </div>
      
      <div class="form-inline w-74">
        <div class="input-group input-group-md" style="width:100%;">            
          <div class="input-group-prepend search-container" style="background:#fff">
              
            @if(strlen($query)>0)
                <div wire:click="$set('query', '')"><i class="fas fa-times" style="padding: 60% 80%" ></i></div>
            @else 
                <i class="fas fa-search" style="padding: 8px;"></i> 
            @endif
          </div>
          <input class="form-control form-control-navbar search-input" style="background:#fff" 
          type="search" placeholder="Search" wire:model.debounce.300ms="query">
          @if(strlen($query)>0)
            <div class="col-md-12 bg-light" style="position:absolute;z-index:100;margin-top:40px;border-radius:5px; ">
              @if($result && count($result)>0 )
                @foreach ($result as $res)
                  <div class="animated slideInDown" style="border-bottom:1px solid #d2cdcd">
                    @if($res->type == 'post' && $res->info != 'deleted')
                      <a href="{{route('showPost',[$res->dest_id,$res->title])}}" >
                        <p>{{$res->info->content}}</p>
                      </a>                   
                    @elseif($res->type == 'user')
                      <a href="{{route('profile',[$res->dest_id])}}">
                        <p>{{$res->info->name}}</p>
                      </a>                      
                    @endif
                  </div>       
                @endforeach
              @endif
            </div>
          @endif            
        </div> 
      </div>       
      
      <div class="w-10" id="hiddenMenu"  >
        <label class="nav-link" onclick="displaySecondNav()" >
          @if(count($unread->toArray())>0)
            <i class="fas fa-comment fa-md " style="margin-top: 8px;margin-left: -5px;color:red;"></i>
            {{-- <span class="badge badge-defualt navbar-badge" >&Psi;</span> --}}
          @elseif(count($notification->toArray())>0)
            <i class="fas fa-bell fa-md " style="margin-top: 8px;margin-left: -5px;color:red;"></i>
          @else 
            <i class="fa fa-bars fa-lg" style="color:#777 ;margin-top: 8px;margin-left: -5px;"></i>
          @endif  
        </label>
        <div class="dropdown-menu" id="SubNav" style="display:none;width:100%;background-color:lightsteelblue"> 
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item nav-link dropdown ">
                @if($unread != null && count($unread)>0)
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                      <span class="badge badge-danger navbar-badge">{{count($unread->toArray())}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    @foreach($unread as $msg)
                    <a href="{{route('messages', ['id'=>$msg->chat_id])}}" class="dropdown-item">
                      <div class="media" wire:click.prefetch="setMsgSeen({{$msg->id}})">
                        <img src="../storage/users_images/{{$msg->firstPart->image}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                        <h3 class="dropdown-item-title">
                          {{$msg->firstPart->name}}
                          <span class="float-right text-sm text-danger"><i class="fas fa-comment"></i></span>
                        </h3>
                        <p class="text-sm" style="text-align:{{$msg->sender_id === Auth::user()->id ? 'right':'left'}}">{{$msg->message}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$msg->created_at->diffForHumans()}}</p>
                        </div>
                      </div>
                      </a>
                    @endforeach
                  </div>
                @else 
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
                    <div class="media">                  
                      <p class="text-sm ml-4 p-2">{{__('ar.Nothing yet')}}</p>
                    </div>
                  </div>
                @endif
              </li>
                
              <li class="nav-item nav-link dropdown">
                @if($notification != null && count($notification)>0)
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge">{{count($notification->toArray())}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left ">
                    @foreach($notification as $notifi)
                      @if($notifi->object_type == 'message')
                        <a href="{{route('messages', ['id'=>$notifi->object_id])}}" class="dropdown-item" wire:click.prefetch="setSeen({{$notifi->id}})">
                          <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                          <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                          <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                        </a>
                      @elseif($notifi->object_type == 'rate')
                        <a href="{{route('profile',[$notifi->object_id])}}" class="dropdown-item" wire:click.prefetch="setSeen({{$notifi->id}})">
                          <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                          <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                          <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                        </a>
                      @else 
                        <a href="{{route('showPost', ['id'=>$notifi->object_id,'type'=>'any'])}}" class="dropdown-item" wire:click.prefetch="setSeen({{$notifi->id}})">
                          <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                          <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                          <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                        </a>
                      @endif                  
                    @endforeach              
                    {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                  </div>
                @else
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left ">
                    <div class="media">                  
                      <p class="text-sm ml-4 p-2">Nothing New Yet</p>                  
                    </div>
                    {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                  </div>
                @endif
              </li>        
    
              <li class="nav-item nav-link dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-left" style="text-align:right;">
                  <a href="{{route('setting')}}" class="dropdown-item" >{{__('ar.Setting')}} <i class="fa fa-cogs ml-1"></i></a>
                  <a href="/about" class="dropdown-item">{{__('ar.About')}} <i class="fa fa-info-circle ml-1"></i></a>
                  {{-- <a href="#" class="dropdown-item" onclick="changeTheme()" id="Theme">{{__('ar.Theme')}}</a> --}}
                  <a href="#" class="dropdown-item" data-toggle="dropdown"> {{__('ar.Language')}} <i class="fa fa-language"></i></a>              
                    <div class="dropdown-menu dropdown-menu-left p-0">
                      <a href="/setLang/{{'ar'}}" class="dropdown-item {{App::getLocale() == 'ar' ? 'active':'' }} " onclick="setDir('right')" >
                        Arabic
                      </a>
                      <a href="/setLang/{{'en'}}" class="dropdown-item {{App::getLocale() == 'en' ? 'active':'' }} " onclick="setDir('left')">
                        English
                      </a>            
                    </div>
                  {{-- <div class="dropdown-divider"></div> --}}
                </div>
              </li>
    
              <li class="nav-item nav-link">
                <div class="row">                  
                  <a class="nav-link" data-toggle="tooltip" title="Exit" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{Auth::user()->name}} <i class="fa fa-chevron-right" ></i> 
                  </a> 
                </div>                     
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>				
            </ul>            
        </div>
      </div>
    </nav>
</div>
