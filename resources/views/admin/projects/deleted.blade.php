@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@include('partials.projects-header')

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2 mb-3 text-center">
            <h2>
                These are all our available posts, {{ Auth::user()->name }}!
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
                        <th scope="col">Used Languages</th>
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
                                {{ $project->used_languages }}
                            </td>

                            <td>
                                <div class="d-flex mt-2 gap-1">
                                    <form class="d-inline-block" action="{{ route('admin.projects.restore', $project) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
    
                                        <button class="btn btn-sm btn-warning" type="submit">
                                            Restore
                                        </button>
                                    </form>
                                    {{-- modal --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#modal' . $project->id}}">Delete</button>
                                    <div class="modal fade" id="{{ 'modal' . $project->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalLabel">Delete</h1>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want delete the project {{ $project->name }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.projects.deleted.destroy', $project) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
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