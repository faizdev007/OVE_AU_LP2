{{-- Success is as dangerous as failure. --}}
<div class="bg-[#EAEAEA]" section="hero-section">
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">Hero Section</legend>
                <p class="text-gray-600 ">Customize the hero section of your Bacancy landing page.</p>
                <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl mx-auto dark:border-neutral-700">
                    <div class="md:flex mb-3">
                        <input wire:model="hero_title_one" type="text"
                                class="bg-white md:text-md rounded-e-none xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2  border-bacancy-primary rounded-md w-[50%]"
                                placeholder="Title Black" />
                        <input wire:model="hero_title_two" type="text"
                                class="bg-white text-bacancy-primary md:text-md xl:text-xl rounded-e-none rounded-s-none sm:text-sm text-xs border xl:p-6 md:p-4 p-2  border-bacancy-primary rounded-md w-[50%]"
                                placeholder="Title Blue" />
                        <input wire:model="hero_title_three" type="text"
                                class="bg-white md:text-md xl:text-xl sm:text-sm text-xs rounded-s-none text-black border xl:p-6 md:p-4 p-2  border-bacancy-primary rounded-md w-[50%]"
                                placeholder="Title Black" />
                    </div>
                    
                    <textarea wire:model="hero_subtitle" rows="4" type="text"
                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 border-bacancy-primary rounded-md w-full"
                        placeholder="SubTitle" ></textarea>
    
                    <fieldset class="mb-4 border-2 border-black p-4" x-data="{ lists: @entangle('hero_lists') }">
                        <legend class="text-gray-600  font-bold">Your list items goes here!</legend>
                        <ul class="grid xl:text-xl md:text-xs text-sm list-disc list-inside">
                            <template x-for="(title, index) in lists" :key="index">
                                <li class="text-gray-900  flex gap-2 mb-4 items-center">
                                    <input 
                                        x-model="lists[index]"
                                        type="text"
                                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                                        placeholder="list item"
                                        x-bind:placeholder="'List Item ' + (index + 1)"
                                    />
                                    <button type="button" @click="lists.splice(index, 1)" class="border h-full bg-red-500 text-white text-xl px-2 border-red-500 rounded-md">×</button>
                                </li>
                            </template>
                        </ul>
                        <button type="button" @click="lists.push('')" class="px-4 py-2 bg-green-600 text-white rounded-md">Add More</button>
                    </fieldset>
                    <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                        <input wire:model="btntext" type="text"
                                class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Button Text" />
                    </div>
                    <fieldset class="relative flex border-2 rounded border-black p-2">
                        <legend class="text-gray-600 font-bold">Image Over Text Fields!</legend>
                        <!-- Replace 'Text goes here' with input fields -->
                         <div class="">
                            <input wire:model="box1" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 text-center border-bacancy-primary rounded-md md:rounded-e-none"
                                placeholder="Enter value 1" />
                            <input wire:model="boxtextone" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 text-center border-bacancy-primary rounded-md md:rounded-e-none"
                                placeholder="box Title" />
                         </div>
                         <div class="">
                            <input wire:model="box2" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black xl:p-6 md:p-4 p-2 border text-center border-bacancy-primary rounded-md md:rounded-s-none md:rounded-e-none"
                                placeholder="Enter value 2" />
                            <input wire:model="boxtexttwo" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 text-center border-bacancy-primary rounded-md md:rounded-s-none md:rounded-e-none"
                                placeholder="box Title" />
                         </div>
                         <div class="">
                            <input wire:model="box3" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 text-center p-2 border-bacancy-primary rounded-md md:rounded-s-none"
                                placeholder="Enter value 3" />
                            <input wire:model="boxtextthree" type="text"
                                class="bg-white flex-1 w-full md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 text-center border-bacancy-primary rounded-md md:rounded-s-none"
                                placeholder="box Title" />
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
        </div>
    @else
        <div class="relative pt-10 py-2 pb-6 flex-1 overflow-hidden mx-auto md:px-4 dark:border-neutral-700">
            <div class="md:grid lg:grid-cols-3 md:grid-cols-2 items-center justify-center">
                <div class="flex-1 grid lg:col-span-2 xl:gap-6 md:py-0 py-3 gap-2 xl:gap-4 2xl:gap-6 px-6">
                    <h1 class="text-3xl xl:text-[2.6rem] 2xl:text-[3.5rem] font-extrabold text-gray-900 ">{{$hero_title_one}} <span class="text-bacancy-primary">{{$hero_title_two}}</span> {{$hero_title_three}}</h1>
                    <p class="mt-2 text-black xl:text-xl 2xl:text-[1.8rem] md:text-sm  font-bold mb-3">{{$hero_subtitle}}</p>
                    <div class="">
                        <ul class="flex flex-col justify-center gap-2 xl:gap-4 xl:text-xl 2xl:gap-5 2xl:text-3xl md:text-xs text-sm list-disc list-inside">
                            @php
                                $list = $hero_lists;
                            @endphp
                            @foreach($list as $item)
                                <li class="text-gray-900 flex gap-2">
                                    <span class="text-bacancy-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="xl:size-8 2xl:size-10 size-6">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    {{$item}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <flux:modal.trigger name="book-a-call">
                        <x-action-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" title="{{ $btntext }}" class="!text-white w-max !bg-bacancy-primary hover:!bg-[#1D4ED8] 2xl:text-[1.5rem] focus:!ring-[#1D4ED8]" />
                    </flux:modal.trigger>
                </div>
                <div class="flex-1 relative aspect-[1/1] flex items-center justify-center">
                    <div class="rounded-full relative overflow-hidden m-2 2xl:m-18 border-black flex items-center justify-center">
                        <div class="absolute bg-bacancy-lightblue z-10 w-full h-full"></div>
                        <div class="absolute rounded-full w-4/5 h-4/5 m-4 justify-center items-center bg-bacancy-lightblue z-10"></div>
                        <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/bacancy/hero_section_person.webp') }}" alt="{{ config('app.name') }}" class="relative z-20" />
                    </div>
                    <div class="absolute rounded-full w-full h-full z-30 p-2">
                        <div class="relative w-full h-full">
                            <div class="bg-white absolute w-[30%] top-[20%] xl:text-3xl text-xl font-bold text-center text-black border p-2 border-bacancy-primary rounded-md">{{$box1}}
                                <div class="text-bacancy-primary font-bold 2xl:text-xl xl:text-md text-xs text-wrap">{{$boxtextone}}</div>
                            </div>
                            <div class="bg-white absolute w-[30%] top-[26%] xl:text-3xl text-xl font-bold text-center end-0 text-black p-2 border border-bacancy-primary rounded-md">{{$box2}}
                                <div class="text-bacancy-primary font-bold 2xl:text-xl xl:text-md text-xs">{{$boxtexttwo}}</div>
                            </div>
                            <div class="bg-white absolute w-[30%] bottom-[20%] end-[10%] xl:text-3xl text-xl text-center font-bold text-black border p-2 border-bacancy-primary rounded-md">{{$box3}}
                                <div class="text-bacancy-primary font-bold 2xl:text-xl xl:text-md text-xs">{{$boxtextthree}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>