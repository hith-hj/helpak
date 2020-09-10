<div id="scrollFeeds" > 
    {{-- style="max-height:40rem; overflow-y: auto;overflow -x: hidden;" --}}
    <div class="bg-light" style="border-radius:5px;">
        <div class="col-md-12 mb-1" id="feedsNav" style="display:flex; padding: 1px 1px !important;">
            <div class="col-md-3 wide">
                   <button type="submit" id="allfeeds" wire:key="all" class="btn col-md-12 {{$feedsType == 'all' ? 'bg-grayz':''}} " wire:click="setType('all')" >
                <i class="far fa-newspaper fa-sm " ></i> </button> 
            </div>
            <div class="col-md-3 wide">
                    <button type="submit" id="servicefeeds" wire:key="service"  class="btn col-md-12 {{$feedsType == 'service' ? 'bg-grayz':''}}" wire:click="setType('service')" >
                        <i class="fa fa-hand-holding-heart fa-sm " ></i></button>
            </div>
            <div class="col-md-3 wide">
                    <button type="submit" id="dakishfeeds" wire:key="dakish"  class="btn col-md-12 {{$feedsType == 'dakish' ? 'bg-grayz':''}}" wire:click="setType('dakish')" >
                        <i class="far fa-handshake  fa-sm  " ></i></button>
            </div>
            <div class="col-md-3 wide">
                    <button type="submit" id="redofeeds" wire:key="redo"  class="btn col-md-12 {{$feedsType == 'redo' ? 'bg-grayz':''}}" wire:click="setType('redo')" >
                        <i class="fa fa-retweet fa-sm  " ></i></button>
            </div>
        </div>
    </div> 
    @if(count($feeds) > 0 && !empty($feeds) && isset($feeds) )    
        @foreach($feeds as $ser)
            <div class="card card-widget {{$loop->last ? 'mb-5':''}} "  wire:key="{{$loop->index}}Post" >                    
                <div class="card-header" 
                    style="border-top:6px solid {{$ser->title == 'service' ? '#009e80':'#00647b'}}">
                    <div class="user-block  ">
                        <div class="dropdown ">
                            <img class="img-circle dropbtn" src="storage/users_images/{{$ser->user_info->image}}" >
                            <div class="dropdown-content card animated fadeIn " style="z-index:1034 !important">
                                <div class="m-1" style="width:260px;height:85px;display: flex">
                                    <div style="width:80px;height:80px;border-radius:50px;background-size:cover;background-image:url(storage/users_images/{{$ser->user_info->image}});"></div>
                                    <div>
                                        <div class="ml-2">
                                            <h5 >{{ucfirst($ser->user_info->firstName)}} {{ucfirst($ser->user_info->lastName)}}</h5>
                                            <div style="margin-top:-10px;">                                            
                                                @for($i = 1 ; $i<= $ser->user_info->rate ; $i+= $ser->user_info->rate/($ser->user_info->rate/100))
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
                                        <div class="col-md-12" wire:transition.fade wire:key="{{$loop->index}}msg">
                                            <div class="row float-right">
                                                <button class="btn btn-sm" wire:click="sendMessage({{$ser->id}})"><i class="fa fa-check"></i></button>
                                                <button class="btn btn-sm" wire:click="$set('messageInputId', '')" ><i class="fa fa-times"></i></button>
                                            </div> 
                                            <textarea type="text" class="form-control" wire:model.lazy="userMessage" 
                                            wire:keydown.enter.prevent="sendMessage({{$ser->id}})" placeholder="your Msg here" ></textarea>
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
                            <a href="/profile/{{$ser->user_id}}" data-turbolinks-action="replace"  >
                                {{$ser->user_name}}</a>                                
                        </span>                        
                        <span class="description">{{__('ar.Shared')}} - {{$ser->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="card-tools">
                        <div class="dropdown" >
                            @if($ser->title == 'service')
                                <i class="fa fa-hand-holding-heart" style="color:#009e80" data-toggle="tooltip" title="this post is a service from a good person"></i>
                            @else 
                                <i class="far fa-handshake " style="color:#00647b" data-toggle="tooltip" title="this post is a Dakish "></i>
                            @endif
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button> --}}
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>  onclick="increasView({{$ser->id}}, '{{ $ser->title }}')"  --}}
                            <a href="{{route('showPost',[$ser->id,$ser->title])}}">
                                <button type="button" class="btn btn-tool" > <i class="fas fa-eye"></i></button>
                            </a>                                        
                            <button type="button" class="btn btn-tool mr-3" data-toggle="dropdown" ><i class="fa fa-ellipsis-v "></i></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="btn dropdown-item " wire:click="savePost({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-save mr-2"></i>{{__('ar.Save Post')}}</a>                                
                                    <a class="btn dropdown-item " onclick="getUrl({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-copy mr-2"></i> {{__('ar.Copy Link')}}</a>
                                    <a class="btn dropdown-item " wire:click="$set('reportid', '{{$ser->id}}')" ><i class="fa fa-ban mr-2"></i> {{__('ar.Report Post')}}</a>
                                    @if($ser->user_id === Auth::user()->id)                                   
                                    <a class="btn dropdown-item " wire:click="$set('postRequestId', '{{$ser->id}}')"><i class="fa fa-forward mr-2"></i>{{__('ar.RequestCount')}}</a>
                                    <a class="btn dropdown-item " wire:click="preventComment({{$ser->id}})"><i class="fa fa-comments mr-2"></i>{{$ser->commentCount == 'notallowed' ? 'Allowe comment' : 'Prevent comment' }}</a>
                                    <a class="btn dropdown-item " wire:click="$set('postEditId', '{{$ser->id}}')" ><i class="fa fa-edit mr-2"></i>{{__('ar.Edit Post')}}</a>                              
                                    <a class="btn dropdown-item " wire:click="$set('delete', '{{$ser->id}}')"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete Post')}}</a>
                                    @endif                                 
                                </div>                        
                        </div>
                        @if($ser->id == $postRequestId)
                            <span class="row" style="display: inline-block ;margin-left:-50px;" wire:key="{{$loop->index}}Request">
                                <span class=" " >
                                    <input type="text" inputmode="numeric" wire:key="{{$loop->index}}reqInput" 
                                    id="postRequestInput" wire:model="postRequestCount" placeholder="رقم"
                                    style="height: 25px; border-radius: 50px;width: 48px;">
                                </span>
                                <div class="float-right">
                                    <button class="btn btn-sm btn-success" wire:click="setRequestCount({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-sm btn-default" wire:click="$set('postRequestId', '')" ><i class="fa fa-times"></i></button>
                                </div> 
                            </span>
                        @endif
                        @if($delete == $ser->id)
                            <span class="row" style="position: relative;display: inline-block;left: -20px;" wire:key="{{$loop->index}}Delete">
                                <div class=" ">
                                    <button class="btn btn-sm btn-danger" wire:click="postDelete({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-trash mr-2"></i>{{__('ar.Delete')}}</button>
                                    <button class="btn btn-sm btn-default" wire:click="$set('delete', '')" ><i class="fa fa-times"></i></button>
                                </div>
                            </span>
                        @endif                    
                    </div>            
                </div>
                @if($reportid == $ser->id)
                    <span class="col-md-12" wire:key="{{$loop->index}}Report"> 
                        <div class="">
                            <div class="float-right">
                                <button class="btn btn-sm " wire:click="reportPost({{$ser->id}}, '{{$ser->title}}')"><i class="fa fa-check mr-2"></i></button>
                                <button class="btn btn-sm " wire:click="$set('reportid', '')" ><i class="fa fa-times"></i></button>
                            </div>
                            <div class="float-left">
                                <h6>{{__('Pleas Type your proplem here')}}</h6>
                            </div>                            
                        </div>
                        <textarea class="form-control" wire:model="reportcontent" wire:keydown.enter.prevent="reportPost({{$ser->id}}, '{{$ser->title}}')"></textarea>
                    </span>
                @endif
                <div class="card-body">
                    @if($ser->id == $postEditId )
                    <div wire:key="{{$loop->index}}edit">
                        <div class="row float-right">
                            <button class="btn btn-sm" wire:click="storePostChanges({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                            <button class="btn btn-sm" wire:click="$set('postEditId', '')" ><i class="fa fa-times"></i></button>
                        </div>
                        <input type="text" placeholder="{{$ser->content}}" class="form-control mb-5"
                         wire:keydown.enter.prevent="storePostChanges({{$ser->id}}, '{{ $ser->title }}')" wire:model="postChanges">  
                    </div>
                                                  
                    @else
                        @if(preg_match('/[اأإء-ي]/ui', $ser->content))
                            <h6 style="text-align:right;padding-bottom:10px; border-bottom:1px solid #eee">{{$ser->content}}</h6>
                        @else 
                            <h6 style="border-bottom:1px solid #eee;padding-bottom:10px; ">{{$ser->content}}</h6>
                        @endif                                                   
                    @endif                    
                    @if(Auth::user()->id == $ser->user_id )
                        @if( in_array($ser->id , $postLiked) )
                            <i class="fas fa-star fa-md p-1 px-2 liked " wire:transition.fade wire:click="dislike({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="remove Star"></i>
                        @else
                            <i class="far fa-star fa-md p-1 px-2 like " wire:transition.fade wire:click="like({{ $ser->id }}, '{{ $ser->title }}')"  data-toggle="tooltip" title="Star this Service" ></i>  
                        @endif                        
                    @else 
                        @if( in_array($ser->id , $postLiked) )
                            <i class="fas fa-star fa-md p-1 mx-1 px-2 liked " wire:click="dislike({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="remove Star"></i>
                        @else
                            <i class="far fa-star fa-md p-1 mx-1 px-2 like "  wire:click="like({{$ser->id}}, '{{ $ser->title }}')" data-toggle="tooltip" title="Star this Service" ></i>  
                        @endif
                        @if( in_array($ser->id , $postRedos))
                            <i class="fa fa-retweet fa-md p-1 mx-1 px-2 liked" data-toggle="tooltip" title="You Redo this it\'s Greate thing from you "></i>
                        @else                    
                            <i class="fas fa-retweet fa-md p-1 mx-1 px-2 like" data-toggle="tooltip" title="Redo service" wire:click="reDoService({{$ser->id}}, '{{ $ser->title }}')"></i>  
                        @endif
                        @if($ser->title == 'service')
                            @if(in_array($ser->id , $postAsks) )
                                <li class="fa fa-link fa-md p-1 mx-1 px-2 liked" data-toggle="tooltip" title="you Asked for It"></li>
                            @else 
                                <li class="fas fa-link fa-md p-1 mx-1 px-2 like"  wire:click="askPost({{$ser->id}}, '{{ $ser->title }}')" > {{$ser->requestCount > 0 ? $ser->requestCount-$ser->requestNumber : ''}}</li>
                            @endif
                        @else
                            @if($ser->requestNumber <= $ser->requestCount)
                                <li class="fas fa-link fa-md p-1 mx-1 px-2 like"  wire:click="$set('dakishInput', '{{$ser->id}}')" > {{$ser->requestCount > 0 ? $ser->requestCount-$ser->requestNumber : ''}}</li>
                            @else 
                                <li class="fa fa-link fa-md p-1 mx-1 px-2 liked" data-toggle="tooltip" title="you cant Ask for it sorry"></li>
                            @endif
                        @endif              
                    @endif
                    
                    <span class="float-right text-muted">
                        <label style="cursor:pointer" data-toggle="modal" data-target="#likesForPost{{$ser->id}}">
                            <i  class="mx-1 {{ $ser->likeCount > 0 ? 'countblue fa' : 'countgray far' }} fa-star fa-xs"> {{$ser->likeCount}}</i></label>
                        <label >
                            <i  class="mx-1 {{ $ser->commentCount > 0 ? 'countblue fa' : 'countgray far' }} far fa-comment fa-xs"> {{$ser->commentCount}} </i></label> 
                        <label style="cursor:pointer" data-toggle="modal" data-target="#redosForPost{{$ser->id}}">
                            <i  class="mx-1 {{ $ser->redoCount > 0 ? 'countblue fa' : 'countgray far' }} fa fa-retweet fa-xs"> {{$ser->redoCount}} </i> </label>
                        @if($ser->title == 'dakish' && $ser->file !== 'nofile')    
                            <a href="{{route('showPost',[$ser->id,$ser->title])}}" target="_blank"><i class="mx-1 fa fa-image fa-xs"></i> </label></a>
                        @endif
                        @if(Auth::user()->id == $ser->user_id)    
                        <label class="" style="cursor:pointer">
                            <li class="fas fa-link fa-xs mx-1" data-toggle="tooltip" title="Asks For you on this {{$ser->title}}" > {{$ser->requestNumber}}</li> </label>
                        @endif
                    </span> 
                </div> 
                @if($ser->id == $dakishInput)
                    <div class="col-md-12" wire:transition.fade wire:key="{{$loop->index}}dakish">  
                        <div class="row float-right">
                            <button class="btn btn-sm" wire:click="askPost({{$ser->id}}, '{{ $ser->title }}')"><i class="fa fa-check"></i></button>
                            <button class="btn btn-sm" wire:click="$set('dakishInput', '0')" ><i class="fa fa-times"></i></button>
                        </div>                     
                            <textarea class="form-control" wire:model="dakishMesssage" 
                            placeholder="كتوب شو بدك تداكش مع الغرض تبع المخلوق"  wire:keydown.enter.prevent="askPost({{$ser->id}}, '{{ $ser->title }}')"></textarea>           
                    </div>
                @endif      
                
                @if(count($ser->comments) > 0)
                    <div wire:key="{{$loop->index}}coment{{$loop->index}}">
                        @foreach ($ser->comments as $comment)
                            <div class=" rounded card-comment mx-2 mb-1 p-2 bg-light" style="padding-bottom:.2rem !important">
                                <div class="row">
                                    <div class="col-md-1"><img class="img-circle mx-2" src="storage/users_images/{{$comment->user_image}}" alt="User Image" width="50" height="50"></div>    
                                    <div class="col-md-10 ml-3">
                                        <div class="comment-text">
                                            <span class="username mb-1">
                                                <a href="/profile/{{$comment->user_id}}" ><strong style="color:black">{{$comment->user_name}}</strong></a>
                                            </span>
                                            @if(preg_match('/[اأإء-ي]/ui', $comment->content))
                                                <p style="text-align:right">{{$comment->content}}<span class="text-muted float-left" id="comdate">{{$comment->created_at->diffForHumans()}}</span></p> 
                                            @else 
                                                <p>{{$comment->content}}<span class="text-muted float-right" id="comdate">{{$comment->created_at->diffForHumans()}}</span></p>  
                                            @endif
                                        </div>    
                                    </div>    
                                </div>                                  
                            </div>
                        @endforeach
                    </div> 
                @endif
                    
                
                <div wire:key="{{$loop->index}}enterComment" >
                    @if($ser->commentCount != 'notallowed' )
                        <div class="card-footer" style="padding:.3rem .3rem">        
                                <img class="img-fluid img-circle img-sm " src="storage/users_images/{{Auth::user()->image}}" alt="Alt Text">
                            
                            <div class="img-push">                    
                                <input wire:key="{{$loop->index}}comentInput" type="text" class="form-control" 
                                    placeholder="Press enter to post comment" 
                                    style="height:30px;border-radius:50px;"
                                    wire:keydown.enter.prevent="addComment({{$ser->id}}, '{{ $ser->title }}')" wire:model="comment.postId{{$ser->id}}">
                            </div>            
                        </div>
                    @endif
                </div>
                 
            </div>  
            {{-- <div id="likesForPost{{$ser->id}}" class="modal fade"  tabindex="-1" role="dialog">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >{{__('ar.Likes')}}</h5>
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
            <div id="redosForPost{{$ser->id}}" class="modal fade"  tabindex="-1" role="dialog">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >{{__('ar.Redos')}}</h5>
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
            </div> --}}
        @endforeach       
    @else
        <div class="card card-widget mt-3">
            <span class="badge badge-danger col-12 p-2"> No Post found </span>
        </div>
    @endif
    <div wire:loading> <i class="fa fa-spinner fa-spin mr-1"></i>Loading</div>   
</div>
 
