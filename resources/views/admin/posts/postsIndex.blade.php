<section class="content">                       
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <div class="pull-right">

                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container&amp;_export_=all" target="_blank" class="btn btn-sm btn-twitter" title="Export"><i class="fa fa-download"></i><span class="hidden-xs"> Export</span></a>
                            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container&amp;_export_=all" target="_blank">All</a></li>
                                <li><a href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container&amp;_export_=page%3A1" target="_blank">Current page</a></li>
                                <li><a href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container&amp;_export_=selected%3A__rows__" target="_blank" class="export-selected">Selected rows</a></li>
                            </ul>
                        </div>

                        <div class="btn-group pull-right grid-create-btn" style="margin-right: 10px">
                            <a href="/admin/postCreate" class="btn btn-sm btn-success" title="New">
                            <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;New</span>
                            </a>
                        </div>

                    </div> 

                    <div class="pull-left">
                        <div class="btn-group grid-select-all-btn" style="display:none;margin-right: 5px;">
                            <a class="btn btn-sm btn-default hidden-xs"><span class="selected"></span></a>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                        </div>
                        <div class="btn-group" style="margin-right: 5px" data-toggle="buttons">
                            <label class="btn btn-sm btn-dropbox 5e7cd3e226639-filter-btn " title="Filter">
                            <input type="checkbox"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;Filter</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border hide" id="filter-box">
                    <form action="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container" class="form-horizontal" pjax-container="" method="get">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <div class="fields-group">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID</label>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-sm">
                                                <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                                </div>
                                                <input type="text" class="form-control id" placeholder="ID" name="id" value="">
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="btn-group pull-left">
                                            <button class="btn btn-info submit btn-sm"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                                        </div>
                                        <div class="btn-group pull-left " style="margin-left: 10px;">
                                            <a href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container" class="btn btn-default btn-sm"><i class="fa fa-undo"></i>&nbsp;&nbsp;Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="grid-table5e7cd3e221e49">
                        <thead>
                            <tr>
                                <th class="column-__row_selector__"> <div class="icheckbox_minimal-blue" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="grid-select-all" style="position: absolute; opacity: 0;"><ins class="iCheck-helper table-top-row" style=""></ins></div>&nbsp;</th>
                                <th class="column-id">Post ID<a class="fa fa-fw fa-sort" href="http://127.0.0.1:8000/admin/auth/users?_pjax=%23pjax-container&amp;_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc"></a>
                                </th>
                                <th class="column-username">Username</th>
                                <th class="column-name">type</th>
                                <th class="column-roles">category</th>
                                <th class="column-roles">Content</th>
                                <th class="column-name">Likes</th>
                                <th class="column-name">Comments</th>
                                <th class="column-name">Redos</th>
                                <th class="column-name">Views</th>
                                <th class="column-name">Request Count / Number</th>
                                <th class="column-name">File</th>
                                <th class="column-created_at">Created At</th>
                                <th class="column-updated_at">Updated At</th>
                                <th class="column-__actions__">Action</th>
                            </tr>
                        </thead>
                        @foreach ($posts as $post )
                        <tbody>
                            <tr>
                                <td class="column-__row_selector__">
                                    <div class="icheckbox_minimal-blue" style="position: relative;" aria-checked="false" aria-disabled="false">
                                        <input type="checkbox" class="grid-row-checkbox" data-id="1" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper table-top-row" style=""></ins>
                                    </div>
                                </td>
                                <td class="column-id">{{$post->id}}</td>
                                <td class="column-username">{{$post->user_name}}</td>
                                <td class="column-name">{{$post->title}}</td>
                                <td class="column-name">{{$post->type}}</td>
                                <td class="column-roles">
                                    <span class="label label-success">{{$post->content}}</span>
                                </td>
                                <td class="column-name">{{$post->likeCount}}</td>
                                <td class="column-name">{{$post->commentCount}}</td>
                                <td class="column-name">{{$post->redoCount}}</td>
                                <td class="column-name">{{$post->viewCount}}</td>
                                <td class="column-name">{{$post->requestCount}} / {{$post->requestNumber}}</td>
                                <td class="column-name">{{$post->file}}</td>
                                <td class="column-created_at">{{$post->created_at->diffForHumans()}}</td>
                                <td class="column-updated_at">{{$post->updated_at->diffForHumans()}}</td>
                                <td class="column-__actions__">
                                    <div class="grid-dropdown-actions dropdown" style="z-index:100;">
                                        <a href="/admin/postShow/{{$post->id}}" style="padding:0 5px">
                                        <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#Post{{$post->id}}Delet" style="padding:0 5px">
                                        <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <div id="Post{{$post->id}}Delet" class="modal fade"  tabindex="-1" role="dialog">
                            <div class="modal-dialog" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" >Are you Sure you want to Delete this {{$post->title}}</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <strong>if Your are not sure 100% it's should be done don't do it or ask someone else , </strong>
                                        <strong>and remember you are also deleting likes ,comments,redos,asks every thing else on this post so be careful</strong>
                                        <p>{{$post->content}}</p>
                                        <small>Likes: {{$post->likeCount}} || 
                                            Comments: {{$post->commentCount}} || 
                                            Redos: {{$post->redoCount}}  </small>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/admin/postDelete/{{$post->id}}" class="form-control-sm btn btn-danger" style="width:120px !important">Yes</a>
                                        <a href="#" class=" form-control-lg btn btn-default" style="width:240px !important">No</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
