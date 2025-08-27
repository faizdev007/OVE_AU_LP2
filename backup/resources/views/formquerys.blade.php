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
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Form Querys') }}</h2>
        </div>
        <livewire:request-query-table />
    </div>
</x-layouts.app>
