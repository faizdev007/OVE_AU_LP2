
@props([
    'clients' => 'array',
])
<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
<div class="flex flex-row gap-5 overflow-x-auto scrollbar-hide px-2 sm:px-0 md:justify-center">
    <x-auto-slider :cardmd="3" :cardlg="4" :cardxl="4" :card2xl="4" :interval="4000">
        @foreach($clients as $client)
        <div class="w-full">
            <article class="snap-start flex-shrink-0 bg-bacancy-primary text-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center">
                <video
                    class="object-cover aspect-[2/3] w-full"
                    controls
                    preload="metadata"
                    loading="lazy"
                    poster="{{ asset($client['poster']) }}"
                    title="Testimonial by {{ $client['name'] }}"
                >
                    <source src="{{ $client['video'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="py-3 px-2 text-center">
                    <h4 class="text-lg font-semibold">{{ $client['name'] }}</h4>
                    <p class="text-sm">{{ $client['title'] }}</p>
                </div>
            </article>
        </div>
        @endforeach
    </x-auto-slider>
</div>