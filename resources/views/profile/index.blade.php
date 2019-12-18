@extends('layouts.app')

@section('title', '-Finish Profile' )

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Finish your profile') }}</div>

                  <form method="POST" id="desc" action="{{ route('profile.store')}}" enctype="multipart/form-data">
                    @csrf
                    <textarea rows="4"cols="50"name="description"placeholder="Describe yourself"form="desc"></textarea>
                    <br>
                    <input type="submit" value="Done">
                  </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
