@extends('layouts.app') @section('title', 'Menu Item Details')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header bg-info text-white">
        <h4 class="mb-0"><i class="fas fa-eye"></i> Menu Item Details</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 text-center mb-3">
            @if($menuItem->image)
            <img
              src="{{ asset('storage/' . $menuItem->image) }}"
              alt="{{ $menuItem->name }}"
              class="img-fluid rounded border"
            />
            @else
            <div
              class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
              style="height: 250px;"
            >
              <i class="fas fa-image fa-5x"></i>
            </div>
            @endif
          </div>
          <div class="col-md-8">
            <table class="table table-bordered">
              <tr>
                <th width="35%">Dish Name</th>
                <td>{{ $menuItem->name }}</td>
              </tr>
              <tr>
                <th>Full Serve Price</th>
                <td class="text-success fw-bold">
                  ₱{{ number_format($menuItem->full_price, 2) }}
                </td>
              </tr>
              <tr>
                <th>Half Serve Price</th>
                <td class="text-success fw-bold">
                  @if($menuItem->half_price) ₱{{
                  number_format($menuItem->half_price, 2) }} @else
                  <span class="text-muted">Not Available</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Availability</th>
                <td>
                  @if($menuItem->is_available)
                  <span class="badge bg-success">Available</span>
                  @else
                  <span class="badge bg-danger">Not Available</span>
                  @endif
                </td>
              </tr>
              <tr>
                <th>Created At</th>
                <td>{{ $menuItem->created_at->format('M d, Y h:i A') }}</td>
              </tr>
              <tr>
                <th>Updated At</th>
                <td>{{ $menuItem->updated_at->format('M d, Y h:i A') }}</td>
              </tr>
            </table>

            @if($menuItem->description)
            <div class="mt-3">
              <h5>Description:</h5>
              <p>{{ $menuItem->description }}</p>
            </div>
            @endif
          </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
          <a href="{{ route('menu-items.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Menu
          </a>
          <div>
            <a
              href="{{ route('menu-items.edit', $menuItem) }}"
              class="btn btn-warning"
            >
              <i class="fas fa-edit"></i> Edit
            </a>
            <form
              action="{{ route('menu-items.destroy', $menuItem) }}"
              method="POST"
              style="display: inline;"
              onsubmit="return confirm('Move this menu item to trash?');"
            >
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection