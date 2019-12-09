@extends('layouts.app')

@section('title', ' - Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div> <b>User:</b> {{$profile->user->name }} </div>
              <div> <b>Username:</b> {{$profile->user->username}} </div>
              <div> <b>Description of User:</b> {{$profile->description}} </div>
            </div>
        </div>
    </div>
</div>
@endsection
