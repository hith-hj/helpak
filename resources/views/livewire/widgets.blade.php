<div class="mt-1" >
    <div class="card collapsed-card" >
      @if(isset($redos) && count($redos)>0)
      <div class="card-header">
        <h3 class="card-title"> <i class="fa fa-retweet mr-1"></i> {{__('ar.Latest Redos')}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
      </div>
      <div class="card-body p-0" style="display: none; overflow-y: auto; max-height:140px;">        
          <ul class="products-list product-list-in-card px-2">
            @foreach($redos as $re)
            <li class="" style="border-radius:4px;border-bottom:1px solid gray {{$loop->last ? 'mt-5':''}}">
              <div class="product-img">
                <img src="../storage/users_images/{{$re->user_image}}" alt="Product Image" class="img-circle mx-1 mt-2">
              </div>
              <div class="product-info">
                  <a href="/profile/{{$re->redo_user_id}}" class="product-title" style="color:black">{{$re->info}}
                  <span class="badge badge-primary float-right mr-1 mt-1">{{$re->created_at->diffForHumans()}}</span></a>
                  <span class="product-description">
                    on this <a href="{{route('showPost',[$re->post_id,$re->post_type])}}" style="color:#000">{{$re->post_type}}</a>
                  </span>
              </div>
            </li>
            @endforeach
          </ul>      
      </div>
      @else
      <div class="card-header"style="text-align: right">
        <h3 class="card-title"> <i class="fas fa-retweet mr-1"></i> {{__('ar.Latest Redos')}}</h3>
          <div class="card-tools mt-2">
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <br>
          <small >{{__('ar.Nothing yet')}}</small>
      </div>
      @endif
    </div>

    <div class="card collapsed-card" >
      @if(isset($people) && count($people)>0)		
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-users mr-1" ></i> {{__('ar.Other Good People')}}</h3>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus" ></i>
                
              </button>
          </div>
      </div>
      <div class="card-body p-0" style="display: none; overflow-y: auto; max-height:140px;">
          <ul class="products-list product-list-in-card px-2">
              @foreach ($people as $pe)
                <li class="" style="border-radius:4px;border-bottom:1px solid gray {{$loop->last ? 'mt-5':''}}">
                  <div class="product-img">
                      <img src="../storage/users_images/{{$pe->image}}" alt="Product Image" class=" img-circle mx-1 mt-2">
                  </div>
                  <div class="product-info">
                      <a href="/profile/{{$pe->id}}" class="product-title" style="color:black;">{{$pe->name}} 
                        <span class="badge badge-primary float-right mr-1 mt-1">Rate-{{$pe->rate}} | Goods-{{array_sum([$pe->service,$pe->dakish,$pe->donation])}}</span></a>
                      <span class="product-description"><small>{{$pe->about}}</small></span>                      
                  </div>
                </li>
              @endforeach          
          </ul>
      </div>
      @else 
        <div class="card-header"style="text-align: right">
          <h3 class="card-title"> <i class="fa fa-users mr-1" ></i> {{__('ar.Other Good People')}}</h3>
            <div class="card-tools mt-2">
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <br>
            <small >{{__('ar.Nothing yet')}}</small>
        </div>
      @endif
    </div> 
</div>
