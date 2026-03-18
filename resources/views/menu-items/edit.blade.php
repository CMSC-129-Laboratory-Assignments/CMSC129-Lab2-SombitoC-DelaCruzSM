@extends('layouts.app')

@section('title', 'Edit Menu Item')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Menu Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu-items.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Dish Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $menuItem->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4">{{ old('description', $menuItem->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_price" class="form-label">Full Serve Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number"
                                       class="form-control @error('full_price') is-invalid @enderror"
                                       id="full_price"
                                       name="full_price"
                                       value="{{ old('full_price', $menuItem->full_price) }}"
                                       step="0.01"
                                       min="0"
                                       required>
                                @error('full_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="half_price" class="form-label">Half Serve Price</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number"
                                       class="form-control @error('half_price') is-invalid @enderror"
                                       id="half_price"
                                       name="half_price"
                                       value="{{ old('half_price', $menuItem->half_price) }}"
                                       step="0.01"
                                       min="0">
                                @error('half_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Leave empty if not applicable</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="is_available" class="form-label">Availability <span class="text-danger">*</span></label>
                        <select class="form-select @error('is_available') is-invalid @enderror"
                                id="is_available"
                                name="is_available"
                                required>
                            <option value="1" {{ old('is_available', $menuItem->is_available) == 1 ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ old('is_available', $menuItem->is_available) == 0 ? 'selected' : '' }}>Not Available</option>
                        </select>
                        @error('is_available')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Dish Image</label>

                        @if($menuItem->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $menuItem->image) }}"
                                     alt="{{ $menuItem->name }}"
                                     class="img-thumbnail"
                                     style="max-width: 200px;">
                                <p class="text-muted small">Current image</p>
                            </div>
                        @endif

                        <input type="file"
                               class="form-control @error('image') is-invalid @enderror"
                               id="image"
                               name="image"
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty to keep current image. Max: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('menu-items.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update Menu Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection