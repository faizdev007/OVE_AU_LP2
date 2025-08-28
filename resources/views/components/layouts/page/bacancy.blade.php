@props([
    'seo'=>[
        
    ],
    'header'=> [
        'btntext'=>'strategy call',
        'menu'=>[
            'Our Talent',
            'Technical Stack',
            'Success Stories',
            'FAQs'
        ]
    ],
    'modal'=>[
        
    ]
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <flux:header sticky class="border-b z-40 border-gray-500 bg-zinc-50 !px-0">
            <div class="w-full lg:px-8 px-2">
                <div class="relative flex-1 gap-2 overflow-hidden mx-auto flex">
                    <a href="{{ url()->current() }}" class="flex md:pe-8 items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                        <img src="{{ asset('assets/bacancy/logo.webp') }}" alt="{{ config('app.name') }}" class="md:h-14 h-10 w-auto" />
                    </a>
    
                    <nav class="flex items-center py-3 text-black text-xs xl:text-lg lg:flex hidden font-bold">
                        @foreach($header['menu'] as $key=>$link)
                            <a class="px-3" href="{{'#'.(723+$key)}}">{{$link}}</a>
                        @endforeach
                    </nav>
                    
                    <flux:spacer />
            
                    <!-- <flux:sidebar.toggle class="lg:hidden border !text-white !bg-bacancy-primary" icon="bars-3" inset="left" /> -->
                    
                    <flux:navbar class="-mb-px !md:gap-4 !gap-1">
                        <flux:modal.trigger name="book-a-call">
                            <button
                                class="inline-flex gap-2 items-center cursor-pointer uppercase justify-center md:p-3 md:text-md text-xs p-2 font-medium text-black bg-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 2xl:text-[1.5rem] border-2 border-blue-600 text-nowrap hover:!text-white hover:!bg-[#1D4ED8] focus:!ring-[#1D4ED8]"
                                >
                                <span>
                                    Sign Up
                                </span>
                                <svg id="arrowsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 md:block hidden">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </flux:modal.trigger>
    
                        <flux:modal.trigger name="book-a-call">
                            <button
                                class="inline-flex gap-2 items-center cursor-pointer uppercase justify-center md:p-3 md:text-md text-xs p-2 font-medium text-white bg-blue-600 border-2 border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 !text-white 2xl:text-[1.5rem] text-nowrap !bg-bacancy-primary hover:!bg-[#1D4ED8] focus:!ring-[#1D4ED8]"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 md:block hidden">
                                <path d="M12 11.993a.75.75 0 0 0-.75.75v.006c0 .414.336.75.75.75h.006a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75H12ZM12 16.494a.75.75 0 0 0-.75.75v.005c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H12ZM8.999 17.244a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.006ZM7.499 16.494a.75.75 0 0 0-.75.75v.005c0 .414.336.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H7.5ZM13.499 14.997a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.005a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.005ZM14.25 16.494a.75.75 0 0 0-.75.75v.006c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75h-.005ZM15.75 14.995a.75.75 0 0 1 .75-.75h.005a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75H16.5a.75.75 0 0 1-.75-.75v-.006ZM13.498 12.743a.75.75 0 0 1 .75-.75h2.25a.75.75 0 1 1 0 1.5h-2.25a.75.75 0 0 1-.75-.75ZM6.748 14.993a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" />
                                <path fill-rule="evenodd" d="M18 2.993a.75.75 0 0 0-1.5 0v1.5h-9V2.994a.75.75 0 1 0-1.5 0v1.497h-.752a3 3 0 0 0-3 3v11.252a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3V7.492a3 3 0 0 0-3-3H18V2.993ZM3.748 18.743v-7.5a1.5 1.5 0 0 1 1.5-1.5h13.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-13.5a1.5 1.5 0 0 1-1.5-1.5Z" clip-rule="evenodd" />
                                </svg>
            
                                <span class="flex text-nowrap">
                                    <span class="md:block hidden">schedule</span> <span class="md:hidden block">Book</span> a call
                                </span>
                                <svg id="arrowsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 md:block hidden">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </flux:modal.trigger>
                    </flux:navbar>
                </div>
            </div>
        </flux:header>
    
        <flux:main class="!p-0">
            {{ $slot }}
        </flux:main>
        
        <flux:modal name="book-a-call" :show="$errors->isNotEmpty()" focusable class="max-w-6xl overflow-hidden !bg-gray-200 !p-0">
            <livewire:modal.hire-developer/>
        </flux:modal>

        <script>
            (function() {
                const elem = document.getElementById('responsive-text');
                const arrowsvg = document.getElementById('arrowsvg');
                if (!elem) return;
            
                function updateText() {
                    if (window.innerWidth < 768) {
                        elem.textContent = 'Book A Call';
                        arrowsvg.classList.add('hidden');
                    } else {
                        elem.textContent = '{{ $header["btntext"] }}';
                        arrowsvg.classList.remove('hidden');
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
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5K42N2M2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
</html>
