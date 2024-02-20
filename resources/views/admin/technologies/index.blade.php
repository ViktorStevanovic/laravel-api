@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@include('partials.technologies-header')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2 mb-3 text-center">
            <h2>
                These are all our available technologies, {{ Auth::user()->name }}!
            </h2>
        </div>
        @include('partials.session-message')
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $technologies as $technology )
                        <tr>
                            <th scope="row">
                                {{ $technology->id }}
                            </th>
                            <td>
                                {{ $technology->name }}
                            </td>
                            <td>
                                <div class="d-flex justify-self- gap-1">
                                    <a href="{{ route('admin.technologies.show', $technology) }}">
                                        <button class="btn btn-sm btn-primary">
                                            View
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', $technology) }}">
                                        <button class="btn btn-sm btn-success">
                                            Edit
                                        </button>
                                    </a>
                                    <form class="d-inline-block" action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
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