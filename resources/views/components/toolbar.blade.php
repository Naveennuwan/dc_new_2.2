<div class="btn-group" role="group">
    <a id="home-link" href="/" 
    class="modern-btn btn-azure fixed-width-button-130">Back</a>
</div>
@if(isset($showSearchButton) && $showSearchButton)
<div class="btn-group" role="group">
    <button id="search-btn" class="modern-btn btn-peach fixed-width-button-130">Search</button>
</div>
@endif
@if(isset($showExportButton) && $showExportButton)
    <div class="btn-group" role="group">
        <button id="export-btn" class="btn btn-lime fixed-width-button-130">Export</button>
    </div>
@endif

@push('css')
@endpush