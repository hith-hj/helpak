<section class="content">


    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Detail</h3>

                            <div class="box-tools">
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger 5e80b1f6f18c7-delete" title="Delete">
                                        <i class="fa fa-trash"></i><span class="hidden-xs">  Delete</span>
                                    </a>
                                </div>
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="http://127.0.0.1:8000/admin/auth/users/1/edit" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-edit"></i><span class="hidden-xs"> Edit</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="form-horizontal">
                            <div class="box-body">
                                <div class="fields-group">
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">ID</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->id}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show"> 
                                                <div class="box-body">
                                                    {{$user->name}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">first Name</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->firstName}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->lastName}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->gender}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Age</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->age}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->address}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->phone}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Role</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->role}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->email}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Rate</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->rate}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Services</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->service}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Dakishs</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->dakish}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Donation</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->donation}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Lang</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->lang}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">About</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    <span class="label label-success">{{$user->about}}</span> &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->image}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">setting</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->setting_id}}&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Created At</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->created_at->format('M d:h')}} &nbsp; - ({{$user->created_at->diffForHumans()}}&nbsp;)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Updated At</label>
                                        <div class="col-sm-8">
                                            <div class="box box-solid box-default no-margin box-show">
                                                <div class="box-body">
                                                    {{$user->updated_at->format('M d:h')}} &nbsp; - ({{$user->updated_at->diffForHumans()}}&nbsp;)
                                                </div>
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

</section>