<div class="my-12 scroll-mt-20" id="724" section="tech-stack">
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>


                <legend class="text-xl font-bold text-gray-900  markque px-2">Technical Stack</legend>
                <p class="text-gray-600 dark:text-gray-400">This is technical stack area</p>
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
                        
                            @foreach ($techIconSections as $sectionIndex => $section)
                                <fieldset class="mb-6 border-2 border-black p-4 relative">
                                    <legend class="text-gray-600 dark:text-gray-400 font-bold">Tech Icon Section</legend>
                                       <div class="text-right">
                                        @if (count($section) > 1)
                                            <button type="button"
                                                    wire:click="removeSection({{ $sectionIndex }})"
                                                    class="absolute -top-6 -end-1 bg-red-500 text-white h-8 w-8 rounded hover:bg-red-600">X</button>
                                        @endif
                                    </div>
                                    {{-- Title Input --}}
                                    <input type="text"
                                        wire:model.defer="techIconSections.{{ $sectionIndex }}.title"
                                        placeholder="Section Title"
                                        class="w-full mb-4 text-black border p-2 rounded" />
                                    @error("techIconSections.$sectionIndex.title")
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror

                                    <div class="grid md:grid-cols-5 gap-4">
                                        @foreach ($section['elements'] as $elementIndex => $element)
                                            <div>
                                                <div class="border p-4 rounded flex flex-col text-black shadow relative">
                                                    {{-- Remove Button --}}
                                                    <div class="text-right">
                                                        @if (count($section['elements']) > 1)
                                                            <button type="button"
                                                                    wire:click="removeElement({{ $sectionIndex }}, {{ $elementIndex }})"
                                                                    class="absolute -top-2 -end-2 bg-red-500 text-white h-6 w-6 rounded-full hover:bg-red-600">X</button>
                                                        @endif
                                                    </div>

                                                    <label class="object-container mb-2">
                                                            <div class="w-full flex-col aspect-[2/1] p-1 flex items-center justify-center bg-gray-200 mb-2">
                                                                <div wire:loading wire:target="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.icon" class="text-sm text-gray-500">Uploading...</div>
                                                                @if (isset($element['icon']) && is_object($element['icon']))
                                                                    <img wire:loading.remove wire:target="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.icon" src="{{ $element['icon']->temporaryUrl() }}" class="w-full p-1 rounded mb-2" />
                                                                @elseif($element['icon'] && !is_object($element['icon']))
                                                                    <img wire:loading.remove wire:target="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.icon" src="{{ asset($element['icon']) }}" class="w-full p-1 rounded mb-2" />
                                                                @else
                                                                    <div class="text-center" wire:loading.remove wire:target="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.icon">
                                                                        <p class="mb-0 pb-0">Tech Icon</p>
                                                                        <span class="text-xs">(Only Webp)</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        {{-- File Input --}}
                                                        <input type="file"
                                                            wire:model="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.icon"
                                                            wire:change="removeIcon({{ $sectionIndex }},{{ $elementIndex }})"
                                                            accept="image/webp"
                                                            class="w-full hidden mb-2 border p-2 rounded" />
                                                        @error("techIconSections.$sectionIndex.elements.$elementIndex.icon")
                                                            <span class="text-red-500">{{ $message }}</span>
                                                        @enderror
                                                    </label>

                                                    {{-- Name --}}
                                                    <input type="text"
                                                        wire:model.defer="techIconSections.{{ $sectionIndex }}.elements.{{ $elementIndex }}.name"
                                                        placeholder="Name"
                                                        class="w-full mb-2 border p-2 rounded" />
                                                    @error("techIconSections.$sectionIndex.elements.$elementIndex.name")
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Add More Elements Button --}}
                                    <button type="button"
                                            wire:click="addElement({{ $sectionIndex }})"
                                            class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                        + Add More Tech Icon
                                    </button>
                                </fieldset>
                            @endforeach

                            {{-- Add Section --}}
                            <button type="button"
                                    wire:click="addSection"
                                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Add New Section
                            </button>
                        
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
    <div class="relative flex-1 gap-4 px-4 sm:px-6 lg:px-8 overflow-hidden mx-auto ">
        <div class="w-full max-w-5xl mx-auto">
            <flux:heading class="text-center">
                <h2 class="text-2xl xl:text-[45px] font-extrabold text-gray-900 ">{{$title}}</h2>
            </flux:heading>
            <flux:subheading class="text-center">
                <p class="mt-2 text-black xl:text-xl md:text-sm  mb-6">{{$subtitle}}</p>
            </flux:subheading>
        </div>
        <div class="overflow-hidden relative">
            @foreach($techIconSections as $key=>$category)
                <div class="md:flex 2xl:text-2xl mb-4 border-2 border-black justify-center w-full items-center shadow">
                    <div class="bg-bacancy-primary md:w-68 w-full border-2 font-bold border-bacancy-primary text-white p-4">{{$category['title']}}</div>
                    <div class="flex font-bold text-black divide-x divide-black no-scrollbar overflow-x-auto md:flex-1">
                        @foreach($category['elements'] as $item)
                            @if($item['icon'])
                                <div class="flex flex-col w-24 px-2 aspect-[2/1] py-4 relative">
                                    <img loading="lazy" src="{{ $item['icon'] }}" class="aspect-[2/1] h-6 w-full object-container" alt="{{ $item['name'] }}"/>
                                    <span class="px-3 text-[10px] text-nowrap absolute bottom-0 end-0">{{ $item['name'] }}</span>
                                </div>
                            @else   
                                 <div class="px-4 flex h-full items-center justify-center text-nowrap p-4">{{ $item['name'] }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
