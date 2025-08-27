{{-- Close your eyes. Count to one. That is how long forever feels. --}}
<div class="my-12 scroll-mt-20" id="723" section="developer-profile">
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">Developer Profile Section</legend>
                <p class="text-gray-600 ">Customize the Developer Profile section of your Bacancy landing page.</p>
                <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl text-black mx-auto ">
                    <div class="md:flex mb-3">
                        <input wire:model="developer_title" type="text"
                                class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border md:p-4 p-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Title" />
                    </div>
                    <textarea wire:model="developer_subtitle" rows="4" type="text"
                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border xl:p-6 md:p-4 p-2 border-bacancy-primary rounded-md w-full"
                        placeholder="SubTitle" ></textarea>   

                    <fieldset class="mb-6 border-2 border-black p-4">
                        <legend class="text-gray-600 font-bold">Developer Profiles</legend>

                        <div class="grid md:grid-cols-3 gap-4">
                            @foreach ($developer_list as $index => $dev)
                                <div class="mb-6 border p-4 rounded border-black relative shadow-sm bg-gray-50">

                                    {{-- Remove Button --}}
                                    <div class="mt-4 text-right absolute -top-4 end-0">
                                        @if(count($developer_list) > 1)
                                            <button type="button" wire:click="removeDeveloper({{ $index }})"
                                                class="px-3 py-1 bg-red-500 text-white rounded-tr hover:bg-red-600">
                                                X
                                            </button>
                                        @endif
                                    </div>

                                    {{-- Avatar Upload --}}
                                    <div class="flex items-center gap-4 mb-4">
                                        <label class="cursor-pointer">
                                            @if (isset($dev['avtar']) && is_object($dev['avtar']))
                                                <img src="{{ $dev['avtar']->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-full border shadow-md" alt="Avatar Preview" />
                                            @elseif ($dev['avtar']  && !is_object($dev['avtar']))
                                                <img src="{{ asset($dev['avtar']) }}" class="h-24 w-24 object-cover rounded-full border shadow-md" alt="Stored Avatar" />
                                            @else
                                                <div class="h-24 w-24 flex items-center justify-center rounded-full bg-gray-200 border shadow-md text-sm text-gray-500">
                                                    Upload
                                                </div>
                                            @endif
                                            <input type="file" wire:model="developer_list.{{ $index }}.avtar" wire:change="removeAvtar({{$index}})" accept=".webp" class="hidden" />
                                            @error("developer_list.$index.avtar") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </label>

                                        <div class="flex-1">
                                            <input type="text" wire:model.defer="developer_list.{{ $index }}.name" maxlength="20"
                                                class="p-2 w-full border border-black rounded-md shadow-sm"
                                                placeholder="Developer Name" />
                                            @error("developer_list.$index.name") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    {{-- Profile & Company Logo --}}
                                    <div class="flex gap-2 mb-4">
                                        <input type="text" wire:model.defer="developer_list.{{ $index }}.profile" maxlength="20"
                                            class="p-2 w-full rounded-md border border-black shadow-sm"
                                            placeholder="Developer Profile" />
                                        @error("developer_list.$index.profile") <span class="text-red-500">{{ $message }}</span> @enderror

                                        <label class="cursor-pointer relative w-full rounded bg-gray-700">
                                            @if (isset($dev['company_logo']) && is_object($dev['company_logo']))
                                                <img src="{{ $dev['company_logo']->temporaryUrl() }}" class="h-12 w-full object-cover rounded border shadow-md" />
                                            @elseif ($dev['company_logo'] && !is_object($dev['company_logo']))
                                                <img src="{{ asset($dev['company_logo']) }}" class="h-12 w-full object-cover rounded border shadow-md" />
                                            @else
                                                <div class="h-12 w-full flex items-center justify-center border shadow-md text-sm text-white p-2">
                                                    Upload Logo
                                                </div>
                                            @endif

                                            <input type="file" wire:model="developer_list.{{ $index }}.company_logo" wire:change="removeLogo({{$index}})" accept=".webp" class="hidden" />
                                            @error("developer_list.$index.company_logo") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </label>
                                    </div>

                                    {{-- Tools --}}
                                    <div class="mb-3">
                                        <input type="text" wire:model.defer="developer_list.{{ $index }}.tools" maxlength="50"
                                            class="p-2 w-full rounded-md border border-black shadow-sm"
                                            placeholder="Tech Tools" />
                                        @error("developer_list.$index.tools") <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Info --}}
                                    <div>
                                        <textarea wire:model.defer="developer_list.{{ $index }}.info" maxlength="300" rows="3"
                                            class="p-2 w-full rounded-md border border-black shadow-sm"
                                            placeholder="Short Description (Max 300 characters)"></textarea>
                                        @error("developer_list.$index.info") <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        {{-- Add Developer --}}
                        <div class="text-left mt-4">
                            <button type="button" wire:click="addDeveloper"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                + Add Developer
                            </button>
                        </div>
                    </fieldset>



                    <!-- Save Button -->
                    <div class="absolute -top-10 px-2 end-0 flex justify-center">
                        <button type="submit" wire:loading.attr="disabled" class="px-6 cursor-pointer py-3 bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                            <span wire:loading wire:target="save">saving...</span>
                            <span wire:loading.remove wire:target="save">Save</span>
                        </button>
                    </div>
                </form>
            </fieldset>
        </div>
    @else
        <div class="relative grid text-center gap-4 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden mx-auto">
            <div class="w-full max-w-5xl mx-auto">
                <flux:heading class="text-center">
                    <h2 class="text-2xl xl:text-[45px] font-extrabold text-gray-900 ">{{$developer_title}}</h2>
                </flux:heading>
                <flux:subheading class="text-center">
                    <p class="mt-2 text-black xl:text-xl md:text-sm ">{{$developer_subtitle}}</p>
                </flux:subheading>
            </div>
            @php
                $profiles = $developer_list;
            @endphp
            <!-- Carousel -->
            <x-auto-slider :cardmd="2" :cardlg="4" :cardxl="4" :card2xl="5" :autoSlide="true" :interval="8000">
                @foreach($profiles as $profile)
                    <x-bacancypage.profile-card :profile="$profile"/>
                @endforeach
            </x-auto-slider>
            <!-- Carousel Controls -->
        </div>
    @endif
</div>
