<div class="py-6 border-b border-white bg-sv-gradient text-white relative overflow-hidden">
    <img 
        src="{{ asset('assets/siliconvalley/herobg.avif') }}" 
        srcset="{{ asset('assets/siliconvalley/herobg.webp') }} 1x, {{ asset('assets/siliconvalley/herobg.avif') }} 2x" 
        fetchpriority="high"
        decoding="async"
        alt="OVE Hero Background" 
        class="absolute top-0 h-full object-cover w-full z-0 pointer-events-none select-none"
    />
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
    <fieldset class="container relative text-white max-w-6xl p-4 my-20 rounded mx-auto border-2 border-white">
        <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
        <legend class="text-xl font-bold text-white  markque px-2">Hero Section</legend>
        <p>Customize the hero section of your SiliconValley landing page.</p>
        <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl mx-auto dark:border-neutral-700">
            <div class="flex flex-col gap-2 mb-4">
                <label for="hero_subtitle" class="text-sm font-medium">Hero SubTitle</label>
                <x-simple-text-editor id="hero_subtitle" name="hero_subtitle" content="{!! $hero_subtitle !!}" />
            </div>

            <div class="flex flex-col gap-2 mb-4">
                <label for="hero_title" class="text-sm font-medium">Hero Title</label>
                <x-simple-text-editor id="hero_title" name="hero_title" content="{!! $hero_title !!}" />
            </div>

            <div class="flex flex-col gap-2 mb-4">
                <label for="hero_shorttext" class="text-sm font-medium">Hero SortText</label>
                <x-simple-text-editor id="hero_shorttext" name="hero_shorttext" content="{!! $hero_shorttext !!}" />
            </div>
    
            <div class="flex flex-col gap-2 mb-4">
                <label for="buttonText" class="text-sm font-medium">Hero ButtonText</label>
                <input type="text"
                    class="px-3 py-2 border w-max rounded-full bg-sv-secondary border-gray-300 text-center focus:outline-none focus:ring-2 focus:ring-bacancy-primary"
                    placeholder="Enter hero subtitle"
                    wire:model="buttonText"
                ></input>
            </div>
            <fieldset class="container relative text-white max-w-6xl p-4 rounded mx-auto border-2 border-white">
                <legend class="text-xl font-bold text-white  markque px-2">Hero Profile Section</legend>
                <div class="md:flex gap-4">
                    <div class="flex aspect-[1.3/2] h-68 flex-col gap-2 mb-4">
                        <label class="text-sm font-medium">Hero Profile Image
                            @if (isset($heroPortfolio['image']) && is_object($heroPortfolio['image']))
                                <img src="{{ $heroPortfolio['image']->temporaryUrl() }}" class="w-full object-cover rounded border shadow-md" />
                            @elseif ($heroPortfolio['image'] && !is_object($heroPortfolio['image']))
                                <img src="{{ asset($heroPortfolio['image']) }}" class="w-full object-cover rounded border shadow-md" />
                            @else
                                <div class="h-12 w-full flex items-center justify-center border shadow-md text-sm text-white p-2">
                                    Upload Logo
                                </div>
                            @endif
                            <input type="file" wire:model="heroPortfolio.image" accept=".webp" class="hidden" />
                            @error("heroPortfolio.image") <span class="text-red-500">{{ $message }}</span> @enderror
                        </label>
                    </div>
                    <div class="">
                        <div class="flex flex-col gap-2 mb-4">
                            <label for="heroPortfolio.name" class="text-sm font-medium">Hero Profile Name</label>
                            <input type="text"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bacancy-primary"
                                placeholder="Enter hero profile name"
                                wire:model="heroPortfolio.name"
                            ></input>
                        </div>
                        <div class="flex flex-col gap-2 mb-4">
                            <label for="heroPortfolio.title" class="text-sm font-medium">Hero Profile Title</label>
                            <input type="text"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bacancy-primary"
                                placeholder="Enter hero profile title"
                                wire:model="heroPortfolio.title"
                            ></input>
                        </div>
                        <div class="">
                            <label class="text-sm font-medium">Hero Profile Icons</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($floatingIcons as $key => $icon)
                                    <label class="aspect-[1/1] flex items-center justify-center w-20 relative bg-white rounded border overflow-hidden">
                                        @if (isset($icon) && is_object($icon))
                                            <img src="{{ $icon->temporaryUrl() }}" class="w-full object-contain" alt="icon" />
                                        @elseif ($icon && !is_object($icon))
                                            <img src="{{ asset($icon) }}" class="w-full object-contain" alt="icon" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center border shadow-md text-sm text-white p-2 bg-gray-400">
                                                Upload Logo
                                            </div>
                                        @endif

                                        <!-- 👇 Fixed binding here -->
                                        <input type="file" wire:model="floatingIcons.{{ $key }}" wire:change="changefloatingIcon({{$key}})" accept=".webp" class="hidden" />

                                        @error("floatingIcons.$key")
                                            <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span>
                                        @enderror
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <!-- Save Button -->
            <div class="absolute -top-10 px-2 end-0 flex justify-center">
                <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 cursor-pointer bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                    <span wire:loading wire:target="save">saving...</span>
                    <span wire:loading.remove wire:target="save">Save</span>
                </button>
            </div>
        </form>
    </fieldset>   
    @else
    <div class="md:h-screen">
        <div class="relative md:flex grid flex-1 gap-4 md:space-y-0 space-y-32 py-6 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden mx-auto h-full">
            <div class="md:w-[60%] flex flex-col justify-around md:items-start items-center h-full relative">
                <div class="relative z-20 flex flex-col items-center gap-10 justify-center md:items-start h-full md:items-start">
                    <div class="flex flex-col md:text-left text-center gap-8">
                        <p class="md:text-xl 2xl:text-3xl text-xl">{!!$hero_subtitle!!}</p>
                        <h1 class="md:text-4xl lg:text-[50px] 2xl:text-[70px] text-3xl font-extrabold vast-shadow-bold">{!!$hero_title!!}</h1>
                        <div class="md:text-xl lg:text-[30px] 2xl:text-[40px] text-xl font-extrabold vast-shadow-bold">{!!$hero_shorttext!!}</div>
                    </div>
                    <flux:modal.trigger name="book-a-call">
                        <x-silicon-valley.action-button class="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'Hire Now')" title="{{ $buttonText }}" class="hover:bg-sv-secondary/50 text-sm md:text-xl 2xl:text-3xl" />
                    </flux:modal.trigger>
                </div>
            </div>
            <div class="md:w-[40%] w-full flex justify-center items-center relative">
                <div class="aspect-[1.3/2] rounded-xl p-1 lg:h-3/4 md:h-2/3 md:w-1/2 w-2/3 md:w-auto border-2 border-white relative">
                    <img fetchpriority="high" decoding="async" class="aspect-[1.3/2] object-cover rounded-xl h-full absolute top-2 start-2" src="{{asset($heroPortfolio['image'])}}" alt="Hero Profile Image"/>
                    <div class="w-full h-full relative">
                        <div class="bg-white shadow-md aspect-[1.5/1] 2xl:h-18 h-12 md:h-16 flex justify-center  animate-[bounce_2.7s_ease-in-out_infinite] max-w-auto p-2 rounded absolute top-5 -start-10">
                            <img fetchpriority="high" decoding="async" class="h-full object-container" src="{{asset($floatingIcons[0])}}" alt="IconOne">
                        </div>
                        <div class="bg-white shadow-md aspect-[1.5/1] 2xl:h-18 h-12 md:h-16 flex justify-center  animate-[bounce_2.3s_ease-in-out_infinite] max-w-auto p-2 rounded absolute -top-5 -end-10">
                            <img fetchpriority="high" decoding="async" class="h-full object-container" src="{{asset($floatingIcons[1])}}" alt="Icontwo">
                        </div>
                        <div class="bg-white shadow-md aspect-[1.5/1] 2xl:h-18 h-12 md:h-16 flex justify-center animate-[bounce_3s_ease-in-out_infinite] max-w-auto p-2 rounded absolute bottom-5 -start-10">
                            <img fetchpriority="high" decoding="async" class="h-full object-container" src="{{asset($floatingIcons[2])}}" alt="Iconthree">
                        </div>
                        <div class="bg-white shadow-md aspect-[1.5/1] 2xl:h-18 h-12 md:h-16 flex justify-center animate-[bounce_2s_ease-in-out_infinite] max-w-auto p-2 rounded absolute bottom-20 -end-10">
                            <img fetchpriority="high" decoding="async" class="h-full object-container" src="{{asset($floatingIcons[3])}}" alt="Iconfour">
                        </div>
                    </div>
                    <div class="border-e border-b pb-1 pe-1 absolute md:-bottom-6 -bottom-10 md:-end-20 -end-20 rounded-lg border-white">
                        <div class="bg-sv-primary p-3 py-1 rounded">  
                            <p class="text-center md:text-md 2xl:text-lg text-xs m-2">{{$heroPortfolio['name']}}</p>
                            <hr class="border-gray-200">
                            <div class="bg-gray-200/20 md:text-sm 2xl:text-lg text-xs p-1 px-2 rounded w-max m-2">{{$heroPortfolio['title']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
