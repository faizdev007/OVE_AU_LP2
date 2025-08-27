<div class="py-12 border-b border-white scroll-mt-20 bg-sv-gradient-bottomtop">
    {{-- In work, do what you enjoy. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
    <fieldset class="container relative text-white max-w-6xl p-4 rounded mx-auto border-2 border-white">
        <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
        <legend class="text-xl font-bold text-white  markque px-2">Developers Section</legend>
        <p>Customize the Developer Profile section of your SiliconValley landing page.</p>
        <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl mx-auto dark:border-neutral-700">
            @foreach ($devProfile as $key => $value)
                <div class="md:flex gap-4 mb-6 items-start border p-4 rounded-md relative bg-white dark:bg-neutral-800">

                    <!-- Remove Developer Button -->
                    <button type="button" wire:click="removeProfile({{ $key }})" class="absolute top-1 end-0 bg-red-600 rounded-full right-2 text-white p-2 px-3 text-xs font-bold">
                        X
                    </button>

                    <!-- Image Section -->
                    <div class="flex flex-col items-center gap-2">
                        <label class="cursor-pointer relative group">
                            @if (isset($value['image']) && is_object($value['image']))
                                <img src="{{ $value['image']->temporaryUrl() }}" class="h-32 w-32 rounded-full object-cover border shadow-md" />
                            @elseif (!empty($value['image']) && !is_object($value['image']))
                                <img src="{{ asset($value['image']) }}" class="h-32 w-32 rounded-full object-cover border shadow-md" />
                            @else
                                <div class="h-32 w-32 rounded-full flex items-center justify-center bg-gray-200 text-gray-600 border shadow-md">
                                    Upload Image
                                </div>
                            @endif

                            <input type="file"
                                wire:model="devProfile.{{ $key }}.image"
                                accept=".webp"
                                class="hidden" />

                            @error("devProfile.$key.image")
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>

                    <!-- Details Section -->
                    <div class="flex-1">
                        <div class="flex gap-2 mb-4">
                            <div class="flex-1 flex flex-col gap-2 mb-4">
                                <input type="text"
                                    wire:model="devProfile.{{ $key }}.name"
                                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter name" />
                                @error("devProfile.$key.name")
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-1 flex flex-col gap-2 mb-4">
                                <input type="number"
                                    max="5"
                                    min="0"
                                    wire:model="devProfile.{{ $key }}.starts"
                                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter Rating" />
                                @error("devProfile.$key.starts")
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-1 flex flex-col gap-2 mb-4">
                                <input type="text"
                                    wire:model="devProfile.{{ $key }}.techStack"
                                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter Rating" />
                                @error("devProfile.$key.techStack")
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 mb-4">
                            <x-simple-text-editor name="devProfile[{{ $key }}][description]"
                                                content="{!! $value['description'] ?? '' !!}" />
                            @error("devProfile.$key.description")
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Projects Section (Always 4) -->
                        <fieldset class="flex gap-4 flex-wrap p-3 rounded border">
                            <legend class="text-sm font-semibold mb-2">Developer Projects</legend>
                            @foreach ($value['projects'] as $projectKey => $projectImage)
                                <label class="flex flex-col items-center gap-1">
                                    @if (isset($projectImage) && is_object($projectImage))
                                        <img src="{{ $projectImage->temporaryUrl() }}" class="h-28 w-28 rounded object-cover border shadow-md" />
                                    @elseif (isset($projectImage) && !is_object($projectImage))
                                        <img src="{{ asset($projectImage) }}" class="h-28 w-28 rounded object-cover border shadow-md" />
                                    @else
                                        <div class="h-28 w-28 rounded flex items-center justify-center bg-gray-200 text-gray-600 border shadow-md">
                                            Upload
                                        </div>
                                    @endif

                                    <input type="file"
                                        wire:model="devProfile.{{ $key }}.projects.{{ $projectKey }}"
                                        accept=".webp"
                                        class="hidden" />

                                    @error("devProfile.$key.projects.$projectKey")
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </label>
                            @endforeach
                        </fieldset>
                    </div>
                </div>
            @endforeach

            <!-- Add More Developer Button -->
            <div class="flex justify-center my-6">
                <button type="button" wire:click="addProfile" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition">
                    + Add Developer
                </button>
            </div>

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
    <x-auto-slider :cardmd="1" :cardlg="1" :cardxl="1" :card2xl="1" :autoSlide="true" :interval="6000">
        @foreach ($devProfile as $key => $value)
            <x-silicon-valley.dev-profile :devProfile="$value" />
        @endforeach
    </x-auto-slider>
    @endif
</div>
