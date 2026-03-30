<div class="card mb-3 w-75">
    <div class="card-body">
        <h5>{{ $journal->title }}</h5>
        <p>{!! $journal->content !!}</p>

        <button class="btn btn-warning btn-sm"
                onclick="openEditModal({{ $journal->id }}, '{{ $journal->title }}', `{!! addslashes($journal->content) !!}`)">
            Edit
        </button>

        <form action="{{ route('journals.delete', $journal->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</div>
