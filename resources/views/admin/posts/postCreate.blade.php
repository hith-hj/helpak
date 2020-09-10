<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Post</h3>                   
                </div>
                <form action="/admin/postStore" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" pjax-container="">
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 asterisk control-label">Type</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-text fa-fw"></i></span>
                                            {{-- <input type="text" id="name" name="name" value=""  placeholder="Input Name" required> --}}
                                            <select name="type" id="type" class="form-control name" required>
                                                <option disabled > Select one</option>
                                                <option value="service" onclick="dakishImage('service')">service</option>
                                                <option value="dakish" onclick="dakishImage('dakish')">dakish</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="username" class="col-sm-2 asterisk control-label">Content</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <textarea name="content" id="" rows="2" class="form-control username" placeholder="Post content" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group " id="dakishImage" style="display: none">
                                    <label for="username" class="col-sm-2 asterisk control-label">image</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image fa-fw"></i></span>
                                            <input type="file" name="dakishItem" id="" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="_token" value="YXoMSvIK3ARsffcGM8KEdStkmGBo7TJoRMOJXW9a">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="btn-group pull-left">
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</section>