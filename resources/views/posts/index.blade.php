@extends('layouts.app')

@section('title', ' - Posts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (session('notAuthorized'))
            <p style="color:red;"><strong> {{ session('notAuthorized') }}</strong></p>
          @endif
            <div class="card">

                <div class="card-header"> Create your own post </div>
                <div class="card-body">


                  @if (session('messagePost'))
                    <p style="color:green;"><b> {{ session('messagePost') }}</b></p>
                  @endif
                  @if (session('messageDelete'))
                    <p style="color:red;"> <b> {{ session('messageDelete') }}</b></p>
                  @endif
                  <form method="POST" id="post" action="{{ route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
                    <br>
                    <textarea rows="4"cols="50"name="content"placeholder="Description"value="{{ old('content') }}"form="post"></textarea>
                    <br>
                    Pick one or more tag(s):
                    <br>
                    @foreach($tags as $tag)
                      <input type="checkbox" name="tags[]" value="{{$tag->id}}" >{{$tag->tag}}
                    @endforeach
                    <input type="file" name="photo_name" value="{{ old('photo_name') }}"accept="image/*" >
                    <br>
                    @auth
                      <button type="submit" class="btn btn-primary"> Post </button>
                    @else
                      <button type="button" class="btn btn-primary" disabled> Post </button> <i>Log in or Register to post. </i>
                    @endauth
                  </form>
                </div>
            </div>

        </div>
    </div>
</div>
<br>
@if ($errors->any())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <ul>
                @foreach ($errors->all() as $error)
                <li style="color:red"> {{ $error }} </li>
                @endforeach
              </ul>
  </div>
</div>
</div>
</div>
</div>
@endif


@foreach ($posts as $post)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <a style="text-decoration:none; color:black" href="{{ route('posts.show', ['id' => $post->id]) }}">
                  <h3> {{ $post->title }}
                    @if ($post->photo_name)
                    <div style="float:right;">
                      <img width="100px" height="100px" src="{{ url('/images/'.$post->photo_name) }}">
                    </div>
                    @endif
                  </h3>
                   Posted by:<b> {{ $post->user->username }} </b> -- {{ $post->created_at->diffForHumans()}}

                 </a>
                 @auth
                 @if(auth()->user()->isAdmin())
                 <form id="deleteForm" onsubmit="return confirm('Are you sure you want to delete?');" method="POST" action="{{route('posts.destroy',['id' => $post->id]) }}">
                   @csrf
                   @method('DELETE')
                   <button class="btn btn-danger" type="submit" > Delete </button>
                 </form>
                 @endif
                 @endauth
                  @auth
                  @if (auth()->user()->id == $post->user->id)
                  @if (session('messageEdit'.$post->id))
                    <p style="color:green;"> <b> {{ session('messageEdit'.$post->id) }}</b></p>
                  @endif

                  <div>
                    <div>
                    <button type="button" class="btn btn-dark"  onclick="showOrHideEdit('{{$post->id}}')">Edit</button>
                    <div style="float:left">
                    <form id="deleteForm" onsubmit="return confirm('Are you sure you want to delete?');" method="POST" action="{{route('posts.destroy',['id' => $post->id]) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit" > Delete </button>
                    </form>
                  </div>
                   </div>
                  </div>
                  <br>
                  <div id="editForm{{ $post->id }}"  style="display:none;" >
                    <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
                      @csrf
                      <input type="text" name="editTitle" placeholder="Title" value="{{ $post->title }}">
                      <br>
                      <input type="text" name="editContent" size=75 placeholder="Description" value="{{ $post->content }}">
                      <br>
                      Pick one or more tag(s):
                      <br>
                      @foreach($tags as $tag)
                        <input type="checkbox" name="editTags[]" value="{{$tag->id}}" @if($post->tags->contains($tag->id)) checked=checked @endif >{{$tag->tag}}
                      @endforeach
                      <button class="btn btn-primary" type="submit" > Edit </button>
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
