<div class="mt-2 bg-light">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="false">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " id="dakish-tab" data-toggle="tab" href="#dakish" role="tab" aria-controls="dakish" aria-selected="true">Dakishs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="redo-tab" data-toggle="tab" href="#redos" role="tab" aria-controls="redos" aria-selected="false">Redos</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Donation</a>
        </li>         --}}
        <li class="nav-item">
          <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">My Information</a>
        </li>        
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
          {{-- @livewire('service',$id) --}}
        </div>
        <div class="tab-pane fade " id="dakish" role="tabpanel" aria-labelledby="dakish-tab">
          {{-- @livewire('dakish',$id) --}}
        </div>
        <div class="tab-pane fade" id="redos" role="tabpanel" aria-labelledby="redos-tab">
          {{-- @livewire('redos ',$id) --}}
        </div>
        {{-- <div class="tab-pane fade" id="asks" role="tabpanel" aria-labelledby="contact-tab">
          @livewire('asks',$id)
        </div> --}}
        <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
          My info here
        </div>
        
      </div>
</div>
