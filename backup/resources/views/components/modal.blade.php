@props(['title' => 'Modal Title'])
<!-- resources/views/components/modal.blade.php -->
<div 
    x-data="{ show: {{ isset($__livewire) ? '@entangle($attributes->wire(\'model\'))' : 'false' }} }" 
    x-show="show"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div @click.away="show = false" class="bg-white dark:bg-zinc-800 rounded-lg shadow-lg w-full max-w-lg p-6">
        <div class="text-right">
            <button @click="show = false" class="text-gray-500 hover:text-red-600">
                &times;
            </button>
        </div>
        
        {{ $slot }}
    </div>
</div>
