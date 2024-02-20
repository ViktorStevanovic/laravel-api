@extends('layouts.admin')

@section('title', 'Admin Edit')
@include('partials.projects-header')

@section('main-content')

<section class="p-5 container">
    <h1 class="text-center">Modify Project</h1>
    {{-- Errors alert --}}
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.projects.layouts.create-or-edit')

        <button type="submit" class="btn btn-danger">Edit</button>
    </form>
</section>

@endsection