<form action="{{ route('dashboard') }}" method="GET" class="search-bar d-flex align-items-center">
    <div class="input-group search-input">
        <span class="input-group-text search-icon-wrapper border-end-0">
            {{-- Assuming you are using Bootstrap Icons --}}
            <i class="bi bi-search search-icon"></i>
        </span>

        <input
            type="text"
            name="search"
            class="form-control search-input-field border-start-0"
            placeholder="Search entries..."
            value="{{ request('search') }}"
        />
    </div>
</form>
