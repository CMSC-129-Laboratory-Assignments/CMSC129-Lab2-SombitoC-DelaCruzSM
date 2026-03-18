<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;

Route::get('/', function () {
    return redirect()->route('menu-items.index');
});

// Resource routes for menu items (automatically creates all CRUD routes)
Route::resource('menu-items', MenuItemController::class);

// Additional routes for soft delete functionality
Route::get('menu-items/trashed/all', [MenuItemController::class, 'trashed'])->name('menu-items.trashed');
Route::patch('menu-items/{id}/restore', [MenuItemController::class, 'restore'])->name('menu-items.restore');
Route::delete('menu-items/{id}/force-delete', [MenuItemController::class, 'forceDelete'])->name('menu-items.forceDelete');