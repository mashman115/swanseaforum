<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Swansea Forum @yield('title')
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                          <div>
                              <a class="nav-link" href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">
                                <div> Profile </div>
                              </a>
                          </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<br>
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

                      <form id="editID" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" v-model="comment.id" value="comment.id" id="idfield">
                        <input onChange="updateActionEdit()" type="text" name="content" size=65 placeholder="Description" v-model.lazy="comment.content" value="comment.content">
                        <button type="submit" class="btn btn-secondary"> Edit Comment </button>
                      </form>
                    </div>
                  </div>
                <div class="card my-4">
                    <h6 class="card-header"> Comment on this post: </h5>
                      <div class="card-body">
                      <input type ="text" id="input" size="60" v-model.lazy="newComment">
                      <button class="btn btn-primary" @click="createComment"> Add Comment</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateActionEdit() {
        var url = document.getElementById("idfield").value;
        document.getElementById("editID").setAttribute("action", "http://swanseaforum.test/comments/" + url);
    }


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
