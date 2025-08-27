@props([
    'seo'=>[
        
    ],
    'header'=> [
        'btntext'=>'Book a 30 mins strategy call',
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
    <body class="min-h-screen bg-white fira-code -z-10 relative overflow-x-hidden">
        <div 
            x-cloak
            x-data="{ isSticky: false }" 
            x-init="window.addEventListener('scroll', () => { isSticky = window.scrollY > 10 })" 
            :class="isSticky 
                ? 'sticky top-0 bg-white backdrop-blur z-50 shadow-md' 
                : 'absolute top-0 bg-black/50'"
            id="headerstick" 
            class="w-full transition-all duration-300 ease-in-out"
        >
            <div class="relative w-full justify-between border-b border-gray-500 p-2 flex-1 gap-2 overflow-hidden mx-auto flex">
                <!-- Logo Toggle -->
                <a href="{{ url()->current() }}" class="flex md:pe-8 items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                    <!-- Default Logo -->
                    <img
                        x-cloak
                        x-show="!isSticky"
                        fetchpriority="high" decoding="async"
                        src="{{ asset('assets/siliconvalley/logo.webp') }}" 
                        alt="{{ config('app.name') }}" 
                        class="md:h-14 h-10 w-auto transition-all duration-300 ease-in-out"
                    />
                    
                    <!-- Sticky Logo -->
                    <img 
                        x-cloak
                        x-show="isSticky"
                        fetchpriority="high" decoding="async"
                        src="{{ asset('assets/siliconvalley/logo2.webp') }}" 
                        alt="{{ config('app.name') }}" 
                        class="md:h-12 h-8 w-auto transition-all duration-300 ease-in-out"
                    />
                </a>
                
                <div>
                    <nav x-cloak :class="isSticky 
                        ? 'text-black' 
                        : 'text-white'" class="flex items-center gap-4 h-full relative">
                        <a aria-label="Mailus" href="mailto:enquiry@optimalvirtualemployee.com" :class="isSticky ? 'border-black hover:text-white' : ''" class="border rounded-full p-2 hover:bg-sv-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                            </svg>
                        </a>
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            <!-- Button -->
                            <button aria-label="Callus" @click="open = !open" :class="isSticky ? 'border-black hover:text-white' : ''" class="border cursor-pointer rounded-full p-2 hover:bg-sv-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div
                                x-cloak
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                aria-hidden="true"
                                class="fixed mt-3 me-5 right-0 z-30 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div class="py-1">
                                    <a href="tel:+447411118134" class="block flex gap-2 items-center line-space-1 px-4 py-2 text-sm text-gray-700 tracking-widest font-bold hover:bg-gray-100">
                                        <img class="aspect-[1/1] h-8 w-8 rounded-full border border-dark inset-shadow-sm border border-black" src="{{asset('assets/location/UK.webp')}}" alt="UK"/>
                                        (+44)7411118134
                                    </a>
                                    <a href="tel:+12028499199" class="block flex gap-2 items-center line-space-1 px-4 py-2 text-sm text-gray-700 tracking-widest font-bold hover:bg-gray-100">
                                        <img class="aspect-[1/1] h-8 w-8 rounded-full border border-dark inset-shadow-sm border border-black" src="{{asset('assets/location/USA.webp')}}" alt="USA"/>
                                        (+1)2028499199
                                    </a>
                                    <a href="tel:+61489921411" class="block flex gap-2 items-center line-space-1 px-4 py-2 text-sm text-gray-700 tracking-widest font-bold hover:bg-gray-100">
                                        <img class="aspect-[1/1] h-8 w-8 rounded-full border border-dark inset-shadow-sm border border-black" src="{{asset('assets/location/USA.webp')}}" alt="USA"/>
                                        (+61)489921411
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    
        <main class="!p-0 justify-end relative -z-10">
            {{ $slot }}
        <main>
        
        <flux:modal name="book-a-call" :show="$errors->isNotEmpty()" focusable class="max-w-5xl overflow-hidden !bg-sv-primary !p-0">
            <livewire:modal.silicon-valley :buttonText="'Submit'"/>
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
        @if(!auth()->check())
        <script>
            document.addEventListener("click", function (e) {
                const ripple = document.createElement("div");
                ripple.classList.add("ripple");

                const size = 150;
                ripple.style.width = ripple.style.height = `${size}px`;

                ripple.style.left = `${e.pageX - size / 2}px`;
                ripple.style.top = `${e.pageY - size / 2}px`;

                document.body.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
            document.body.style.overflow = '';
            }, 600);
        </script>
        @endif
        @fluxScripts
    </body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5K42N2M2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</html>
