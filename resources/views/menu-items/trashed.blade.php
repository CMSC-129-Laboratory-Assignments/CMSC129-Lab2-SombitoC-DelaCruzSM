@extends('layouts.app')

@section('title', 'Trashed Menu Items')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-maroon text-white">
                <h4 class="mb-0"><i class="fas fa-trash"></i> Trashed Menu Items</h4>
            </div>
            <div class="card-body">
                @if($menuItems->count() > 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> These menu items have been soft-deleted. You can restore or permanently delete them.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Full Price</th>
                                    <th>Half Price</th>
                                    <th>Deleted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuItems as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>₱{{ number_format($item->full_price, 2) }}</td>
                                        <td>
                                            @if($item->half_price)
                                                ₱{{ number_format($item->half_price, 2) }}
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->deleted_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <form action="{{ route('menu-items.restore', $item->id) }}"
                                                  method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-sm btn-success"
                                                        title="Restore">
                                                    <i class="fas fa-undo"></i> Restore
                                                </button>
                                            </form>

                                            <form action="{{ route('menu-items.forceDelete', $item->id) }}"
                                                  method="POST"
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Permanently delete this menu item? This action cannot be undone!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Permanently Delete">
                                                    <i class="fas fa-times"></i> Delete Forever
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $menuItems->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Trash is empty. No deleted menu items found.
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('menu-items.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection