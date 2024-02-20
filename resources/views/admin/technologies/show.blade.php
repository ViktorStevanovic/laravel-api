@extends('layouts.admin')

@section('title', 'All technologys')

@include('partials.technologies-header')
@section('main-content')

    <div class="container">
        @include('partials.session-message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Technology {{ $technology->id }}</h5>
                    <div class="card-body">
                        <h2 class="card-title">{{ $technology->name }}</h2>
                        <p class="card-text mb-3">Link to {{$technology->name}}'s documentation: 
                            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ $technology->documentation_link }}">{{ $technology->documentation_link }}</a>
                        </p>

                        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning">Edit</a>

                        <!-- Modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#modal' . $technology->id}}">Delete</button>
                        <div class="modal fade" id="{{ 'modal' . $technology->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel">Delete</h1>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want delete the technology {{ $technology->name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
