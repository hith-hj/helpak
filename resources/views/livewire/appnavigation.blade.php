<div >
    <nav class="nav nav-pills nav-justified">
        <a id="home" class="nav-item nav-link " onclick="setNavigate('home')" href="{{route('home')}}">
         <i class="fas fa-home fa-md"></i>
        </a>    
       <a id="chats" class="nav-item nav-link " onclick="setNavigate('chats')" href="{{route('chats')}}">
        <i class="fa fa-comments fa-md"></i>
       </a>
       <a id="asks" class="nav-item nav-link " onclick="setNavigate('asks')" href="{{route('asks')}}">
        <i class="fa fa-paper-plane fa-md"></i>
       </a>
       <a id="profile" class="nav-item nav-link " onclick="setNavigate('profile')" href="{{route('profile',['id'=>Auth::user()->id])}}">
        <i class="fa fa-user-circle fa-md"></i>
       </a>
       <a id="save" class="nav-item nav-link " onclick="setNavigate('save')" href="{{route('saved')}}">
        <i class="fa fa-save fa-md"></i>    
       </a>
    </nav>
    
</div>
{{-- 
    
    wire:click="setType('home')">
    wire:click="setType('chats')">
    wire:click="setType('asks')">
    wire:click="setType('profile')">
    wire:click="setType('save')">

     wire:click="goTo('home')"
    wire:click="goTo('chats')"
    wire:click="goTo('asks')"
    wire:click="goTo('profile')"
    wire:click="goTo('save')"

--}}