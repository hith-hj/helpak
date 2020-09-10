@extends('layouts.app')
@section('content')
<title>Funding</title>
<div class="col-md-12 " >
    {{-- @livewire('funding') --}}
    <div style="overflow-x: hidden !important">
        <div class="dis-flex">
            <div class="col-md-12 card ">
                
                <h5 class="alert alert-info mt-2" style="text-align:right">{{$msg}}</h5>
                <h5>please complete and confirm this information and correct if there is any mistakes</h5>
                @if(isset($fund))
                    <h1>fuck this this {{$fund}}</h1>
                @endif
                <form class="needs-validation mt-3" id="fundFormData" action="/getFunding" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label for="">Your full name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="full_name" value="{{Auth::user()->firstName}} {{Auth::user()->lastName}}"
                                placeholder="{{Auth::user()->firstName}} {{Auth::user()->lastName}}" required>
                            </div>                        
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                                </div>
                                <input type="text" class="form-control" name="phone"
                                 placeholder="{{Auth::user()->phone}}" value="{{Auth::user()->phone}}" required>    
                            </div>                    
                        </div>
                        
                        <div class="col-md-6 mb-1">
                            <label for="">Gender</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <select class="form-control" id="exampleFormControlSelect1" name="gender" required>
                                <option value="{{Auth::user()->gender}}" disabled>{{Auth::user()->gender}}</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>                    
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="">Age</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" inputmode="numeric" class="form-control" name="age"
                                 placeholder="{{Auth::user()->age}}" value="{{Auth::user()->age}}" required>
                            </div>                    
                        </div> 
                        <input type="hidden" name="address" value="{{Auth::user()->address}}">             
                        <div class="col-md-6 mb-1">
                            <label for="">how much you need + 2%</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" inputmode="numeric" class="form-control" name="fund_amount" placeholder="كتوب المبلغ الي بدك يا" title="كتوب المبلغ الي بدك يا" placeholder="" required>
                            </div>                    
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="">When do you need them </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <input type="date" class="form-control" name="fund_last_date" title="ايمتا بدك ياهون" required>                
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="">for what you are asking for this money (it should be a good reason)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-file"></i></span>
                                </div>
                            <textarea type="text" class="form-control" name="fund_reason" placeholder="حكيلي ليش بدك ياهون لاقدر ساعدك" 
                            title="حكيلي ليش بدك ياهون لاقدر ساعدك" required maxlength="2500"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="">Any additional info</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                                </div>
                            <textarea type="text" class="form-control" name="extra_info" placeholder="اذا في اي شغلات تانية بتحب تضيفا كتبا هون"
                            title="اذا في اي شغلات تانية بتحب تضيفا كتبا هون" maxlength="600"></textarea>
                            </div>
                        </div>
                    </div> 
                          
                    <button class="btn btn-primary col-12 my-2" type="submit" >Done</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div> 
@endsection
