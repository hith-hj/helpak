@extends('layouts.app')
@section('content')
<title>Hay Hay !!!!!</title>
<div class="col-md-12" >

    <div class="alert alert-danger mt-3 ml-3" role="alert">
      <h2 class="alert-heading">What the hell !!!</h2>
      <p>Where Are you trying to go , you will be redirected</p>
    </div>
  </div> 
@endsection

<script>
    window.addEventListener('click',function(){
       window.location.replace("http://127.0.0.1:8000/home"); 
    });
</script>