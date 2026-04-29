<!-- filepath: d:\petra-major-recommendation-system\resources\views\admin\majors\edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Major')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">
                    <i class="bi bi-pencil"></i> Edit Major
                </h5>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Validation Errors!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.majors.update', $major->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">
                            <i class="bi bi-collection"></i> Major Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            placeholder="e.g., Full Stack Development"
                            value="{{ old('name', $major->name) }}"
                            required
                        >
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">
                            <i class="bi bi-file-text"></i> Description
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="form-control @error('description') is-invalid @enderror" 
                            rows="4" 
                            placeholder="Brief description of this major..."
                        >{{ old('description', $major->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="idx" class="form-label fw-bold">
                            <i class="bi bi-hash"></i> Order
                        </label>
                        <input 
                            type="number" 
                            name="idx" 
                            id="idx" 
                            class="form-control @error('idx') is-invalid @enderror" 
                            placeholder="1"
                            value="{{ old('idx', $major->idx) }}"
                            required
                        >
                        <small class="text-muted">Used to sort majors in the quiz</small>
                        @error('idx')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Major
                        </button>
                        <a href="{{ route('admin.majors') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Danger Zone -->
                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading">
                        <i class="bi bi-exclamation-triangle"></i> Danger Zone
                    </h6>
                    <p class="mb-2">Deleting this major will remove all associated question options.</p>
                    <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="btn btn-outline-danger btn-sm"
                            onclick="return confirm('Are you absolutely sure? This action cannot be undone.');"
                        >
                            <i class="bi bi-trash"></i> Delete This Major
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection