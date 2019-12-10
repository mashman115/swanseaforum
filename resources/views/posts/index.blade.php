@extends('layouts.app')

@section('title', ' - Posts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Create your own post </div>
                <div class="card-body">
                  @if ($errors->any())
                    <div>
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li> {{ $error }} </li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  @if (session('messagePost'))
                    <p style="color:green;"><b> {{ session('messagePost') }}</b></p>
                  @endif

                  <form method="POST" action="{{ route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
                    <br>
                    <input type="text" name="content" size=75 placeholder="Description" value="{{ old('content') }}">
                    <br>
                    Pick one or more tag(s):
                    <br>
                    @foreach($tags as $tag)
                      <input type="checkbox" name="tags[]" value="{{$tag->id}}" >{{$tag->tag}}
                    @endforeach
                    <input type="file" name="photo_name" value="{{ old('photo_name') }}"accept="image/*" >
                    <br>
                    @auth
                      <input type="submit" value="Post">
                    @else
                      <button type="button" disabled> Post </button> <i>Log in or Register to post. </i>
                    @endauth
                  </form>
                </div>
            </div>

        </div>
    </div>
</div>
<br>

@foreach ($posts as $post)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <a style="text-decoration:none; color:black" href="{{ route('posts.show', ['id' => $post->id]) }}">
                  <h3> {{ $post->title }}
                    @if ($post->photo_name)
                    -- Image Available
                    @endif
                  </h3>
                   Posted by:<b> {{ $post->user->username }} </b> -- {{ $post->created_at->diffForHumans()}}

                 </a>

                  @auth
                  @if (auth()->user()->id == $post->user->id)
                  @if (session('messageEdit'))
                    <p style="color:green;"> <b> {{ session('messageEdit') }}</b></p>
                  @endif
                  <div style="float:right">
                    <div>
                    <button type="button"  onclick="showOrHideEdit('{{$post->id}}')">Edit</button>
                   </div>
                  </div>
                  <div id="editForm{{ $post->id }}"  style="display:none;" >
                    <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
                      @csrf
                      <input type="text" name="title" placeholder="Title" value="{{ $post->title }}">
                      <br>
                      <input type="text" name="content" size=75 placeholder="Description" value="{{ $post->content }}">
                      <br>
                      <input type="submit" value="Edit Post">
                    </form>
                  </div>
                  @endif
                  @endauth
                </div>
                <div class="card-body"> {{ $post->content }}</div>

            </div>
        </div>
    </div>
</div>

<br>

@endforeach
<div class="row justify-content-center">
{{$posts->links()}}
</div>


@endsection
