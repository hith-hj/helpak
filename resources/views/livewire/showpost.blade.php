<div class="row" >
    @if(!empty($ser))
     <div class="col-md-3 mt-2" style="max-height:90vh;">
        <div class="card " style="max-height:40vh;overflow-y: auto; overflow-x: hidden">
            @if(count($ser->likes->toArray()) > 0 )
            <div class="card-header w-100">
              <h3 class="card-title">{{__('ar.Likes')}}</h3>
                <div class="card-tools ">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> --}}
                </div>
            </div>
            <div class="card-body p-0" >        
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($ser->likes as $like)
                    <li class="mb-1" style="border-radius:4px;border-bottom:1px solid gray {{$loop->last ? 'mt-5':''}}">
                        <div class="product-img">
                          <img src="../../../storage/users_images/{{$like->user_info->image}}" alt="Product Image" class="img-size-50 img-circle m-2">
                        </div>
                        <div class="product-info">
                            <a href="/profile/{{$like->user_id}}" class="product-title">{{$like->user_info->name}}</a><br>
                            <span >{{$like->created_at->diffForHumans()}}</span>
                        </div>
                      </li>
                  @endforeach
                </ul>      
            </div>
            @else
            <div class="card-header">
              <h3 class="card-title">{{__('ar.Likes')}}</h3>
                <div class="card-tools mt-2">
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> --}}
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <br>
                <label >{{__('ar.Not Yet')}}</label>
            </div>
            @endif
        </div>
        <div class="card " style="max-height:40vh;overflow-y: auto; overflow-x: hidden">
            @if(count($ser->redos->toArray()) > 0 )
            <div class="card-header">
              <h3 class="card-title">{{__('ar.Latest Redos')}}</h3>
                <div class="card-tools ">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
            </div>
            <div class="card-body p-0" style="display: block;">        
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($ser->redos as $like)
                    <li class="mb-1" style="border-radius:4px;border-bottom:1px solid gray {{$loop->last ? 'mt-5':''}}">
                        <div class="product-img">
                          <img src="../../../storage/users_images/{{$like->user_info->image}}" alt="Product Image" class="img-size-50 img-circle m-2">
                        </div>
                        <div class="product-info">
                            <a href="/profile/{{$like->redo_user_id}}" class="product-title">{{$like->redo_user_name}}</a><br>
                            <span >{{$like->created_at->diffForHumans()}}</span>
                        </div>
                      </li>
                  @endforeach
                </ul>      
            </div>
            @else
            <div class="card-header">
              <h3 class="card-title">{{__('ar.Latest Redos')}}</h3>
                <div class="card-tools mt-2">
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <br>
                <label >{{__('ar.Not Yet')}}</label>
            </div>
            @endif
        </div>
     </div>
     <div class="col-md-6 mt-2">
        <div class="card card-widget">
            <div class="card-header" 
                style="border-top:4px solid {{$ser->title == 'service' ? '#009e80':'#00647b'}}">
                <div class="user-block  ">
                    <div class="dropdown ">
                        <img class="img-circle dropbtn" src="../../../storage/users_images/{{$ser->user_info->image}}" >
                        <div class="dropdown-content card">
                            <div class="card-header" style="background-size:cover;background-image:url(../../../storage/users_images/{{$ser->user_info->image}});">
                                <div style="margin-top:50%;"><h5>{{ucfirst($ser->user_info->firstName)}} {{ucfirst($ser->user_info->lastName)}}</h5></div>
                            </div>
                            <div class="card-footer mb-1">
                                <div class="row mt-3">
                                    <div class="col-md-12" style="margin-top:-30px;">                                            
                                        @for($i = 1 ; $i<= $ser->user_info->rate ; $i+= $ser->user_info->rate / 5)
                                            <i class="fa fa-star fa-xs " style="color:blue" data-toggle="tooltip" title="gold star"></i>
                                        @endfor
                                    </div>
                                    @if($messageInputId == $ser->id )
                                    <div class="col-md-12" wire:transition.fade wire:key="{{$loop->index}}Msg">
                                        <div class="row float-right">
                                            <button class="btn btn-sm" wire:click="sendMessage({{$ser->id}})"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-sm" wire:click="$set('messageInputId', '')" ><i class="fa fa-times"></i></button>
                                        </div> 
                                        <textarea type="text" class="form-control" wire:model="userMessage" wire:keydown.enter.prevent="sendMessage({{$ser->id}})"></textarea>
                                    </div>
                                    @endif
                                    @if($ser->user_id != Auth::user()->id)
                                    <div class="col-md-6" >
                                        @if(in_array($ser->user_id,$allowedRate))
                                            <button class="btn btn-default form-control" wire:click="userRate({{$ser->id}})">Rate<i class="fas fa-thumbs-up ml-1" ></i></button>
                                        @else 
                                            <button class="btn btn-default form-control" data-toggle="tooltip" title="You can not rate until {{$ser->nextDateToAllow}} ">Rated<i class="fas fa-thumbs-up ml-1" style="color:blue" ></i></button>
                                        @endif
                                    </div>
                                    <div class="col-md-6">                                            
                                        <button class="btn btn-default form-control" wire:click="$set('messageInputId', '{{$ser->id}}')">Message<i class="fa fa-comment ml-1"></i></button>
                                    </div>
                                    @endif
                                </div>                          
                            </div>
                            
                        </div>
                    </div>                 
                    <span class="username">
                        <a href="/profile/{{$ser->user_id}}" data-turbolinks-action="replace" style="color:#000;" >
                            <h5 style="font-weight:600">{{$ser->user_name}}</h5></a>
                    </span>                        
                    <span class="description"> {{__('ar.Viewed')}} - {{$ser->viewCount}} |{{__('ar.Shared')}} - {{$ser->created_at->diffForHumans()}}</span>
                </div>
                <div class="card-tools">
                    <div class="dropdown" >
                        @if($ser->title == 'service')
                            <i class="fas fa-hand-holding-heart" style="color:#009e80" data-toggle="tooltip" title="this post is a service from a good person"></i>
                        @else 
                            <i class="fa fa-hands-helping" style="color:#00647b" data-toggle="tooltip" title="this post is a Dakish "></i>
                        @endif
                        <button type="button" class="btn btn-tool" data-toggle="dropdown" ><i class="fa fa-ellipsis-v mr-3"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="btn  dropdown-item " wire:click="savePost({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-save mr-2"></i>{{__('ar.Save Post')}}</a>                                
                                <a class="btn  dropdown-item " onclick="getUrl({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-copy mr-2"></i> {{__('ar.Copy Link')}}</a>
                                <a class="btn  dropdown-item " wire:click="$set('reportid', '{{$ser->id}}')" ><i class="fa fa-ban mr-2"></i> {{__('ar.Report Post')}}</a>
                                @if($ser->user_id === Auth::user()->id)                                   
                                <a class="btn  dropdown-item " wire:click="$set('postRequestId', '{{$ser->id}}')"><i class="fa fa-forward mr-2"></i>{{__('ar.RequestCount')}}</a>
                                <a class="btn  dropdown-item " wire:click="preventComment({{$ser->id}})"><i class="fa fa-comments mr-2"></i>{{$ser->commentCount == 'notallowed' ? 'Allowe' : 'Prevent' }}</a>
                                <a class="btn  dropdown-item " wire:click="$set('postEditId', '{{$ser->id}}')" ><i class="fa fa-edit mr-2"></i>{{__('ar.Edit Post')}}</a>                              
                                <a class="btn  dropdown-item " wire:click="$set('delete', '{{$ser->id}}')"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete Post')}}</a>
                                @endif                                 
                            </div>                        
                    </div>
                    @if($ser->id == $postRequestId)
                        <span class="float-right">
                            <div class="row float-right">
                                <button class="btn btn-sm" wire:click="setRequestCount({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm" wire:click="$set('postRequestId', '')" ><i class="fa fa-times"></i></button>
                            </div>
                            <span class="badge badge-default" ><input type="tsxt" id="postRequestInput" wire:model="postRequestCount" ></span> 
                        </span>
                    @endif
                    @if($delete == $ser->id)
                        <span class="">
                            <div class="row float-right post-delete">
                                <button class="btn btn-sm btn-danger" wire:click="postDelete({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete')}}</button>
                                <button class="btn btn-sm btn-default" wire:click="$set('delete', '')" ><i class="fa fa-times"></i></button>
                            </div>
                        </span>
                    @endif                    
                </div>            
            </div>
            @if($reportid == $ser->id)
                <span class="col-md-12">
                    <div class="row float-right">
                        <button class="btn btn-sm " wire:click="reportPost({{$ser->id}}, '{{$ser->title}}')"><i class="fa fa-check mr-2"></i></button>
                        <button class="btn btn-sm " wire:click="$set('reportid', '')" ><i class="fa fa-times"></i></button>
                    </div>
                    <textarea class="form-control" wire:model="reportcontent" wire:keydown.enter.prevent="reportPost({{$ser->id}}, '{{$ser->title}}')"></textarea>
                </span>
            @endif
            <div class="card-body">
                @if($ser->id == $postEditId )
                    <div class="row float-right">
                        <button class="btn btn-sm" wire:click="storePostChanges({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                        <button class="btn btn-sm" wire:click="$set('postEditId', '')" ><i class="fa fa-times"></i></button>
                    </div>
                    <input type="text" placeholder="{{$ser->content}}" class="form-control mb-5" wire:model="postChanges">                            
                @else
                    @if(App::getLocale() == 'en')
                    <h6>{{$ser->content}}</h6> 
                    @else 
                    <h6 style="text-align:right">{{$ser->content}}</h6>
                    @endif
                    @if($ser->file != 'nofile')
                        <small>{{count(explode(',',$ser->file))}} images </small>
                        <div class="dakish_img">
                            @foreach(explode(',',$ser->file) as $img )
                                @if($loop->first)
                                    @php 
                                        $img = substr($img ,2,-1 )
                                    @endphp
                                @elseif($loop->last)
                                    @php 
                                        $img = substr($img ,1,-2 )
                                    @endphp
                                @else 
                                    @php 
                                        $img = substr($img ,1,-1 )
                                    @endphp
                                @endif
                                    <img src="../../../storage/dakish_items/{{$img}}" class="small_image" alt="" onclick="
                                    window.open('../../../storage/dakish_items/{{$img}}','_blank')">
                                </a>
                            @endforeach
                        </div>    
                    @endif
                    <div class="container mb-3" style="border-bottom:2px solid gray">
                        <div style="display: flex;">
                            <div class="col-md-3" ><i class="fa fa-mobile"></i> : {{$ser->phone}}</div>
                            <div class="col-md-9"><i class="fa fa-map"></i> : {{$ser->address}}</div>
                        </div>
                    </div>          
                @endif
                
                @if(Auth::user()->id == $ser->user_id )
                    @if( in_array($ser->id , $postLiked) )
                        <i class="fas fa-star fa-md p-1 px-5 liked" wire:click="dislike({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="remove Star"></i>
                    @else
                        <i class="far fa-star fa-md p-1 px-5 like" wire:click="like({{ $ser->id }}, '{{ $ser->title }}')"  data-toggle="tooltip" title="Star this Service" ></i>  
                    @endif
                @else 
                    @if( in_array($ser->id , $postLiked) )
                        <i class="fas fa-star fa-md p-1 mx-1 px-2 liked" wire:click="dislike({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="remove Star"></i>
                    @else
                        <i class="far fa-star fa-md p-1 mx-1 px-2 like"  wire:click="like({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="Star this Service" ></i>  
                    @endif
                    @if( in_array($ser->id , $postRedos))
                        <i class="fa fa-retweet fa-md p-1 mx-1 px-2 liked" data-toggle="tooltip" title="You Redo this it\'s Greate thing from you "></i>
                    @else                    
                        <i class="fas fa-retweet fa-md p-1 mx-1 px-2 like" data-toggle="tooltip" title="Redo service" wire:click="reDoService({{$ser->id}}, '{{ $ser->title }}')"></i>  
                    @endif
                    @if(in_array($ser->id , $postAsks) )
                        <li class="fa fa-link fa-md p-1 mx-1 px-2 liked" data-toggle="tooltip" title="you Asked for It"></li>
                    @elseif($ser->title == 'dakish')
                        <li class="fas fa-link fa-md p-1 mx-1 px-2 like"  data-toggle="tooltip" title="You cant ask for this service" wire:click="$set('dakishInput', '{{$ser->id}}')" > {{$ser->requestCount > 0 ? $ser->requestCount-$ser->requestNumber : ''}}</li>
                    @else
                        <li class="fas fa-link fa-md p-1 mx-1 px-2 like"  wire:click="askPost({{$ser->id}}, '{{ $ser->title }}')" > {{$ser->requestCount > 0 ? $ser->requestCount-$ser->requestNumber : ''}}</li>
                    @endif 
                @endif
                
                <span class="float-right text-muted">
                    <label style="cursor:pointer" data-toggle="modal" data-target="#likesForPost{{$ser->id}}">
                        <i  class="mx-1 {{ $ser->likeCount > 0 ? 'countblue fa' : 'countgray far' }} fa-star fa-sm"> {{$ser->likeCount}} </i> </label> 
                    <label >
                        <i  class="mx-1 {{ $ser->commentCount > 0 ? 'countblue fa' : 'countgray far' }} far fa-comment fa-sm"> {{$ser->commentCount}} </i></label> 
                    <label style="cursor:pointer" data-toggle="modal" data-target="#redosForPost{{$ser->id}}">
                        <i  class="mx-1 {{ $ser->redoCount > 0 ? 'countblue fa' : 'countgray far' }} fa fa-retweet fa-sm"> {{$ser->redoCount}} </i> </label>
                    @if(Auth::user()->id == $ser->user_id)    
                    <label class="" style="cursor:pointer">
                        <li class="fas fa-link fa-md mx-1" data-toggle="tooltip" title="Asks For you on this {{$ser->title}}" > {{$ser->requestNumber}}</li> </label>
                    @endif
                </span> 
            </div> 
            @if($ser->id == $dakishInput)
            <div class="col-md-12" wire:transition.fade wire:key="{{$ser->user_id}}">  
                    <div class="row float-right">
                        <button class="btn btn-sm" wire:click="askPost({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                        <button class="btn btn-sm" wire:click="$set('dakishInput', '0')" ><i class="fa fa-times"></i></button>
                    </div>                     
                        <textarea class="form-control" wire:model="dakishMesssage" 
                        placeholder="كتوب شو بدك تداكش مع الغرض تبع المخلوق"  wire:keydown.enter.prevent="askPost({{$ser->id}}, '{{ $ser->title }}')"></textarea>           
                </div>
            @endif           
            @if(count($ser->comments) > 0)
                @foreach ($ser->comments as $comment)
                    <div class=" rounded card-comment mx-2 mb-1 p-2 bg-light" style="padding-bottom:.2rem !important" wire:key="{{$loop->index}}">
                        <div class="row">
                            <div class="col-md-1">
                                <img class="img-circle mx-2" src="../../../storage/users_images/{{$comment->user_info->image}}" alt="User Image" width="50" height="50">
                            </div>    
                            <div class="col-md-10 ml-3">
                                <div class="comment-text">
                                    <span class="username mb-1">
                                        <a href="/profile/{{$comment->user_id}}" ><strong style="color:black">{{$comment->user_name}}</strong></a>
                                        @if(Auth::user()->id == $comment->user_id)
                                        <span class="float-right" wire:click="deleteComment({{$comment->id}}, '{{ $comment->post_type }}')"><i class="fa fa-trash fa-xs ml-3 mt-1"></i></span>
                                        <span class="float-right" wire:click="$set('comid', '{{$comment->id}}')"><i class="fa fa-edit fa-xs ml-4"></i></span>
                                        @endif                                
                                    </span>
                                    @if($comment->id == $comid)
                                        <span class="float-right" wire:click="$set('comid', '')"><i class="fa fa-times fa-xs ml-4"></i></span>
                                        <input type="text" class="form-control" placeholder="{{$comment->content}}" wire:model="editedComment" wire:keydown.enter.prevent="editComment({{$comment->id}})">
                                    @else 
                                        {{-- <p>{{$comment->content}}<small class="text-muted float-right" id="comdate">{{$comment->created_at->diffForHumans()}}</small></p> --}}
                                        @if(preg_match('/[اأإء-ي]/ui', $comment->content))
                                            <p style="text-align:right">{{$comment->content}}<span class="text-muted float-left" id="comdate">{{$comment->created_at->diffForHumans()}}</span></p> 
                                        @else 
                                            <p>{{$comment->content}}<span class="text-muted float-right" id="comdate">{{$comment->created_at->diffForHumans()}}</span></p>  
                                        @endif
                                    @endif                                
                                </div> 
                            </div>    
                        </div>                                   
                    </div>
                @endforeach
            @endif
            @if($ser->commentCount != 'notallowed' )
                <div class="card-footer">            
                    <img class="img-fluid img-circle img-sm" src="../../../storage/users_images/{{Auth::user()->image}}" alt="Alt Text">
                    <div class="img-push">                    
                        <input  type="text" class="form-control form-control-sm" 
                            placeholder="Press enter to post comment" 
                            wire:keydown.enter.prevent="addComment({{$ser->id}}, '{{ $ser->title }}')" wire:model="comment.postId{{$ser->id}}">
                    </div>            
                </div>
            @endif    
        </div>              
     </div>

        @if($ser->user_id == Auth::user()->id)
            <div class="col-md-3 mt-2">
                <div class="card ">
                    @if(count($ser->redos->toArray()) > -1)
                        <div class="card-header">
                        <h3 class="card-title">{{__('ar.Asks')}}</h3>
                            <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-0" style="display: block;">        
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($ser->asks as $like)
                                    <li class="item mb-1">
                                        <div class="product-img">
                                        <img src="../../../storage/users_images/{{$like->user_info->image}}" alt="Product Image" class="img-size-50 img-circle m-2">
                                        </div>
                                        <div class="product-info">
                                            <a href="/profile/{{$like->redo_user_id}}" class="product-title">{{$like->user_info->name}}</a><br>
                                            {{-- <p style="text-align:right">{{strlen($like->message) > 25 ? substr($like->message,25,-1) : $like->message.'...' }}</p> --}}
                                            <small >{{$like->created_at->diffForHumans()}}</small>                                        
                                        </div>
                                    </li>
                                @endforeach
                            </ul>      
                        </div>
                    @else
                        <div class="card-header">
                        <h3 class="card-title">{{__('ar.Asks')}}</h3>
                            <div class="card-tools mt-2">
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                            <br>
                            <label >{{__('ar.Not Yet')}}</label>
                        </div>
                    @endif
                </div>
            </div>
        @else 
            <div  class="col-md-3 mt-1" >@livewire('homepanel',Auth::user()->id)</div>            
        @endif
    @else 
        <span>looks like this post is no longer exist or somthing went wrong with it so we remove it</span>
    @endif   
</div>