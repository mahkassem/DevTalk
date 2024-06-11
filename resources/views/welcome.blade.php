@extends('layouts.app')
@section('content')
  <br>
  <div class="row">
    <div class="col-md-8">
      <h1>DevTalk</h1>
      <p class="lead">Welcome to the DevTalk community</p>
    </div>
    <div class="col-md-4">
      <a href="{{ route('articles.timeline') }}" class="btn btn-lg btn-primary">View Posts</a>
    </div>
  </div>
@endsection
