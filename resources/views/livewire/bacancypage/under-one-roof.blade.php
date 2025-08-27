<div class="my-12" section="tech-stack">
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>

                <div x-data="{ on: @entangle('block') }" class="flex items-center space-x-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="block" x-model="on" class="sr-only peer">
                        
                        <!-- Background track -->
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-green-500 rounded-full peer peer-checked:bg-green-500 transition-colors duration-300"></div>
                        <!-- Slider circle -->
                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 transform peer-checked:translate-x-5"></div>
                    </label>

                    <span class="text-sm font-medium text-gray-900" x-text="on ? 'Enabled' : 'Disabled'"></span>
                </div>




                <legend class="text-xl font-bold text-gray-900  markque px-2">Under One Roof</legend>
                <p class="text-gray-600 dark:text-gray-400">This is Technologies stack area</p>
                    <div>
                        <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                        <div class="md:flex mb-3">
                            <input wire:model="title" type="text"
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Title" />
                        </div>
                        <textarea wire:model="subtitle" rows="2" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                            placeholder="SubTitle" ></textarea>
                        
                            <fieldset class="mb-6 border-2 border-black p-4 relative">
                                <legend class="text-gray-600 dark:text-gray-400 font-bold">Tech Section</legend>
                                
                                <div class="grid md:grid-cols-4 gap-4">
                                    @foreach ($underOneRoofSections as $elementIndex => $element)
                                        <div>
                                            <div class="border p-4 rounded flex flex-col text-black shadow relative">
                                                {{-- Remove Button --}}
                                                <div class="text-right">
                                                        <button type="button"
                                                                wire:click="removeElement({{ $elementIndex }})"
                                                                class="absolute -top-2 -end-2 bg-red-500 text-white h-6 w-6 rounded-full hover:bg-red-600">X</button>
                                                </div>

                                                <label class="object-container mb-2">
                                                        <div class="w-full flex-col aspect-[2/1] p-1 flex items-center justify-center bg-gray-200 mb-2">
                                                            <div wire:loading wire:target="underOneRoofSections.{{ $elementIndex }}.icon" class="text-sm text-gray-500">Uploading...</div>
                                                            @if (isset($element['icon']) && is_object($element['icon']))
                                                                <img wire:loading.remove wire:target="underOneRoofSections.{{ $elementIndex }}.icon" src="{{ $element['icon']->temporaryUrl() }}" class="aspect-[1/1] h-14 w-14 p-1 rounded mb-2" />
                                                            @elseif($element['icon'] && !is_object($element['icon']))
                                                                <img wire:loading.remove wire:target="underOneRoofSections.{{ $elementIndex }}.icon" src="{{ asset($element['icon']) }}" class="aspect-[1/1] h-14 w-14 p-1 rounded mb-2" />
                                                            @else
                                                                <div class="text-center" wire:loading.remove wire:target="underOneRoofSections.{{ $elementIndex }}.icon">
                                                                    <p class="mb-0 pb-0">Tech Icon</p>
                                                                    <span class="text-xs">(Only Webp)</span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                    {{-- File Input --}}
                                                    <input type="file"
                                                        wire:model="underOneRoofSections.{{ $elementIndex }}.icon"
                                                        wire:change="removeIcon({{ $elementIndex }})"
                                                        accept="image/webp"
                                                        class="w-full hidden mb-2 border p-2 rounded" />
                                                    @error("underOneRoofSections.$elementIndex.icon")
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </label>

                                                {{-- Title --}}
                                                <input type="text"
                                                    wire:model.defer="underOneRoofSections.{{ $elementIndex }}.title"
                                                    placeholder="Name"
                                                    class="w-full mb-2 border p-2 rounded" />
                                                @error("underOneRoofSections.$elementIndex.title")
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror

                                                 {{-- Description --}}
                                                <textarea type="text"
                                                    wire:model.defer="underOneRoofSections.{{ $elementIndex }}.description"
                                                    placeholder="Description"
                                                    class="w-full mb-2 border p-2 rounded" ></textarea>
                                                @error("underOneRoofSections.{{ $elementIndex }}.description")
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Add More Elements Button --}}
                                <button type="button"
                                        wire:click="addElement()"
                                        class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                    + Add More Tech Icon
                                </button>
                            </fieldset>

                            <div class="md:flex mb-3 p-2 bg-black rounded-full w-max px-8">
                                <input wire:model="btnText" type="text"
                                        class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-black rounded-md w-full"
                                        placeholder="Button Text" />
                            </div>
                        
                            <!-- Save Button -->
                            <div class="absolute -top-10 px-2 end-0 flex justify-center">
                                <button type="submit" wire:loading.attr="disabled" class="px-6 cursor-pointer py-3 bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                                    <span wire:loading wire:target="save">saving...</span>
                                    <span wire:loading.remove wire:target="save">Save</span>
                                </button>
                            </div>
                    </form>
                </div>
            </fieldset>
        </div>
    @else
    <div @if($block === false) hidden @endif class="relative flex-1 gap-4 px-4 sm:px-6 lg:px-8 overflow-hidden container 2xl:px-12 mx-auto ">
        <div class="w-full max-w-5xl mx-auto">
            <flux:heading class="text-center">
                <h2 class="text-2xl xl:text-[45px] font-extrabold text-gray-900 ">{{$title}}</h2>
            </flux:heading>
            <flux:subheading class="text-center">
                <p class="mt-2 text-black xl:text-xl md:text-sm  mb-6">{{$subtitle}}</p>
            </flux:subheading>
        </div>
        <div class="flex flex-wrap justify-center gap-3 py-4">
            @foreach($underOneRoofSections as $key=>$item)
                <div class="overflow-hidden bg-white shadow rounded sm:w-50 w-68">
                    <div class="p-2 border rounded-t flex gap-2 bg-white flex-col items-center">
                        <div class="bg-bacancy-lightblue/70 p-1 rounded">
                            <img src="{{asset($item['icon'])}}" loading="lazy" class="h-10 aspect-[1/1]" alt="{{$item['title']}}"/>
                        </div>
                        <h2 class="font-bold text-black">{{$item['title']}}</h2>
                    </div>
                    <hr class="w-full">
                    <div class="p-2 text-sm text-black border border-t-0 rounded-b border-gray-300 text-justify">
                        <p>{{$item['description']}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center py-2">
            <flux:modal.trigger name="book-a-call">
                <x-action-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" title="{{ $btnText }}" class="!text-white w-max !bg-black hover:!bg-gray-800 focus:!ring-[#000000]" />
            </flux:modal.trigger>
        </div>
    </div>
    @endif
</div>
