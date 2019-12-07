@extends('layouts.app')

@section('title', ' - Post')


@section('content')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h2> {{ $post->title }} </h2>
                  <div> <h4> {{ $post->content }} </h4> </div>
                  <div> Tags:
                    @foreach ($post->tags as $tag)
                    {{$tag->tag}}
                    @endforeach
                  </div>
                  <div style="border: 1px solid black">
                    <img class="card-img" src="{{ url('/images/'.$post->photo_name) }}">
                  </div>
                  <div> Posted by: <b>{{ $post->user->username }} </b></div>
                  <br>
                <div class="card-body">
                  @if(count($post->comments) > 0)
                    @foreach ($post->comments as $comment)
                      <div>
                        <b>
                          @if ($comment->user->id == $post->user->id )
                            *{{ $comment->user->username }}*
                          @else
                            {{ $comment->user->username }}
                          @endif
                       </b> --  {{ $comment->created_at->diffForHumans()}} </div>
                      <div class ="card-footer"> {{ $comment->content }}


                        @auth
                            @if ($comment->user->id == auth()->user()->id)
                              @if (session('messageEdit'.$comment->id))
                                <p style="color:green;"> <b> {{ session('messageEdit'.$comment->id) }}</b>
                              @endif
                              <div style="float:right">
                                <button type="button"  onclick="showOrHideEdit('{{$comment->id}}')">Edit</button>
                              </div>
                              </p>
                              <div id="editForm{{ $comment->id }}"  style="display:none;" >
                                <form method="POST" action="{{ route('comments.update', ['id' => $comment->id])}}">
                                  @csrf
                                  <br>
                                  <input type="text" name="content" size=75 placeholder="Description" value="{{ $comment->content }}">
                                  <br>
                                  <input type="submit" value="Edit Comment">
                                </form>
                              </div>
                            @endif
                        @endauth
                      </div>
                      <br>
                    @endforeach
                  @else
                      <div> Be the first to leave a comment!</div>
                  @endif
                </div>
                <div class="card">
                    <div class="card-header"> Comment on this post
                      @if ($errors->any())
                        <div>
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li> {{ $error }} </li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      @if (session('message'))
                        <p><b> {{ session('message') }}</b></p>
                      @endif

                      <form method="POST" action="{{ route('comments.store')}}">
                        @csrf
                        <input size=70% type="text" name="content" value="{{ old('content') }}">
                        <input type = "hidden" name ="post_id" value= "{{ $post->id }}" >
                        @auth
                          <input type="submit" value="Post Comment">
                        @else
                          <button type="button" disabled> Post Comment </button> <br> <i>Log in or Register to post a comment.</i>
                        @endauth
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="root">
  <ul>
    <li>@{{comments}}</li>
  </ul>
</div>

<script>

var app = new Vue({
  el: "#root",
  data: {
    comments: [],
  },
  mounted(){
    axios.get("{{ route('api.comments.index', ['id' => $post->id])}}")
    .then(response =>{
      this.comments = response.data;
    })
    .catch(response =>{
      console.log(response);
    })
  },
});
</script>

@endsection
