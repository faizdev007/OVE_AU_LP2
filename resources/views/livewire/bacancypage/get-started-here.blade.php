{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<div class="" section="GSH">
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900 markque px-2">Get Started Here</legend>
                <p class="text-gray-600 ">Customize the GSH section of your Bacancy landing page.</p>
                <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl mx-auto ">
                    <div class="md:flex mb-3">
                        <input wire:model="gsh_title" type="text"
                                class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Title" />
                    </div>
                    <textarea wire:model="gsh_subtitle" rows="2" type="text"
                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                        placeholder="SubTitle" ></textarea>


                    <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                        <input wire:model="btntext" type="text"
                                class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Button Text" />
                    </div>
    
                    <fieldset class="mb-4 border-2 border-black p-4">
                        <legend class="text-gray-600  font-bold">Mail Information Area</legend>
                        <input wire:model="gsh_email" type="text"
                                class="bg-white md:text-md mb-3 xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Email Id" />
                        <input wire:model="gsh_watchword" type="text"
                                    class="bg-white md:text-md mb-3 xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="watchword" />
                        <textarea wire:model="gsh_short_note" rows="2" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                            placeholder="Short Note" ></textarea>
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
    <div class="py-12 bg-bacancy-primary">
        <div class="relative flex-1 gap-4 overflow-hidden px-4 sm:px-6 lg:px-8 mx-auto ">
            <div class="w-full mx-auto">
                <flux:heading class="text-center">
                    <h2 class="text-2xl xl:text-[45px] font-extrabold text-white">{{$gsh_title}}</h2>
                </flux:heading>
                <flux:subheading class="text-center">
                    <p class="mt-2 text-black xl:text-xl md:text-sm text-white mb-6">{{$gsh_subtitle}}</p>
                </flux:subheading>
            </div>
            <div class="w-full mx-auto">
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
                <form wire:submit.prevent="querysubmit" class="text-center text-black">
                    @csrf
                    <div class="grid w-full md:grid-cols-3 gap-4 mb-4 2xl:text-2xl">
                        <input type="name" wire:model.defer="name" id="name" autocomplete="true" placeholder="Enter your name" required class="bg-white p-4 rounded-md font-bold flex-1 w-full" />
                        @error("name")<span class="text-red-500">{{ $message }}</span> @enderror
                        <input type="email" wire:model.defer="email" id="email" autocomplete="true" placeholder="Enter your email" required class="bg-white p-4 rounded-md font-bold flex-1 w-full" />
                        @error("email")<span class="text-red-500">{{ $message }}</span> @enderror
                        <input type="tel" wire:model.defer="phone" id="phone" autocomplete="true" placeholder="Enter your phone number"
                        inputmode="numeric" 
                        pattern="\d*" 
                        required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                        maxlength="14"
                        autocomplete="true"
                        class="bg-white p-4 rounded-md font-bold flex-1 w-full" />
                        @error("phone")<span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <textarea wire:model.defer="project_brief" id="project_brief" placeholder="Enter your message" rows="4" autocomplete="true" required class="mb-4 2xl:text-2xl bg-white p-4 rounded-md font-bold w-full"></textarea>
                    @error("project_brief")<span class="text-red-500">{{ $message }}</span> @enderror
                    <div class="relative flex items-center justify-center">
                        <x-submit-button 
                            type="submit" 
                            title="{{$btntext}}" 
                            target="querysubmit"
                            class="w-max !md:text-2xl 2xl:text-[1.5rem] !bg-black hover:!bg-gray-900 hover:!text-white focus:!ring-[#000000]"
                        />
                    </div>
                </form>
            </div>
        </div>
        <div class="h-40 hidden"></div>
    </div>
    <div class="relative hidden md:h-48 h-32 flex justify-center items-center">
        <div class="absolute bottom-4 md:border rounded boder-black shadow flex flex-col md:gap-8 gap-3 w-full md:max-w-5xl 2xl:max-w-7xl mx-auto bg-white !text-black text-center md:p-10 p-4 shadow-lg md:mt-8">
            <div class="grid gap-2">
                <flux:heading class="text-center">
                    <h2 class="md:text-2xl sm:text-lg text-black xl:text-[45px] font-bold"><a href="mailto:{{$gsh_email}}" target="_top">{{$gsh_email}}</a></h2>
                </flux:heading>
                <flux:subheading class="text-center">
                    <p class="mt-2 text-black xl:text-xl text-sm mb-6">{{$gsh_watchword}}</p>
                </flux:subheading>
            </div>
            <p class="text-center lg:text-lg text-xs xl:text-xl md:text-sm  mb-6">{{$gsh_short_note}}</p>
        </div>
    </div>
    @endif
</div>
