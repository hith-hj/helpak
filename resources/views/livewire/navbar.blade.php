<div class="main-header fixed-firstNav" >
    

    <nav  class="navbar-static-top navbar navbar-expand navbar-white navbar-light my-0 row bg-helpack">

      {{-- <h1 class="col-md-3" id="appLogo"><a href="{{route('home')}}">Iserve</a></h1> --}}
      <div class="col-md-3" id="appLogo">
        <a href="{{route('home')}}" onmouseover="flash()"><img src="../../../storage/app_images/helpak2.png" style="width:45%;height:25%;" alt=""></a>
        <div wire:loading><i class="fa fa-spinner fa-spin"></i></div>
      </div>
      
      
      <div class="form-inline col-md-6 mb-1" >
        {{-- <div class="input-group input-group-md" style="width:100%;border:1px solid #ccc;border-radius: 5px;">            
          <div class="input-group-prepend">
            <button class="btn btn-navbar">
              <i class="fas fa-search"></i>
            </button>
            @if(strlen($query)>0)
              <button class="btn btn-navbar" wire:click="$set('query', '')">
                <i class="fas fa-times" ></i>
              </button>
            @endif
          </div>
          <input class="form-control form-control-navbar"  type="search" placeholder="Search" wire:model.debounce.500ms="query">
          @if(strlen($query)>0 && $result !== null && count($result)>0 )
            <div class="col-md-12 bg-light" style="position:absolute;z-index:100;margin-top:40px;border-radius:5px; ">
                @foreach ($result as $res)
                  @if($res->type == 'post' && $res->info !== 'deleted')
                    <a href="{{route('showPost',['id'=>$res->dest_id,'type'=>$res->title])}}" >
                      <p>{{$res->info->content}}</p>
                    </a>                   
                  @elseif($res->type == 'user')
                    <a href="{{route('profile',['id'=>$res->dest_id])}}">
                      <p>{{$res->info->name}}</p>
                    </a>                      
                  @endif       
                @endforeach
            </div>
          @endif            
        </div>  --}}

        <div class="input-group input-group-md" style="width:100%;">            
          <div class="input-group-prepend search-container" style="background:#fff;">
            @if(strlen($query)>0)
                <div wire:click="$set('query', '')"><i class="fas fa-times" style="padding: 60% 80%" ></i></div>
            @else 
                <i class="fas fa-search" style="padding: 8px;"></i> 
            @endif
          </div>
          <input class="form-control form-control-navbar search-input" 
                 type="search" placeholder="Search" wire:model.debounce.300ms="query" style="background:#fff">
          @if(strlen($query)>0)
            <div class="col-md-12 bg-light " style="position:absolute;z-index:100;margin-top:30px;border-radius:5px; ">
              @if($result && count($result)>0 )
                @foreach ($result as $res)
                  <div class="animated slideInDown" style="border-bottom:1px solid #d2cdcd">
                    @if($res->type == 'post' && $res->info != 'deleted')
                      <a href="{{route('showPost',[$res->dest_id,$res->title])}}" >
                        @if(strlen($res->info->content)<80)
                          {{markWords($res->info->content,$query)}}
                        @else 
                          {{markWords($res->info->content,$query)}}
                        @endif    
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
      
      <ul class="navbar-nav col-md-3" >
        <li class="nav-item dropdown mx-1" name="Messages" >
          @if($unread != null && count($unread)>0)
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">{{count($unread->toArray())}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="overflow-y: auto;max-height:20rem;">
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
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="media">                  
                <p class="text-sm ml-4 p-2">Nothing New Yet</p>
              </div>
            </div>
          @endif
        </li>
         
        <li class="nav-item dropdown mx-1" name="notification" >                
          @if($notification != null && count($notification)>0)
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-danger navbar-badge">{{count($notification->toArray())}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="overflow-y: auto;max-height:20rem;">
              @foreach($notification as $notifi)
                @if($notifi->object_type == 'message')
                  <a href="{{route('messages', ['id'=>$notifi->object_id])}}" class="dropdown-item" wire:click.prefetch="setNotiSeen({{$notifi->id}})">
                    <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                    <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                    <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                  </a>
                @elseif($notifi->object_type == 'rate')
                  <a href="{{route('profile',$notifi->object_id)}}" class="dropdown-item" wire:click.prefetch="setNotiSeen({{$notifi->id}})">
                    <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                    <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                    <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                  </a>
                @else 
                  <a href="{{route('showPost', ['id'=>$notifi->object_id,'type'=>$notifi->object_type])}}" class="dropdown-item" wire:click.prefetch="setNotiSeen({{$notifi->id}})">
                    <i class="fa fa-bell mr-2"></i> {{$notifi->sender->name}}
                    <span class="float-right text-muted text-sm">{{$notifi->created_at->diffForHumans()}}</span><br>
                    <small>{{$notifi->object_type}} - {{$notifi->content}}</small>
                  </a>
                @endif                  
                <div class="dropdown-divider"></div>
              @endforeach              
            </div>
          @else
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="media">                  
                <p class="text-sm ml-4 p-2">Nothing New Yet</p>                  
              </div>
            </div>
          @endif
        </li>        

        <li class="nav-item dropdown mx-1" name="setting">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-cog"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="text-align: right">
            <a href="{{route('setting')}}" class="dropdown-item">{{__('ar.Setting')}} <i class="fa fa-cogs ml-1"></i> </a>
            <a href="/about" class="dropdown-item">{{__('ar.About')}} <i class="fa fa-info-circle ml-1"></i> </a>
            {{-- <a href="#" class="dropdown-item" onclick="changeTheme()" id="Theme">{{__('ar.Theme')}}</a> --}}
            <a href="#" class="dropdown-item" data-toggle="dropdown">{{__('ar.Language')}}<i class="fa fa-language ml-2"></i> </a>              
              <div class="dropdown-menu dropdown-menu-left p-0">
                <a href="/setLang/{{'ar'}}" class="dropdown-item {{App::getLocale() == 'ar' ? 'active':'' }} " onclick="setDir('right')" >
                  Arabic
                </a>
                <a href="/setLang/{{'en'}}" class="dropdown-item {{App::getLocale() == 'en' ? 'active':'' }} " onclick="setDir('left')">
                  English
                </a>            
              </div>
          </div>
        </li>

        <li class="nav-item ml-1" name="Logout">
          <div class="dis-flex">
            <a href="{{route('profile',[Auth::user()->id])}}"><img class="img-circle img-sm mt-1" src="../../../storage/users_images/{{Auth::user()->image}}"></a>
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

  </nav> 
    
</div>

