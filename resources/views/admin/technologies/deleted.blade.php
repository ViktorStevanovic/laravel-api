@extends('layouts.admin')

@section('title', 'Admin Cycle bin')

@include('partials.technologies-header')
@section('main-content')

<div class="container">
    @include('partials.session-message')
    <div class="row">
        <div class="col-12 p-2 mb-3 text-center">
            <h2>
                These are all our deleted technologies, {{ Auth::user()->name }}!
            </h2>
        </div>
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
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
                                <div class="d-flex mt-2 gap-1">
                                    <form class="d-inline-block" action="{{ route('admin.technologies.restore', $technology) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
    
                                        <button class="btn btn-sm btn-warning" type="submit">
                                            Restore
                                        </button>
                                    </form>
                                    {{-- modal --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#modal' . $technology->id}}">Delete</button>
                                    <div class="modal fade" id="{{ 'modal' . $technology->id}}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalLabel">Delete</h1>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want delete {{ $technology->name }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.technologies.deleted.destroy', $technology) }}" method="POST">
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
                                There are no deleted technologies
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection