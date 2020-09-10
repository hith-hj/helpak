<section class="content">
    @if($post !== null && isset($post))
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title " style="margin-right:50px;">Detail</h3>
                            <h3 class="box-title ml-4" style="margin-right:50px;">Post title : <strong>{{$post->title}}</strong> </h3>
                            <h3 class="box-title ml-4" style="margin-right:50px;">Post type : <strong>{{$post->type}}</strong> </h3>
                            <h3 class="box-title ml-4" style="margin-right:50px;">Views Count : <strong>{{$post->viewCount}}</strong> </h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="#" data-toggle="modal" data-target="#DeleteModal"  class="btn btn-sm btn-danger" title="delete">
                                        <i class="fa fa-trash"></i><span class="hidden-xs"> delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-horizontal">

                            <div class="box-body">

                                <div class="fields-group">

                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">ID</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    !x{{$post->id}}v&&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <a href="/admin/userShow/{{$post->user_id}}">
                                                        {{$post->user_name}}&nbsp;
                                                    </a>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                   {{$post->title}}&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Type</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                   {{$post->type}}&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Content</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <span class="label label-success">{{$post->content}}</span>&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Likes</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">                                                    
                                                    <div class="dropdown">
                                                       {{$post->likes->count()}}&nbsp;&nbsp; <a data-toggle="dropdown" href="#">likes</a>
                                                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg likesMenu" >
                                                            @foreach($post->likes as $like)
                                                                <div style="display:flex" class="bg-dark">
                                                                    <div class="product-img">
                                                                        <img src="../../../storage/users_images/{{$like->user_info->image}}" 
                                                                        alt="user Image" class="img-size-50 img-circle m-2" style="heigth:40px;width:40px;">
                                                                    </div>
                                                                    <div class="product-info" style="margin-left:8px;">
                                                                        <a href="/profile/{{$like->user_id}}" class="product-title">
                                                                            {{$like->user_info->name}}<span >&nbsp;&nbsp;({{$like->created_at->diffForHumans()}})</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Comments</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="dropdown">
                                                        {{$post->comments->count()}}&nbsp;&nbsp; <a data-toggle="dropdown" href="#">comments</a>
                                                         <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg likesMenu" >
                                                             @foreach($post->comments as $com)
                                                                 <div style="display:flex" class="bg-dark">
                                                                     <div class="product-img">
                                                                         <img src="../../../storage/users_images/{{$com->user_info->image}}" 
                                                                         alt="user Image" class="img-size-50 img-circle m-2" style="heigth:40px;width:40px;">
                                                                     </div>
                                                                     <div class="product-info" style="margin-left:8px;">
                                                                         <a href="/profile/{{$com->user_id}}" class="product-title">
                                                                             {{$com->user_info->name}}<span >&nbsp;&nbsp;({{$com->created_at->diffForHumans()}})</span>
                                                                         </a><br>
                                                                         {{$com->content}}
                                                                     </div>
                                                                 </div>
                                                             @endforeach
                                                         </div>
                                                     </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Redos</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="dropdown">
                                                        {{$post->redos->count()}}&nbsp;&nbsp; <a data-toggle="dropdown" href="#">Redos</a>
                                                         <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg likesMenu" >
                                                             @foreach($post->redos as $redo)
                                                                 <div style="display:flex" class="bg-dark">
                                                                     <div class="product-img">
                                                                         <img src="../../../storage/users_images/{{$redo->user_info->image}}" 
                                                                         alt="user Image" class="img-size-50 img-circle m-2" style="heigth:40px;width:40px;">
                                                                     </div>
                                                                     <div class="product-info" style="margin-left:8px;">
                                                                         <a href="/profile/{{$redo->user_id}}" class="product-title">
                                                                             {{$redo->user_info->name}}<span >&nbsp;&nbsp;({{$redo->created_at->diffForHumans()}})</span>
                                                                         </a>
                                                                     </div>
                                                                 </div>
                                                             @endforeach
                                                         </div>
                                                     </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Asks</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    {{$post->asks->count()}}&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Request Count / Number</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    {{$post->requestCount}}/{{$post->requestNumber}}&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">File</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    
                                                    <a href="../../../storage/dakish_items/{{$post->file}}" target="_blank"> 
                                                        <img src="../../../storage/dakish_items/{{$post->file}}" 
                                                            style="height:130px;width:170px " alt="">
                                                    </a>
                                                    {{$post->file}}
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Created At</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    {{$post->created_at->format('Y M d')}}&nbsp; - ( {{$post->created_at->diffForHumans()}} )&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Updated At</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    {{$post->updated_at->diffForHumans()}}&nbsp;
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
    <div id="DeleteModal" class="modal fade"  tabindex="-1" role="dialog">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" >Are you Sure you want to Delete this </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <strong>if Your are not sure 100% it's should be done don't do it or ask someone else , </strong>
                    <strong>and remember you are also deleting likes ,comments,redos,asks every thing else on this post so be careful</strong>
                </div>
                <div class="modal-footer">
                    <a href="/admin/postDelete/{{$post->id}}" class="form-control-sm btn btn-danger" style="width:120px !important">Yes</a>
                    <a href="#" class=" form-control-lg btn btn-default" style="width:240px !important">No</a>
                </div>
            </div>
        </div>
    </div> 
    @else 
        <h5>Could not get the post </h5>
    @endif

    
</section>