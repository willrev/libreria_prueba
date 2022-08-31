@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{route('contactanos.store')}}" method="POST" >
            @csrf

        <div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter your name complete">
    <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

@error('name')
<p><strong>{{$message}}</p></strong>
@enderror

  <div class="form-group">
    <label for="">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  @error('email')
<p><strong>{{$message}}</p></strong>
@enderror

  <div class="form-group">
    <label for="exampleInputPassword1">Message</label>
    <!-- <input type="text" class="form-control" rows="3" > -->
    <textarea class="form-control" rows="3" id="message" name="message" placeholder="Your message"  ></textarea>
  </div>

  @error('message')
<p><strong>{{$message}}</p></strong>
@enderror

 <br>
  <button type="submit" class="btn btn-primary">Send Message</button>
</form>
@if (session('info'))
<script>
  alert ("{{session('info')}}");
  </script>
  
  @endif
        </div>
    </div>
</div>
@endsection