@extends('layouts.app')

@section('title', ' - Post')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h2 class="mt-4"> {{ $post->title }} </h2>
                  <hr>
                  <div> <p> {{ $post->content }} </p> </div> <hr>
                  <div> <b>Tags:</b>
                    @foreach ($post->tags as $tag)
                    -- {{$tag->tag}}
                    @endforeach
                  </div>
                  @if(!is_null($post->photo_name))
                  <div>
                    <img class="img-fluid rounded" src="{{ url('/images/'.$post->photo_name) }}">
                  </div>
                  @endif
                  <div> Posted by: <b>{{ $post->user->username }} </b></div>
                  <br>
                  <div id="root">
                <div class="card-body" v-for="comment in comments">
                  <b> @{{comment.user.username}} </b> --  @{{ comment.created_at}}
                    <div class ="card-footer"> @{{ comment.content }} </div>
                    <div v-if="comment.user_id == {{auth()->user()->id}}">

                      <form id="editID" v-bind:action="'http://swanseaforum.test/comments/'+comment.id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input onChange="updateActionEdit()" type="text" name="content" size=65 placeholder="Description" v-model.lazy="comment.content" value="comment.content">
                        <button type="submit" class="btn btn-secondary"> Edit Comment </button>
                      </form>
                    </div>
                  </div>
                <div class="card my-4">
                    <h6 class="card-header"> Comment on this post: </h5>
                      <div class="card-body">
                      <input type ="text" id="input" size="65" v-model.lazy="newComment">
                      <button class="btn btn-primary" @click="createComment"> Add Comment</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var app = new Vue({
    el: "#root",
    data() {
      return{
        comments: [],
        newComment: '',
      }
    this.$set(this.comments);
    },
    mounted(){
      this.getComments();
  },
methods:{
  getComments: function(){
    axios.get("{{ route('api.comments.index', ['id' => $post->id])}}")
    .then(response =>{
      this.comments = response.data;
      console.log(this.comments);
    })
    .catch(response =>{
      console.log(response);
    })
  },
  createComment: function(){
    axios.post("{{ route('api.comments.store', ['id' => $post->id, 'user_id' =>Auth::user()->id] ) }} ",{
      name: this.newComment,
    })
    .then(response =>{
      //this.comments.push(response.data);
      this.newComment = '';
      this.getComments();
    })
    .catch(response =>{
      console.log(response);
    })
  }
}
});
</script>
@endsection
