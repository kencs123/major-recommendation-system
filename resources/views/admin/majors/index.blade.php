@extends('layouts.admin')

@section('title', 'Majors Management')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Major
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <i class="bi bi-hash"></i> Order
                        </th>
                        <th>
                            <i class="bi bi-collection"></i> Major Name
                        </th>
                        <th>
                            <i class="bi bi-file-text"></i> Description
                        </th>
                        <th class="text-end">
                            <i class="bi bi-gear"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($majors as $major)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $major->idx }}</span>
                            </td>
                            <td>
                                <strong>{{ $major->name }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ Str::limit($major->description, 50) ?? 'No description' }}
                                </small>
                            </td>
                            <td class="text-end">
                                <a 
                                    href="{{ route('admin.majors.edit', $major->id) }}" 
                                    class="btn btn-sm btn-outline-primary btn-sm-custom"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form 
                                    action="{{ route('admin.majors.destroy', $major->id) }}" 
                                    method="POST" 
                                    style="display: inline;"
                                    onsubmit="return confirm('Are you sure? This action cannot be undone.');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="btn btn-sm btn-outline-danger btn-sm-custom"
                                        title="Delete"
                                    >
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-3">No majors yet. Create one to get started!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $majors->links() }}
        </div>
    </div>
</div>
@endsection