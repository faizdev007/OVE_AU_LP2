<div>
    {{-- In work, do what you enjoy. --}}
    <div class="mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search landing pages..." class="p-2 w-full md:w-1/3 border rounded shadow" />
    </div>

    <div class="border p-2 rounded-lg bg-gray-50 dark:bg-gray-900">
        @if($landing_pages->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('No landing pages found.') }}</p>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-black text-white dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('page_name')">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('lp_theme')">
                                Template
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('lp_url')">
                                URL
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                Created
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($landing_pages as $page)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 capitalize whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $page->page_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    {{ $page->lp_theme }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500 truncate max-w-[200px]">
                                    <a target="_blank" href="{{ route('showlandingpage', $page->lp_url) }}"> {{ $page->lp_url }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $page->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                    <a href="{{ route('create_lp_content', $page->lp_url) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('delete_lp_content', $page->lp_url) }}" method="POST" class="inline" onsubmit="return confirm('{{ __(`Are you sure you want to delete this landing page?`) }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 cursor-pointer text-white rounded hover:bg-red-600">
                                            {{ __('Delete') }}
                                        </button>
                                    </form> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($landing_pages->hasPages())
                <div class="mt-4">
                    {{ $landing_pages->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
