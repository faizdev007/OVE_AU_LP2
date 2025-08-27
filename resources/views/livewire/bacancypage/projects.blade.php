<div class="my-12" section="projects">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">Project display section</legend>
                <p class="text-gray-600 dark:text-gray-400">You can add and remove Project which you want to display!</p>
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
        
                        <fieldset class="mb-4 border-2 border-black p-4">
                            <legend class="text-gray-600 dark:text-gray-400 font-bold">Project Information Area</legend>
                            <div class="grid md:grid-cols-2 gap-4">
                                    @foreach ($projects as $index => $project)
                                    <div>
                                        <div class="block">
                                            {{-- Project Image --}}
                                            <div>
                                                <label class="block aspect-[2/1] object-container flex justify-center items-center h-full border shadow font-semibold">

                                                    @php
                                                        $image = $project['web_pic'] ?? null;
                                                        $isTempUpload = is_object($image);
                                                    @endphp

                                                    {{-- Image Preview --}}
                                                    @if ($isTempUpload)
                                                        <img loading="lazy" src="{{ $image->temporaryUrl() }}" class="rounded border w-full aspect-[2/1] object-container" />
                                                    @elseif ($image)
                                                        <img wire:loading.remove wire:target="projects.{{ $index }}.web_pic" loading="lazy" src="{{ asset($image) }}" class="rounded border w-full aspect-[2/1] object-container" />
                                                    @else
                                                        <div wire:loading.remove wire:target="projects.{{ $index }}.web_pic" class="w-full h-full aspect-[2/1] flex items-center justify-center flex-col bg-gray-100 text-center text-xs rounded text-black">
                                                            <p>Project Image</p>
                                                            <span>(webp, max 300kb)</span>
                                                        </div>
                                                    @endif

                                                    <div wire:loading wire:target="projects.{{ $index }}.web_pic" class="text-black">
                                                        Loading...
                                                    </div>

                                                    <!-- File Input -->
                                                    <input 
                                                        type="file" 
                                                        wire:model="projects.{{ $index }}.web_pic"
                                                        wire:change="removeChangeImg({{ $index }})"
                                                        accept=".webp"
                                                        class="w-full hidden"
                                                    />
                                                </label>
                                                @error("projects.$index.web_pic") 
                                                    <span class="text-red-500">{{ $message }}</span> 
                                                @enderror  
                                            </div>

                                            {{-- Text Inputs --}}
                                            <div class="border p-4 col-span-2 rounded flex flex-col text-black justify-between shadow relative">
                                                {{-- Remove Button --}}
                                                <div class="text-right">
                                                    @if (count($projects) > 1)
                                                        <button type="button" wire:click="removeProject({{ $index }})" class="absolute top-0 end-0 bg-red-500 text-white h-8 w-8 rounded hover:bg-red-600">X</button>
                                                    @endif
                                                </div>

                                                <div class="mt-5">
                                                    <input type="text" wire:model.lazy="projects.{{ $index }}.project_name" placeholder="Project Name" class="w-full mb-2 border p-2 rounded" />
                                                    @error("projects.$index.project_name") <span class="text-red-500">{{ $message }}</span> @enderror

                                                    <input type="text" wire:model.lazy="projects.{{ $index }}.label_tag" placeholder="Label Tag" class="w-full mb-2 border p-2 rounded" />
                                                    @error("projects.$index.label_tag") <span class="text-red-500">{{ $message }}</span> @enderror

                                                    <textarea wire:model.lazy="projects.{{ $index }}.brief_detail" rows="2" placeholder="Brief Detail" class="w-full mb-2 border p-2 rounded"></textarea>
                                                    @error("projects.$index.brief_detail") <span class="text-red-500">{{ $message }}</span> @enderror
                                                </div>

                                                {{-- Highlights Array Input --}}
                                                <div class="mt-2">
                                                    <label class="block font-semibold">Highlights</label>
                                                    @foreach ($project['highlights'] as $highlightIndex => $highlight)
                                                        <div class="flex gap-2 items-center mb-2">
                                                            <input type="text" wire:model.lazy="projects.{{ $index }}.highlights.{{ $highlightIndex }}" class="w-full border p-2 rounded" placeholder="Highlight {{ $highlightIndex + 1 }}" />
                                                            <button type="button" wire:click="removeHighlight({{ $index }}, {{ $highlightIndex }})" class="text-red-500 font-bold">✕</button>
                                                        </div>
                                                    @endforeach
                                                    <button type="button" wire:click="addHighlight({{ $index }})" class="mt-1 text-sm bg-gray-300 px-2 py-1 rounded hover:bg-gray-400">+ Add Highlight</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                            {{-- Add New Project Button --}}
                            <button type="button" wire:click="addProject" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                + Add More Project
                            </button>
                        </fieldset>
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
    <div class="relative grid text-center gap-4 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden mx-auto ">
        <div class="w-full mx-auto">
            <flux:heading class="text-center">
                <h2 class="text-2xl xl:text-[45px] text-black font-extrabold">{{$title}}</h2>
            </flux:heading>
            <flux:subheading class="text-center">
                <p class="mt-2 text-black xl:text-xl md:text-sm mb-6">{{$subtitle}}</p>
            </flux:subheading>
        </div>
        <x-auto-slider :cardmd="1" :cardlg="1" :cardxl="1" :card2xl="1" :interval="6000">
            @foreach($projects as $project)
                <x-bacancypage.project-card :project="$project" />
            @endforeach
        </x-auto-slider>
    </div>
    @endif
</div>
