
<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $project->title) }}">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $project->description) }}">
</div>

<div class="mb-3">
    <div class="mb-3">
        <label for="type_id" class="form-label">Project Type:</label>
        <select name="type_id" id="type_id" class="form-select" aria-label="Default select example">
            <option selected>Please choose a type for the project</option>

            @foreach ($types as $type)
            <option value="{{ $type->id}}"
                {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}
                
            >{{$type->title}}</option>                
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <div>
        @foreach ($technologies as $technology)
        <input type="checkbox" class="form-check-input" name="technologies[]" id="technologies-{{$technology->id}}" value="{{ $technology->id }}"
        {{ in_array( $technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }}>
        <label for="technologies-{{$technology->id}}">{{ $technology->name}}</label>
        @endforeach
    </div>

</div>

<div class="mb-3">
    <label for="project_url" class="form-label">Project URL</label>
    <input type="text" class="form-control" name="project_url" id="project_url" value="{{ old('projects_url', $project->project_url) }}">
</div>

<div class="mb-3">
    <label for="used_languages" class="form-label">Used Languages</label>
    <input type="text" class="form-control" name="used_languages" id="used_languages" value="{{ old('used_languages', $project->used_languages) }}">
</div>
