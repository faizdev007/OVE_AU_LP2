<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
     @props([
    'title'=> null,
    'alt'=> null,
    'arialabel'=> null,
    ])
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-sv-secondary p-2 px-6 shadow-md hover:bg-sv-primary cursor-pointer font-bold rounded-full  text-white']) }}>
        {{ $title }}
    </button>
</div>