@extends('admin.layout')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">family_restroom</span>
        Data Keluarga
    </h1>

    <div class="mt-3 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
        <div class="flex gap-2">
            <button onclick="window.location.reload()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded inline-flex items-center gap-2 transition-colors duration-200" title="Refresh halaman">
                <span class="material-symbols-outlined">refresh</span>
                Refresh
            </button>
        </div>

        <div class="flex-1 max-w-md">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400 text-sm">search</span>
                </div>
                <input type="text" id="search-input" placeholder="Cari keluarga..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    value="{{ request('search') }}">
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

@include('admin.keluargas.partials.table')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    let searchTimeout;

    function performSearch() {
        const searchTerm = searchInput.value.trim();

        // Update URL without page reload
        const url = new URL(window.location);
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        url.searchParams.delete('page'); // Reset to first page when searching

        // Show loading state
        const tableContainer = document.querySelector('.mt-4.bg-white.rounded.shadow');
        const originalContent = tableContainer.innerHTML;
        tableContainer.innerHTML = `
            <div class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-600"></div>
                <span class="ml-2 text-gray-600">Mencari...</span>
            </div>
        `;

        // Fetch new content
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            }
        })
        .then(response => response.text())
        .then(html => {
            // Replace the entire table container with new content
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            const newTableContainer = tempDiv.querySelector('.mt-4.bg-white.rounded.shadow');
            if (newTableContainer) {
                tableContainer.innerHTML = newTableContainer.innerHTML;
            }

            // Update URL without reload
            window.history.pushState({}, '', url);
        })
        .catch(error => {
            console.error('Search error:', error);
            tableContainer.innerHTML = originalContent;
            alert('Terjadi kesalahan saat mencari. Silakan coba lagi.');
        });
    }

    // Debounced search on input
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 300); // 300ms delay
    });

    // Search on Enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            performSearch();
        }
    });
});
</script>
@endpush
@endsection