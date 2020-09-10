<div class="mt-2  " >
    <div class="card card-widget ">
        <div class="input-group">
            <i id="store" class="fa fa-check " style="position: absolute;z-index: 100;top: 5px;left: 10px;" wire:click="storeNew()"></i>
                
            <textarea name="content" class="form-control form-control-sm input-group-text"               
                    style=" @error('post_content') border:2px solid red; @enderror {{ $status == 'Done' ? 'border:2px solid lightgreen':''}}"
                    placeholder="{{ $status == 'Done' ? 'Done your Service is published': $placeholder }}"              
                    wire:model="post_content" wire:keydown.enter.prevent="storeNew()" maxlength="1000" rows="1" oninput="
                    document.querySelector('#store').style.display = 'block'
                    "> </textarea>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary dropdown-toggle text-dark" type="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false" style="background-color: #ddd;color:#222;opacity: .7">{{$placeholder}}</button>
                <div class="dropdown-menu dropdown-menu-right" >
                <a class="dropdown-item" href="#" wire:click="setType('service')" >{{__('ar.Service')}}</a>
                <a class="dropdown-item" href="#" wire:click="setType('dakish')" >{{__('ar.Dakish')}}</a>
                </div>
            </div>  
            @if($imageInput == 1)  
                <div class="input-group m-1 animated fadeIn" style="display: flex;height:50px">       
                    <i class="fa fa-plus"style="position: absolute;z-index: 1000;font-size: 15px;top:15px;left:5px"
                        onclick="document.querySelector('#item_image').click();
                        document.querySelector('#imageLabel').style.display='none'">  </i>             
                    <form id="getImage" action="/upload/image" method="POST" class="custom-file" enctype="multipart/form-data" >  
                        @csrf
                        <input type="text" class="custom-file-input" name="id" wire:model="dakishId"  hidden>                                                     
                        <input type="file" id="item_image" class="custom-file-input" name="item_image[]" multiple onchange="displayUploadedImages(event)"> 
                        <label for="item_image" id="imageLabel" style="opacity:.5;width:100%;margin-left: -550px;margin-top: 15px;"> Add images of your item Optional<small>(max 4)</small></label>     
                        <div id="images_gal" class="dis-flex" style="z-index: 10000"></div>    
                    </form>  
                </div>
            @endif
        </div>
        @if(strlen($post_content) > 5 )
            <span class="badge badge-primary badge-xs mt-1" >
                Enter to publish 
            </span>
        @endif
        @error('post_content')
            <span class="badge badge-danger badge-xs mt-1" >
                {{ $message }} 
            </span>
        @enderror    
    </div>
    
</div>

  
  