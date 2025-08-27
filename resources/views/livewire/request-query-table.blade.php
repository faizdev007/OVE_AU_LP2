<div>
    {{-- In work, do what you enjoy. --}}
    <div class="flex mb-4 justify-between items-center">
        <input wire:model.debounce.500ms="search"
            type="text"
            placeholder="Search by name/email/phone"
            class="border p-2 rounded w-full max-w-md"
        />

        <button wire:click="export"
            class="ml-4 p-2 bg-green-600 text-white rounded hover:bg-green-700" title="Export Sheet">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="border p-2 rounded-lg bg-gray-50 dark:bg-gray-900">
        @if($request_queries->isEmpty())
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
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('lp_url')">
                                Phone
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                Requirement
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($request_queries as $query)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 capitalize whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $query->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                    {{ $query->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500 truncate max-w-[200px]">
                                    {{ $query->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $query->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($request_queries->hasPages())
                <div class="mt-4">
                    {{ $request_queries->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
