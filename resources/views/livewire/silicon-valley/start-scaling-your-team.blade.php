<div class="py-12 bg-sv-gradient-topbottom" section="scaling-team">
    {{-- Stop trying to control. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2 text-white">Start Scaling Your Team section</legend>
                <p class="text-gray-600 dark:text-gray-400 text-white">update content of Start Scaling your team display!</p>
                    <div>
                        <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                        <div class="md:flex mb-3">
                            <input wire:model="title" type="text"
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Title" />
                        </div>
                        <textarea wire:model="subtitle" rows="1" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                            placeholder="SubTitle" ></textarea>
                        <div class="md:flex mb-3">
                            <input wire:model="formtitle" type="text"
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Form Title" />
                        </div>
                        <textarea wire:model="formsubtitle" rows="1" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                            placeholder="Form SubTitle" ></textarea>
                        <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                            <input wire:model="formbtntext" type="text"
                                    class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Button Text" />
                        </div>
                        <fieldset class="mb-4 border-2 border-white p-4">
                            <legend class="font-bold text-white">Points Show</legend>
                            <div class="grid md:grid-cols-3 gap-4">
                                @foreach ($points as $index => $point)
                                    <div>
                                        <div class="border bg-white p-4 col-span-2 rounded flex flex-col text-black justify-between shadow relative">

                                            {{-- Remove Button --}}
                                            <div class="text-right">
                                                @if (count($points) > 1)
                                                    <button type="button" wire:click="removepoint({{ $index }})"
                                                        class="absolute top-0 end-0 bg-red-500 text-white h-8 w-8 rounded hover:bg-red-600">
                                                        X
                                                    </button>
                                                @endif
                                            </div>

                                            <div class="mt-5">
                                                <input type="text" wire:model.defer="points.{{ $index }}.title"
                                                    placeholder="Point Title" class="w-full mb-2 border p-2 rounded" />
                                                @error("points.$index.title") <span class="text-red-500">{{ $message }}</span> @enderror

                                                <textarea wire:model.defer="points.{{ $index }}.subtitle" rows="2"
                                                    placeholder="Point Subtitle" class="w-full mb-2 border p-2 rounded"></textarea>
                                                @error("points.$index.subtitle") <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Add New Point Button --}}
                            <button type="button" wire:click="addpoint"
                                class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                + Add Point
                            </button>
                        </fieldset>
                        <!-- Save Button -->
                        <div class="absolute -top-10 px-2 end-0 flex justify-center">
                            <button type="submit" wire:loading.attr="disabled" class="px-6 py-3 cursor-pointer bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                                <span wire:loading wire:target="save">saving...</span>
                                <span wire:loading.remove wire:target="save">Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    @else
    <div class="relative md:flex grid gap-4 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden mx-auto ">
        <div class="flex-1 gap-8 my-5 flex w-full flex-col mx-auto text-white">
            <div class="gap-4 flex flex-col">
                <h2 class="md:text-3xl text-2xl font-bold">{{$title}}</h2>
                <p>{{$subtitle}}</p>
            </div>
            <div class="flex flex-row gap-3">
                <div class="flex flex-col">
                    <div class="pt-1 flex gap-2">
                        <span class="h-10 w-10 mt-2 md:mt-1 rounded-full flex justify-center items-center bg-white text-black font-bold text-2xl">1</span>
                        <div class="flex-1">
                            <h3 class="md:text-2xl text-xl font-bold">Submit Your Details</h3>
                            <p class="md:text-sm text-xs">Your privacy is our priority, and your information is safe with us.</p>
                        </div>
                    </div>
                    <!-- Line Between -->
                    <div class="md:h-16 h-10 w-1 bg-white mx-[18px]"></div>
                    
                    <div class="flex gap-2">
                        <span class="h-10 w-10 mt-2 rounded-full flex justify-center items-center bg-white text-black font-bold text-2xl">2</span>
                        <div class="flex-1">
                            <h3 class="md:text-2xl text-xl font-bold">What Happens Next?</h3>
                            <p class="md:text-sm text-xs">A Growth Manager will reach out to you shortly.</p>
                            <div class="flex flex-row gap-2">
                                <img loading="lazy" src="{{ asset('assets/gm1.webp') }}" alt="Call" class="h-12 mt-2">
                                <img loading="lazy" src="{{ asset('assets/gm2.webp') }}" alt="Call" class="h-12 mt-2">
                                <img loading="lazy" src="{{ asset('assets/gm3.webp') }}" alt="Call" class="h-12 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 w-full text-white text-center">
            <h2 class="text-3xl mb-4 xl:text-[45px] font-extrabold">{{$formtitle}}</h2>
            <h3 class="text-lg mb-4 xl:text-[20px]">{{$formsubtitle}}</h3>
            <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
            @if (session()->has('success'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3 transition-opacity duration-500"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    class="bg-red-100 text-red-800 px-3 py-2 rounded mb-3 transition-opacity duration-500"
                >
                    {{ session('error') }}
                </div>
            @endif
            <form wire:submit.prevent="submitquery">
                <input type="text" wire:model.defer="name" id="name" placeholder="Name"
                    class="p-4 border boreder-white font-bold flex-1 w-full mb-4 focus:ring-0 focus:border-bacancy-primary" autocomplete="true" required />
                @error("name") <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="flex gap-4 mb-4">
                    <input type="email" wire:model.defer="email" id="email" placeholder="Email"
                        class="p-4 border boreder-white font-bold flex-1 w-full mb-4 focus:ring-0 focus:border-bacancy-primary" autocomplete="true" required />    
                    @error("email") <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="tel" wire:model.defer="phone" id="phone" placeholder="Phone"   
                        inputmode="numeric" 
                        pattern="\d*" 
                        required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                        maxlength="14" 
                        autocomplete="true"
                        class="p-4 border boreder-white font-bold flex-1 w-full mb-4 focus:ring-0 focus:border-bacancy-primary" required />
                    @error("phone") <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <textarea wire:model.defer="project_brief" id="project_brief" placeholder="Requirement" rows="3"
                    class="p-4 border boreder-white font-bold flex-1 w-full mb-4 focus:ring-0 focus:border-bacancy-primary" autocomplete="true" required></textarea>
                @error("project_brief") <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="relative flex items-center justify-center">
                    <x-submit-button 
                        type="submit" 
                        title="{{$formbtntext}}" 
                        target="submitquery"
                        class="!text-black w-max !md:text-2xl !bg-white hover:!bg-gray-900 hover:!text-white focus:!ring-[#000000]"
                    />
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
