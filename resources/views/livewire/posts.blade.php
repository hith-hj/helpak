<div class="mt-1" style="">
    <div class=" bg-light col-md-12 " style="border-radius:4px;">
        <div class="col-md-12 " id="profileFeedsNav" style="display: flex;">
            <div class="col-md-3">
                   <button type="submit" id="allfeeds" class="btn col-md-12" wire:click="setType('all')" onclick="setActive('allfeeds')" >
                <i class="fas fa-circle fa-sm " ></i> </button> 
            </div>
            <div class="col-md-3">
                    <button type="submit" id="servicefeeds" class="btn col-md-12" wire:click="setType('services')" onclick="setActive('servicefeeds')">
                        <i class="fas fa-hand-holding-heart fa-sm " ></i></button>
            </div>
            <div class="col-md-3">
                    <button type="submit" id="dakishfeeds" class="btn col-md-12" wire:click="setType('dakishs')" onclick="setActive('dakishfeeds')">
                        <i class="far fa-handshake  fa-sm  " ></i></button>
            </div>
            <div class="col-md-3">
                    <button type="submit" id="redofeeds" class="btn col-md-12" wire:click="setType('redos')" onclick="setActive('redofeeds')">
                        <i class="fa fa-retweet fa-sm  " ></i></button>
            </div>
        </div>
    </div> 
    <div style="height:100%; overflow-y: auto; overflow-x: hidden" class="mt-1"  id="userProfilePost">
        @if(count($feeds) > 0 )
            @foreach($feeds as $ser)
            <div class="card card-widget {{$loop->last ? 'mb-2':''}}" wire:key="{{$loop->index}}" >                    
                <div class="card-header" 
                    style="border-top:4px solid {{$ser->title == 'service' ? '#009e80':'#00647b'}}">
                    <div class="user-block  ">
                        <div class="dropdown ">
                            <img class="img-circle dropbtn mx-1" src="../../../storage/users_images/{{$ser->user_info->image}}" >
                            <div class="dropdown-content card animated fadeIn " style="z-index:1034 !important">
                                <div class="m-1" style="width:260px;height:85px;display: flex">
                                    <div style="width:80px;height:80px;border-radius:50px;background-size:cover;background-image:url(../../../storage/users_images/{{$ser->user_info->image}});"></div>
                                    <div>
                                        <div class="ml-2">
                                            <h5 >{{ucfirst($ser->user_info->firstName)}} {{ucfirst($ser->user_info->lastName)}}</h5>
                                            <div style="margin-top:-10px;">                                            
                                                @for($i = 1 ; $i<= $ser->user_info->rate ; $i+= $ser->user_info->rate/($ser->user_info->rate/50))
                                                    <i class="fa fa-star fa-xs " style="color:gold;font-weight: 700;font-size: .8rem;" data-toggle="tooltip" title="gold star"></i>
                                                @endfor
                                            </div>
                                            <small>{{$msg !== '' ? $msg : ''}}</small>
                                        </div> 
                                    </div>
                                </div>
                                <div class="card-footer" style="padding: .5rem .25rem !important;">
                                    <div class="col-12">                                     
                                        @if($messageInputId == $ser->id )
                                        <div class="col-md-12" wire:transition.fade wire:key="{{$ser->user_id}}">
                                            <div class="row float-right">
                                                <button class="btn btn-sm" wire:click="sendMessage({{$ser->id}})"><i class="fa fa-check"></i></button>
                                                <button class="btn btn-sm" wire:click="$set('messageInputId', '')" ><i class="fa fa-times"></i></button>
                                            </div> 
                                            <textarea type="text" class="form-control" wire:model="userMessage" 
                                            wire:keydown.enter.prevent="sendMessage({{$ser->id}})" placeholder="" ></textarea>
                                        </div><hr>
                                        @endif
                                        @if($ser->user_id != Auth::user()->id)
                                        <div class="col-12"  style="display: flex;">
                                            @if( $ser->user_setting->can_rate == 'yes' || $ser->user_setting->can_rate ==  'links')
                                                @if(in_array($ser->user_id,$allowedRate))
                                                    <button class="btn btn-default form-control" wire:click="userRate({{$ser->id}})">Rate<i class="fas fa-thumbs-up ml-1" ></i></button>
                                                @else 
                                                    <button class="btn btn-default form-control" data-toggle="tooltip" title="You can not rate until {{$ser->nextDateToAllow}} ">Rated<i class="fas fa-thumbs-up ml-1" style="color:blue" ></i></button>
                                                @endif
                                            @else 
                                            <button disabled class="btn btn-default form-control" data-toggle="tooltip" title="You can not rate no links">Rate<i class="fas fa-ban ml-1" ></i></button>
                                            @endif
                                            @if($ser->user_setting->can_send_message == 'yes' || $ser->user_setting->can_send_message == 'links')                                           
                                            <button class="btn btn-default form-control" wire:click="$set('messageInputId', '{{$ser->id}}')">Message<i class="fa fa-comment ml-1"></i></button>
                                            @else 
                                            <button disabled class="btn btn-default form-control" data-toggle="tooltip" title="You can not message no links">Message<i class="fas fa-ban ml-1" ></i></button>
                                            @endif
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
                        <span class="description">{{__('ar.Shared')}} - {{$ser->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="card-tools">
                        <div class="dropdown" >
                            @if($ser->title == 'service')
                                <i class="fas fa-hand-holding-heart" style="color:#009e80" data-toggle="tooltip" title="this post is a service from a good person"></i>
                            @else 
                                <i class="fa fa-hands-helping" style="color:#00647b" data-toggle="tooltip" title="this post is a Dakish "></i>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="increasView({{$ser->id}}, '{{ $ser->title }}')"><i class="fas fa-minus"></i></button>
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>    --}}
                            <a href="/post/show/{{$ser->id}}/{{$ser->title}}"><button type="button" class="btn btn-tool" > <i class="fas fa-eye"></i></button></a>                                        
                            <button type="button" class="btn btn-tool" data-toggle="dropdown" ><i class="fa fa-ellipsis-v "></i></button>
                                <div class="dropdown-menu">
                                    <a class="btn btn-default dropdown-item " wire:click="savePost({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-save mr-2"></i>{{__('ar.Save Post')}}</a>                                
                                    <a class="btn btn-default dropdown-item " onclick="getUrl({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-copy mr-2"></i> {{__('ar.Copy Link')}}</a>
                                    <a class="btn btn-default dropdown-item " wire:click="$set('reportid', '{{$ser->id}}')" ><i class="fa fa-ban mr-2"></i> {{__('ar.Report Post')}}</a>
                                    @if($ser->user_id === Auth::user()->id)                                   
                                    <a class="btn btn-default dropdown-item " wire:click="$set('postRequestId', '{{$ser->id}}')"><i class="fa fa-forward mr-2"></i>{{__('ar.Set Request Count')}}</a>
                                    <a class="btn btn-default dropdown-item " wire:click="preventComment({{$ser->id}})"><i class="fa fa-comments mr-2"></i>{{$ser->commentCount == 'notallowed' ? 'Allowe' : 'Prevent' }}</a>
                                    <a class="btn btn-default dropdown-item " wire:click="$set('postEditId', '{{$ser->id}}')" ><i class="fa fa-edit mr-2"></i>{{__('ar.Edit Post')}}</a>                              
                                    <a class="btn btn-default dropdown-item " wire:click="$set('delete', '{{$ser->id}}')"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete Post')}}</a>
                                    @endif                                 
                                </div>                        
                        </div>
                        @if($ser->id == $postRequestId)
                            <span class="">
                                <div class="">
                                    <button class="btn btn-sm" wire:click="setRequestCount({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-sm" wire:click="$set('postRequestId', '')" ><i class="fa fa-times"></i></button>
                                </div>
                                <span class="badge badge-default" ><input type="tsxt" id="postRequestInput" wire:model="postRequestCount" ></span> 
                            </span>
                        @endif
                        @if($delete == $ser->id)
                            <span class=" ">
                                <div class="">
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
                        @if(preg_match('/[اأإء-ي]/ui', $ser->content))
                            <h6 style="text-align:right">{{$ser->content}}</h6><hr> 
                        @else 
                            <h6>{{$ser->content}}</h6><hr> 
                        @endif                            
                        {{-- <div class="container mb-3" style="border-bottom:2px solid gray">
                            <div class="row">
                                <div class="col-md-6" style="border-right:2px solid gray"><i class="fa fa-mobile"></i> : {{$ser->phone}}</div>
                                <div class="col-md-6"><i class="fa fa-map"></i> : {{$ser->address}}</div>
                            </div>
                        </div>           --}}
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
                            <i  class="mx-1 {{ $ser->likeCount > 0 ? 'countblue fa' : 'countgray far' }} fa-star fa-xs"> {{$ser->likeCount}}</i></label>
                        <label >
                            <i  class="mx-1 {{ $ser->commentCount > 0 ? 'countblue fa' : 'countgray far' }} far fa-comment fa-xs"> {{$ser->commentCount}} </i></label> 
                        <label style="cursor:pointer" data-toggle="modal" data-target="#redosForPost{{$ser->id}}">
                            <i  class="mx-1 {{ $ser->redoCount > 0 ? 'countblue fa' : 'countgray far' }} fa fa-retweet fa-xs"> {{$ser->redoCount}} </i> </label>
                        @if(Auth::user()->id == $ser->user_id)    
                        <label class="" style="cursor:pointer">
                            <li class="fas fa-link fa-xs mx-1" data-toggle="tooltip" title="Asks For you on this {{$ser->title}}" > {{$ser->requestNumber}}</li> </label>
                        @endif
                    </span> 
                </div>
                <div class="card-footer"> 
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
                            <div class=" rounded card-comment bg-light" style="padding-bottom:.2rem !important" wire:key="{{$loop->index}}">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="img-circle" src="../storage/users_images/{{$comment->user_image}}" alt="User Image" width="30" height="30">
                                    </div>    
                                    <div class="col-md-9">
                                        <div class="comment-text">
                                            <span class="username">
                                                <a href="/profile/{{$comment->user_id}}" ><strong style="color:black">{{$comment->user_name}}</strong></a>
                                                @if(Auth::user()->id == $comment->user_id)
                                                <span class="float-right" wire:click="deleteComment({{$comment->id}}, '{{ $comment->post_type }}')"><i class="fa fa-times fa-xs ml-3 mt-1"></i></span>
                                                <span class="float-right" wire:click="$set('comid', '{{$comment->id}}')"><i class="fa fa-edit fa-xs ml-4"></i></span>
                                                @endif                                    
                                            </span>
                                            @if($comment->id == $comid)
                                                <span class="float-right" wire:click="$set('comid', '')"><i class="fa fa-times fa-xs ml-4"></i></span>
                                                <input type="text" class="form-control" placeholder="{{$comment->content}}" wire:model="editedComment" wire:keydown.enter.prevent="editComment({{$comment->id}})">
                                            @else 
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
                        <div style="padding:.3rem .3rem">            
                            <img class="img-fluid img-circle img-sm" src="../storage/users_images/{{Auth::user()->image}}" alt="Alt Text">
                            <div class="img-push">                    
                                <input  type="text" class="form-control" 
                                    placeholder="Press enter to post comment"
                                    style="height:30px;border-radius:50px" 
                                    wire:keydown.enter.prevent="addComment({{$ser->id}}, '{{ $ser->title }}')" wire:model="comment.postId{{$ser->id}}">
                            </div>            
                        </div>
                    @endif
                </div>    
            </div>    
            <div id="likesforPost{{$ser->id}}" class="modal fade"  tabindex="-1" role="dialog">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Likes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(count($ser->likes->toArray()) > 0 )
                            @foreach($ser->likes as $like)
                                <label for="">{{$like->user_name}}</label><hr>
                            @endforeach
                            @else 
                            <label class="alert alert-default form-control">No Likes Yet</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>      
            <div id="redosforPost{{$ser->id}}" class="modal fade"  tabindex="-1" role="dialog">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Redos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            @if(isset($ser->redos) && count($ser->redos->toArray())>0)
                            @foreach($ser->redos as $like)
                                <label for="">{{$like->redo_user_name}}</label><hr>
                            @endforeach
                            @else 
                            <label class="alert alert-default form-control">No Redos Yet</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>     
            @endforeach
        @else
            <div class="card card-widget mt-3">
                <span class="badge badge-danger col-12 p-2"> No Post found </span>
            </div>
        @endif
    </div>
        
</div>
    