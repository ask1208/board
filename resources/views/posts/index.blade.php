@extends('layouts.app')

@section('content')
<div class="card-header">board</div>
  <div class="card-body">
      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif

      @foreach($posts as $post)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h5 class="card-title">
              カテゴリー:
              <a href="{{ route('posts.index',['category_id' => $post->category_id] )}}">
              {{ $post->category->category_name }}
              </a>
              
            </h5>
            <h5 class="card-title">
              投稿者：
              <a href="{{ route('users.show',$post->user_id )}}">{{ $post->user->name }}</a>
              
            </h5>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.show',$post->id )}}" class="btn btn-primary">詳細</a>
          </div>
        </div>    
      @endforeach

      {{ $posts->links() }}
  </div>
@endsection