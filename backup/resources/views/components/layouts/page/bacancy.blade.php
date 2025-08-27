@props([
    'header'=> [
        'btntext'=>'Book a 30 mins strategy call',
        'menu'=>[
            'Our Talent',
            'Technical Stack',
            'Case Study',
            'FAQs'
        ]
    ],
    'modal'=>[
        
    ]
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <flux:header sticky container class="border-b z-40 border-zinc-200 bg-zinc-50">
            <a href="{{ url()->current() }}" class="flex md:pe-8 items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <img src="{{ asset('assets/bacancy/logo.webp') }}" alt="{{ config('app.name') }}" class="md:h-14 h-10 w-auto" />
            </a>
    
            <flux:navbar class="-mb-px max-lg:hidden">
                @foreach($header['menu'] as $key=>$link)
                <flux:navbar.item href="{{'#'.(723+$key)}}" class="!text-black">
                    {{$link}}
                </flux:navbar.item>
                @endforeach
            </flux:navbar>
    
            <flux:spacer />
    
            <!-- <flux:sidebar.toggle class="lg:hidden border !text-white !bg-bacancy-primary" icon="bars-3" inset="left" /> -->
            
            <flux:navbar class="-mb-px">
                <flux:modal.trigger name="book-a-call">
                    <button
                        class="inline-flex gap-2 items-center cursor-pointer uppercase justify-center px-4 py-3 font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 !text-white lg:text-[18px] text-nowrap !bg-bacancy-primary hover:!bg-[#1D4ED8] focus:!ring-[#1D4ED8]"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M12 11.993a.75.75 0 0 0-.75.75v.006c0 .414.336.75.75.75h.006a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75H12ZM12 16.494a.75.75 0 0 0-.75.75v.005c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H12ZM8.999 17.244a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.006ZM7.499 16.494a.75.75 0 0 0-.75.75v.005c0 .414.336.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H7.5ZM13.499 14.997a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.005a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.005ZM14.25 16.494a.75.75 0 0 0-.75.75v.006c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75h-.005ZM15.75 14.995a.75.75 0 0 1 .75-.75h.005a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75H16.5a.75.75 0 0 1-.75-.75v-.006ZM13.498 12.743a.75.75 0 0 1 .75-.75h2.25a.75.75 0 1 1 0 1.5h-2.25a.75.75 0 0 1-.75-.75ZM6.748 14.993a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" />
                        <path fill-rule="evenodd" d="M18 2.993a.75.75 0 0 0-1.5 0v1.5h-9V2.994a.75.75 0 1 0-1.5 0v1.497h-.752a3 3 0 0 0-3 3v11.252a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3V7.492a3 3 0 0 0-3-3H18V2.993ZM3.748 18.743v-7.5a1.5 1.5 0 0 1 1.5-1.5h13.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-13.5a1.5 1.5 0 0 1-1.5-1.5Z" clip-rule="evenodd" />
                        </svg>
    
                        <span id="responsive-text">
                            {{ $header['btntext'] }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </flux:modal.trigger>
            </flux:navbar>
        </flux:header>
    
        <flux:main class="!p-0">
            {{ $slot }}
        </flux:main>
        
        <flux:modal name="book-a-call" :show="$errors->isNotEmpty()" focusable class="max-w-5xl overflow-hidden !bg-bacancy-primary !p-0">
            <div class="md:flex md:p-0 py-4 items-center justify-between">
                <div class="flex-1 w-full aspect-[1/1] relative md:block hidden">
                    <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/modalpic2.webp') }}" alt="book_a_30_mins_strategy_call" height="500px" width="500px" class="w-full h-full object-cover" />
                    <div class="bg-black/50 absolute top-0 bottom-0 start-0 end-0 z-10"></div>
                    <div class="absolute top-0 bottm-0 start-0 end-0 z-20 flex flex-col justify-around h-full gap-3 p-4 text-white">
                        <h2 class="md:text-2xl text-xl text-center">Reduce Your hiring cost by upto 60%.</h2>
                        <ul>
                            <li class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                                Resume within 48 Hours with Quote
                            </li>
                            <li class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                                AI Powered Recruitment
                            </li>
                            <li class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                                No Upfront Cost
                            </li>
                            <li class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>    
                                Trusted by Startups & Fortune 500 Companies
                            </li>
                        </ul>
                        <div class="grid gap-2">
                            <h4>You are in good company - </h4>
                            <div class="grid grid-cols-4">
                                <div class="">
                                    <h3 class="font-bold uppercase">ESTD</h3>
                                    <p>2006</p>
                                </div>
                                <div class="">
                                    <h3 class="font-bold uppercase">CMMI</h3>
                                    <p>Level 3</p>
                                </div>
                                <div class="">
                                    <h3 class="font-bold uppercase">Offices</h3>
                                    <p>4 Location</p>
                                </div>
                                <div class="">
                                    <h3 class="font-bold uppercase">Staff</h3>
                                    <p>400 +</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-start">
                            <img loading="lazy" decoding="async" src="{{asset('assets/ratingimg.webp')}}" alt="google rating" class="h-14"/>
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-full md:py-0">
                    <flux:heading center>
                        <h2 class="text-xl md:text-3xl font-bold  text-white text-center px-6">Talk to our experts</h2>
                    </flux:heading>
                    <h2 class="md:text-xl text-md text-center py-2  text-white">Kickstart Your Digital Journey Today</h2>
                    <livewire:request-form inputClass="text-white"/>
                </div>
            </div>
        </flux:modal>
        <script>
            (function() {
                const elem = document.getElementById('responsive-text');
                if (!elem) return;
            
                function updateText() {
                    if (window.innerWidth < 768) {
                        elem.textContent = 'Book A Call';
                    } else {
                        elem.textContent = '{{ $header['btntext'] }}';
                    }
                }
            
                // Run immediately
                updateText();
            
                // Optional: If you want it to change when resizing
                window.addEventListener('resize', updateText);
            })();
        </script>
        @fluxScripts
    </body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5K42N2M2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</html>
