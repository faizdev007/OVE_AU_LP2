@props([
    'title' => null,
    'alt' => null,
    'arialabel' => null,
    'target' => 'querysubmit', // Make the target customizable
])

<button 
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'relative inline-flex items-center justify-center uppercase cursor-pointer px-4 py-3 text-xs md:text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500'
    ]) }}
    wire:loading.attr="disabled"
    wire:target="{{ $target }}"
    aria-label="{{ $arialabel }}"
>
    <!-- Default Title -->
    <div class="flex inline-flex items-center text-center" wire:loading.remove wire:target="{{ $target }}">
        <div class="flex items-center gap-2">
            <div class="">{{ $title }}</div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ms-2 size-6">
                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Loading State -->
    <div  wire:loading wire:target="{{ $target }}" class="flex inline-flex items-center text-center justify-center gap-2">
        <div class="flex items-center gap-2">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"/>
            </svg>
            <div class="">
                Submitting...
            </div>
        </div>
    </div>
</button>
