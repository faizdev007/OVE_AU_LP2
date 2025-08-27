<x-layouts.app :title="__('Optimal Virtual Employee')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show"
                class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3 transition-opacity duration-500"
            >
                {{ session('success') }}
            </div>
            {{session()->forget('success')}}
        @endif

        @if (session('error'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show"
                class="bg-red-100 text-red-800 px-3 py-2 rounded mb-3 transition-opacity duration-500"
            >
                {{ session('error') }}
            </div>
            {{session()->forget('error')}}
        @endif
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Create Landing Pages') }}</h2>
            <form action="{{route('create_lp_theme')}}" method="POST" class="grid auto-rows-min gap-4 md:grid-cols-4">
                @csrf
                <flux:input
                    name="page_name"
                    type="text" 
                    placeholder="{{ __('Enter landing page name') }}"
                    required
                    class="col-span-2"></flux:input>
                <flux:select 
                    name="template"
                    placeholder="{{ __('Select a template') }}"
                    required
                    class="">
                    <option value="bacancy">{{ __('bacancy') }}</option>
                    <option value="siliconvalley">{{ __('Silicon Valley') }}</option>
                </flux:select>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{ __('Create New Landing Page') }}
                </button>
            </form>
        </div>
        <livewire:landing-pages-table />
        <div class="hidden">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Landing Pages') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('Select a landing page to view or edit.') }}</p>
            <div class="border p-2 rounded-lg bg-gray-50 dark:bg-gray-900">
                @if($landing_pages->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('No landing pages found.') }}</p>
                @else
                    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-black text-white dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Template</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">URL</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Created</th>
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
                                            <a target="_blank" href="{{route('showlandingpage',$page->lp_url)}}"> {{$page->lp_url }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $page->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                            <a href="{{route('create_lp_content',$page->lp_url)}}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{route('delete_lp_content',$page->lp_url)}}" method="POST" class="inline" onsubmit="return confirm('{{ __(`Are you sure you want to delete this landing page?`) }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
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
    </div>
</x-layouts.app>
