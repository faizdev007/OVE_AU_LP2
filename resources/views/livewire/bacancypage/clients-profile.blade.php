<div class="my-12 scroll-mt-20" id="725" section="clients-profile">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">Client Success Stories That Go Beyond Testimonials</legend>
                <p class="text-gray-600 dark:text-gray-400">Explore how we helped businesses scale, pivot, and win in competitive markets</p>
                <form wire:submit.prevent="save" class="mt-2 flex-1 overflow-hidden max-w-7xl mx-auto ">
                    <div class="md:flex mb-3">
                        <input wire:model="title" type="text"
                                class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                placeholder="Title" />
                    </div>
                    <textarea wire:model="subtitle" rows="2" type="text"
                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                        placeholder="SubTitle" ></textarea>
    
                    <fieldset class="mb-4 border-2 border-black p-4">
                        <legend class="text-gray-600 dark:text-gray-400 font-bold">Clients Information Area</legend>
                        <div class="grid md:grid-cols-3 sm:grid-cols-2 mb-4 gap-2">
                            @foreach ($clients as $index => $client)
                                <div class="grid md:grid-cols-3">
                                    <div class="">
                                        <label class="block h-full flex items-center justify-center border shadow font-semibold">
                                            @php 
                                                if ($client['poster'] && is_object($client['poster'])) {
                                                    $url = $client['poster']->temporaryUrl();
                                                } else {
                                                    $url = asset($client['poster']);
                                                }
                                            @endphp
                                            @if ($client['poster'])
                                                <img wire:loading.remove wire:target="clients.{{ $index }}.poster" src="{{ $url }}" class="rounded border" />
                                            @else
                                                <div wire:loading.remove wire:target="clients.{{ $index }}.poster" class="w-full h-full flex items-center text-black justify-center flex-col bg-gray-100 text-center text-xs rounded">
                                                    <p>Poster Image</p>
                                                    <span>(webp, max 2MB)</span>
                                                </div>
                                            @endif
                                            <span wire:loading class="text-black" wire:target="clients.{{ $index }}.poster"> Loading...</span>
                                            <input type="file" wire:model="clients.{{ $index }}.poster" wire:change="changeClient({{ $index }})" accept=".webp,.jpg,.jpeg,.png" class="w-full hidden mb-1 border p-2 rounded" />
                                        </label>
                                        @error("clients.$index.poster") <span class="text-red-500">{{ $message }}</span> @enderror  
                                    </div>
                                    <div class="border p-4 col-span-2 rounded flex flex-col text-black justify-between shadow relative">
                                        <div class="text-right">
                                            @if (count($clients) > 1)
                                                <button type="button" wire:click="removeClient({{ $index }})" class="absolute top-0 end-0 bg-red-500 text-white h-8 w-8 rounded-b-none rounded-s-none rounded hover:bg-red-600">X</button>
                                            @endif
                                        </div>
        
                                        <div>
                                            <label class="hidden font-semibold">Name</label>
                                            <input type="text" wire:model.lazy="clients.{{ $index }}.name" placeholder="Name" class="w-full mb-2 mt-5 border p-2 rounded" />
                                            @error("clients.$index.name") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
        
                                        <div>
                                            <label class="hidden font-semibold">Title</label>
                                            <input type="text" wire:model.lazy="clients.{{ $index }}.title" placeholder="Title" class="w-full mb-2 border p-2 rounded" />
                                            @error("clients.$index.title") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
        
                                        <div>
                                            <label class="hidden font-semibold">Video URL</label>
                                            <input type="text" wire:model.lazy="clients.{{ $index }}.video" placeholder="Video URL" class="w-full mb-2 border p-2 rounded" />
                                            @error("clients.$index.video") <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
        
                                        <div class="hidden">
                                            <label class="block font-semibold">Poster Image</label>
                                            <input type="file" wire:model="clients.{{ $index }}.poster" accept=".webp,.jpg,.jpeg,.png" class="w-full mb-2 border p-2 rounded" />
                                            <span>only (webp, max 2MB)</span>
                                            @error("clients.$index.poster") <span class="text-red-500">{{ $message }}</span> @enderror  
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" wire:click="addClient" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            + Add More Client
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
            </fieldset>
        </div>
    @else
    <div class="relative grid gap-4 px-4 py-2 sm:px-6 lg:px-8 mx-auto ">
        <div class="w-full mx-auto 2xl:text-2xl">
            <flux:heading class="text-center">
                <h2 class="text-2xl xl:text-[45px] text-black font-extrabold">{{$title}}</h2>
            </flux:heading>
            <flux:subheading class="text-center">
                <p class="mt-2 text-black xl:text-xl md:text-sm mb-6">{{$subtitle}}</p>
            </flux:subheading>
        </div>
        <x-bacancypage.client-card :clients="$clients"/>
    </div>
    @endif
</div>

