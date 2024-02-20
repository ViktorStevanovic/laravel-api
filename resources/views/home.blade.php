@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} - {{Auth::user()->name }}
                    <div class="p-5 d-flex justify-content-evenly">
                        <a href="{{route('admin.projects.index')}}"><button class="btn btn-outline-dark">Projects</button></a>
                        <a href="{{route('admin.technologies.index')}}"><button class="btn btn-outline-dark">Technologies</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
