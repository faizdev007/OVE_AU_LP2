<div class="py-12 border-b border-white scroll-mt-20 bg-sv-gradient" section="AI-ET">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <fieldset class="container relative p-4 rounded mx-auto border-2 border-white">
            <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
            <legend class="text-xl font-bold text-gray-900 bg-gray-100 border border-black markque px-2">AI-Enhanced-Talent</legend>
            <p class="text-white">Customize the AI-Enhanced-Talent section of your Bacancy landing page.</p>
            <form x-data="{
                    logopreview: null,
                    ai_logopreview: [null, null, null],
                    previewImage(event, index, isSingle = false) {
                        const file = event.target.files[0];
                        if (!file) return;
                        const reader = new FileReader();
                        reader.onload = e => {
                            if (isSingle) {
                                this.logopreview = e.target.result;
                            } else {
                                this.ai_logopreview[index] = e.target.result;
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                }" wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden mx-auto ">
                <div class="md:flex mb-3">
                    <input wire:model="aiblock_title" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                            placeholder="Title" />
                </div>
                <input wire:model="aiblock_watchword" type="text"
                            class="bg-white md:text-md mb-3 xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                            placeholder="watchword" />

                <textarea wire:model="aiblock_subtitle" rows="2" type="text"
                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                    placeholder="SubTitle" ></textarea>

                <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                    <input wire:model="btntext" type="text"
                            class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                            placeholder="Button Text" />
                </div>
                
                <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 bg-gray-100 border-black flex md:flex-row flex-col  justify-center items-center gap-2 mt-2">
                    <legend class="text-xl font-bold text-gray-900  bg-gray-100 border border-black markque px-2">AI Images Display Block</legend>

                    {{-- 1:1 Upload --}}
                    <div class="w-32 aspect-square bg-white aspect-[1/1] relative border-2 border-dashed rounded-lg flex items-center justify-center">
                        <template x-if="logopreview">
                            <img :src="logopreview" class="absolute inset-0 p-4 aspect-square object-container w-full h-full rounded-lg" />
                        </template>
                        <input 
                            type="file" 
                            accept=".webp"
                            wire:model="logo_webp"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                            @change="previewImage($event, null, true)"
                        />
                        <span class="text-gray-400 text-xs aspect-[1/1]" x-show="!logopreview">
                            @if ($logo_webp)
                                <img src="{{ asset($logo_webp) }}" class="aspect-square object-container" />
                            @else
                                1:1
                            @endif
                        </span>
                    </div>

                    {{-- 2:1 Upload #1 --}}
                    <div class="bg-white h-18 p-4 rounded-lg flex items-center justify-center aspect-[2/1] relative border-2 border-dashed">
                        <template x-if="ai_logopreview[0]">
                            <img :src="ai_logopreview[0]" class="absolute p-4 aspect-[2/1] object-container" />
                        </template>
                        <input 
                            type="file" 
                            accept=".webp"
                            wire:model="ai_logo_one"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                            @change="previewImage($event, 0)"
                        />
                        <span class="text-gray-400 bg-white text-xs" x-show="!ai_logopreview[0]">
                            @if ($ai_logo_one)
                                <img src="{{ asset($ai_logo_one) }}" class="aspect-[2/1] object-container" />
                            @else
                                2:1 #1
                            @endif
                        </span>
                    </div>

                    {{-- 2:1 Upload #2 --}}
                    <div class="bg-white h-18 p-4 rounded-lg flex items-center justify-center aspect-[2/1] relative border-2 border-dashed">
                        <template x-if="ai_logopreview[1]">
                            <img :src="ai_logopreview[1]" class="absolute p-4 aspect-[2/1] object-container" />
                        </template>
                        <input 
                            type="file" 
                            accept=".webp"
                            wire:model="ai_logo_two"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                            @change="previewImage($event, 1)"
                        />
                        <span class="text-gray-400 bg-white text-xs" x-show="!ai_logopreview[1]">
                            @if ($ai_logo_two)
                                <img src="{{ asset($ai_logo_two) }}" class="aspect-[2/1] object-container" />
                            @else
                                2:1 #2
                            @endif
                        </span>
                    </div>

                    {{-- 2:1 Upload #3 --}}
                    <div class="bg-white h-18 p-4 rounded-lg flex items-center justify-center aspect-[2/1] relative border-2 border-dashed">
                        <template x-if="ai_logopreview[2]">
                            <img :src="ai_logopreview[2]" class="absolute p-4 aspect-[2/1] object-container" />
                        </template>
                        <input 
                            type="file" 
                            accept=".webp"
                            wire:model="ai_logo_three"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                            @change="previewImage($event, 2)"
                        />
                        <span class="text-gray-400 bg-white text-xs" x-show="!ai_logopreview[2]">
                            @if ($ai_logo_three)
                                <img src="{{ asset($ai_logo_three) }}" class="aspect-[2/1] object-container" />
                            @else
                                2:1 #3
                            @endif
                        </span>
                    </div>
                </fieldset>

                <!-- Save Button -->
                <div class="absolute -top-10 px-2 end-0 flex justify-center">
                    <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 bg-bacancy-primary cursor-pointer text-white rounded-full hover:bg-gray-800 transition">
                        <span wire:loading wire:target="save">saving...</span>
                        <span wire:loading.remove wire:target="save">Save</span>
                    </button>
                </div>
            </form>
        </fieldset>
    @else
    <div class="container py-12 relative md:flex grid flex-1 gap-4 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden mx-auto ">
        <div class="w-full flex-1 flex gap-6 pt-10 justify-between text-center md:text-start flex-col mx-auto">
            <div class="flex flex-col gap-4">
                <flux:heading class="">
                    <h2 class="xl:text-3xl font-[900] text-white">{{$aiblock_title}}</h2>
                </flux:heading>
                <p class="mt-2 text-white text-3xl !font-[400] xl:text-4xl mb-6">{{$aiblock_watchword}}</p>
            </div>
            <p class="text-white text-lg xl:text-xl md:text-sm mb-6">{{$aiblock_subtitle}}</p>
            <flux:modal.trigger name="book-a-call">
                <x-silicon-valley.action-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" title="{{ $btntext }}" class="hover:bg-sv-secondary/50" />
            </flux:modal.trigger>
        </div>
        <div class="flex-1 w-full flex items-center justify-center relative">
            <div class="relative rounded-lg overflow-hidden bg-sv-primary inset-0 inset-shadow-sm inset-shadow-black p-8 items-center flex w-full md:w-auto p-4 gap-6">
                <div class="flex flex-1 items-center justify-center w-full">
                    <img loading="eager" decoding="async" src="{{ asset($logo_webp) }}" alt="Optimal Vertual Employee" class="aspect-square object-container"/>
                </div>
                <div class="text-white font-bold text-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6 font-bold">
                        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                    </svg>
                </div>
                <div class="flex-1 w-full flex flex-col justify-around gap-6 items-center">
                    <div class="bg-white xl:w-32 md:w-24 border h-18 md:p-4 p-1 rounded-lg shadow-lg md:me-10 flex items-center justify-center">
                        <img loading="lazy" decoding="async" src="{{ asset($ai_logo_one) }}" alt="AI Image One" class="object-container" />
                    </div>
                    <div class="bg-white xl:w-32 md:w-24 border h-18 md:p-4 p-1 rounded-lg shadow-lg md:ms-10 flex items-center justify-center">
                        <img loading="lazy" decoding="async" src="{{ asset($ai_logo_two) }}" alt="AI Image One" class="object-container" />
                    </div>
                    <div class="bg-white xl:w-32 md:w-24 border h-18 md:p-4 p-1 rounded-lg shadow-lg md:me-10 flex items-center justify-center">
                        <img loading="lazy" decoding="async" src="{{ asset($ai_logo_three) }}" alt="AI Image One" class="object-container" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>