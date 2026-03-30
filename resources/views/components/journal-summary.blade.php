@props(['totalJournals' => 0])

<div class="journal-summary-card d-flex flex-column p-4 gap-4 align-items-center justify-content-center">

    <div class="journal-summary-content text-center">
        <h4>Journal Summary</h4>
        <p>You have {{ $totalJournals }} journal entries.</p>
    </div>
</div>
