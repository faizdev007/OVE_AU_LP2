@props([
    'title'=> null,
    'alt'=> null,
    'arialabel'=> null,
])
<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex cursor-pointer items-center uppercase justify-center px-4 py-3 text-xs md:text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500']) }}>
    {{ $title }}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ms-2 size-6">
        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
    </svg>
</button>
