@extends('layouts.app')
@section('content')
  <br>
  <div class="row">
    {{-- card --}}
    @foreach ($articles as $article)
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            {{-- cover --}}
            <img src="{{ $article->cover_url }}" class="card-img-top" alt="...">
            {{-- title --}}
            <h5 class="card-title">{{ $article->title }}</h5>
            <p class="card-text">{{ $article->content }}</p>
            {{-- author --}}
            <p class="card-text"><small class="text-muted">By {{ $article->author->name }}</small></p>
            {{-- read more --}}
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
          {{-- show comments --}}
          <div class="card-footer text-muted">
            Comments
          </div>
          <ul class="list-group list-group-flush" style="max-height: 150px; overflow-x: hidden; overflow-y: auto">
            @foreach ($article->comments as $comment)
              <li class="list-group-item">{{ $comment->content }} by <span
                  style="color: gray">{{ $comment->author->name }}</span></li>
            @endforeach
          </ul>
          {{-- add comment --}}
          @if (auth()->check())
            <div class="card-footer text-muted">
              <form action="" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="mb-3">
                  <label for="content" class="form-label">Comment</label>
                  <input type="text" class="form-control" id="content" name="content">
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
              </form>
            </div>
          @endif
        </div>
        <br>
      </div>
    @endforeach
    <div class="col-md-12">
      @php
        $page = request()->get('page') ?? 1;
      @endphp
      <a class="btn btn-primary" href="{{ route('articles.timeline') }}?page={{ $page - 1 }}">Previous</a>
      <a class="btn btn-primary" href="{{ route('articles.timeline') }}?page={{ $page + 1 }}">Next</a>
    </div>
  </div>
@endsection
