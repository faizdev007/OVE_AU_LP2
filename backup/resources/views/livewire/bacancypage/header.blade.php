<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900 markque px-2">Header Section</legend>
                <p class="text-gray-600 ">Customize header section.</p>
                <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                    <div class="md:flex mb-3 gap-2">
                        @foreach($menu as $key=>$title)
                            <input wire:model="menu.{{$key}}" type="text"        
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="{{$title}}" />
                        @endforeach
                        </div>
                        <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                            <input wire:model="btntext" type="text"
                                    class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Button Text" />
                        </div>
                    <!-- Save Button -->
                    <div class="absolute -top-10 px-2 end-0 flex justify-center">
                        <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                            <span wire:loading wire:target="save">saving...</span>
                            <span wire:loading.remove wire:target="save">Save</span>
                        </button>
                    </div>
                </form>
            </fieldset>
        </div>
    @else
    <flux:header sticky container class="border-b hidden z-40 border-zinc-200 bg-zinc-50">
        <a href="{{ url()->current() }}" class="flex md:pe-8 items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
            <img src="{{ asset('assets/bacancy/logo.webp') }}" alt="{{ config('app.name') }}" class="md:h-14 h-10 w-auto" />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item href="#00723" class="!text-black" :current="request()->routeIs('dashboard')">
                {{ __('OurTalent') }}
            </flux:navbar.item>
            <flux:navbar.item href="#00724" class="!text-black" :current="request()->routeIs('dashboard')">
                {{ __('Technical Stack') }}
            </flux:navbar.item>
            <flux:navbar.item href="#00725" class="!text-black" :current="request()->routeIs('dashboard')">
                {{ __('Case Study') }}
            </flux:navbar.item>
            <flux:navbar.item href="#00726" class="!text-black" :current="request()->routeIs('dashboard')">
                {{ __('FAQs') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <!-- <flux:sidebar.toggle class="lg:hidden border !text-white !bg-bacancy-primary" icon="bars-3" inset="left" /> -->
        
        <flux:navbar class="-mb-px">
            <flux:modal.trigger name="book-a-call">
                <button
                    x-data="{ isMobile: window.innerWidth < 768 }"
                    x-init="window.addEventListener('resize', () => {
                        isMobile = window.innerWidth < 768;
                    })"
                    x-on:click.prevent="$dispatch('open-modal', 'book-a-call')"
                    class="inline-flex gap-2 items-center cursor-pointer uppercase justify-center px-4 py-3 font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 !text-white lg:text-[18px] text-nowrap !bg-bacancy-primary hover:!bg-[#1D4ED8] focus:!ring-[#1D4ED8]"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M12 11.993a.75.75 0 0 0-.75.75v.006c0 .414.336.75.75.75h.006a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75H12ZM12 16.494a.75.75 0 0 0-.75.75v.005c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H12ZM8.999 17.244a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.006ZM7.499 16.494a.75.75 0 0 0-.75.75v.005c0 .414.336.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H7.5ZM13.499 14.997a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.005a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.005ZM14.25 16.494a.75.75 0 0 0-.75.75v.006c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75h-.005ZM15.75 14.995a.75.75 0 0 1 .75-.75h.005a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75H16.5a.75.75 0 0 1-.75-.75v-.006ZM13.498 12.743a.75.75 0 0 1 .75-.75h2.25a.75.75 0 1 1 0 1.5h-2.25a.75.75 0 0 1-.75-.75ZM6.748 14.993a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" />
                    <path fill-rule="evenodd" d="M18 2.993a.75.75 0 0 0-1.5 0v1.5h-9V2.994a.75.75 0 1 0-1.5 0v1.497h-.752a3 3 0 0 0-3 3v11.252a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3V7.492a3 3 0 0 0-3-3H18V2.993ZM3.748 18.743v-7.5a1.5 1.5 0 0 1 1.5-1.5h13.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-13.5a1.5 1.5 0 0 1-1.5-1.5Z" clip-rule="evenodd" />
                    </svg>

                    <span x-text="isMobile ? 'Book a Call' : 'Book a 30 mins strategy call'"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </flux:modal.trigger>
        </flux:navbar>
    </flux:header>
    @endif
</div>
