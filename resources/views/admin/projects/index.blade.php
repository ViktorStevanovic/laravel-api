@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@include('partials.projects-header')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2 mb-3 text-center">
            <h2>
                These are all our available projects, {{ Auth::user()->name }}!
            </h2>
        </div>

        @include('partials.session-message')
        
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Used technologies</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $projects as $project )
                        <tr>
                            <th scope="row">
                                {{ $project->id }}
                            </th>
                            <td>
                                {{ $project->title }}
                            </td>
                            <td>
                                {{ $project->description }}
                            </td>
                            <td>
                            @foreach ($project->technologies as $technology)
                            
                                {{ $technology->name }}
                            
                            @endforeach
                            </td>

                            <td>
                                <div class="d-flex mt-2 gap-1">
                                    <a href="{{ route('admin.projects.show', $project) }}">
                                        <button class="btn btn-sm btn-primary">
                                            View
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}">
                                        <button class="btn btn-sm btn-success">
                                            Edit
                                        </button>
                                    </a>
                                    <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
    
                                        <button class="btn btn-sm btn-warning" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                There are no posts available
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection