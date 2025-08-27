@props(['buttonText' => null])
<div>
    @if(Route::currentRouteName() === 'livewire.update' && auth()->check())
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
    <form wire:submit.prevent="savemodal" >
        <div class="md:flex md:p-0 py-4 items-start justify-between">
            <div class="flex-1 w-full aspect-[1/1] relative md:block hidden">
            <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/modalpic2.webp') }}" alt="book_a_30_mins_strategy_call" height="500px" width="500px" class="w-full h-full object-cover" />
            <div class="bg-black/50 absolute top-0 bottom-0 start-0 end-0 z-10"></div>
                <div class="absolute top-0 bottm-0 start-0 end-0 z-20 flex flex-col justify-around h-full gap-3 p-4 text-white">
                    <input type="text" class="md:text-2xl text-xl text-center" wire:model="title" placeholder="{{ $title }}"/>
                    <ul>
                        @foreach($lists as $key => $item)
                            <li class="flex gap-2 items-center">
                                <!-- Checkmark icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
    
                                <!-- Text input -->
                                <input 
                                    type="text" 
                                    class="w-full text-white" 
                                    wire:model="lists.{{ $key }}" 
                                    placeholder="Enter item..."
                                />
    
                                <!-- Remove Button -->
                                <button
                                    type="button" 
                                    wire:click="removeItem({{ $key }})"
                                    class="text-red-500 hover:text-red-700 font-bold"
                                >
                                    ✕
                                </button>
                            </li>
                        @endforeach
                    </ul>
    
                    <!-- Add Button -->
                    <button 
                        type="button"
                        wire:click="addItem"
                        class="bg-blue-500 text-white rounded px-3 py-1 mt-2 hover:bg-blue-600"
                    >
                        + Add Item
                    </button>
                    <div class="grid gap-2">
                        <input type="text" wire:model="stacktitle" placeholder="{{ $stacktitle }}"/>
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($stack as $key => $single)
                                <div class="rounded relative space-y-2">
                                    <input type="text" class="font-bold uppercase w-full" wire:model="stack.{{ $key }}.title" placeholder="Title"/>
                                    <input type="text" class="w-full" wire:model="stack.{{ $key }}.description" placeholder="Value"/>
    
                                    <button 
                                        type="button"
                                        wire:click="removeStack({{ $key }})"
                                        class="text-red-500 hover:text-red-700 font-bold absolute -top-3 end-0 px-1"
                                    >
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        </div>
    
                        <!-- Add New Item Button -->
                        <button 
                            type="button"
                            wire:click="addStack"
                            class="bg-blue-500 text-white rounded px-3 py-1 mt-3 hover:bg-blue-600"
                        >
                            + Add New Item
                        </button>
    
                    </div>
                    <label class="w-full flex justify-start">
                        <!-- Image Preview -->
                        @if ($image)
                            <img 
                                wire:loading.remove
                                wire:target="image"
                                src="{{ $image->temporaryUrl() }}" 
                                alt="Uploaded Preview" 
                                class="h-14 rounded"
                            />
                        @else
                            <img 
                                wire:loading.remove
                                wire:target="image"
                                loading="lazy" 
                                decoding="async" 
                                src="{{ asset($old_path) }}" 
                                alt="google rating" 
                                class="h-14"
                            />
                        @endif
                        <span wire:loading wire:target="image">Loading....</span>
    
                        <!-- File Input -->
                        <input 
                            type="file" 
                            wire:model="image"
                            accept="image/*"
                            class="border hidden rounded p-1"
                        />
    
                        <!-- Optional Validation Messages -->
                        @error('image') 
                            <span class="text-red-600 text-sm">{{ $message }}</span> 
                        @enderror
                    </label>
                </div>
            </div>
            <div class="flex-1 w-full my-4 text-center md:py-0">
                <flux:heading center>
                    <input type="text" class="text-xl md:text-3xl font-bold w-full text-white text-center px-6" wire:model="formtitle" placeholder="{{ $formtitle }}"/>
                </flux:heading>
                <input type="text" class="md:text-xl text-md text-center py-2 w-full  text-white" wire:model="formsubtitle" placeholder="{{ $formsubtitle }}"/>
                <!-- Save Button -->
            </div>
        </div>
        <div class="flex justify-center">
            <button class="p-2 w-full my-2 cursor-pointer bg-bacancy-primary text-white rounded hover:bg-blue-600 transition">
                <span wire:loading wire:target="savemodal">saving...</span>
                <span wire:loading.remove wire:target="savemodal">Save</span>
            </button>
        </div>
    </form>
    @else
    <div class="md:flex md:p-0 py-4 items-center justify-between">
        <div class="flex-1 w-full aspect-[1/1] relative md:block hidden">
            <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/modalpic2.webp') }}" alt="book_a_30_mins_strategy_call" height="500px" width="500px" class="w-full h-full object-cover" />
            <div class="bg-black/50 absolute top-0 bottom-0 start-0 end-0 z-10"></div>
            <div class="absolute top-0 bottm-0 start-0 end-0 z-20 flex flex-col justify-around h-full gap-3 p-4 text-white">
                <h2 class="md:text-2xl text-xl text-center">{{ $title }}</h2>
                <ul>
                    @foreach($lists as $key => $item)
                    <li class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        {{$item}}
                    </li>
                    @endforeach
                </ul>
                <div class="grid gap-2">
                    <h4>{{ $stacktitle }}</h4>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($stack as $key => $single)
                        <div class="">
                            <h3 class="font-bold uppercase">{{$single['title']}}</h3>
                            <p>{{$single['description']}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex justify-start">
                    <img loading="lazy" decoding="async" src="{{asset($old_path)}}" alt="google rating" class="h-14"/>
                </div>
            </div>
        </div>
        <div class="flex-1 w-full md:py-0">
            <flux:heading center>
                <h2 class="text-xl md:text-3xl font-bold  text-white text-center px-6">{{$formtitle}}</h2>
            </flux:heading>
            <h2 class="md:text-xl text-md text-center py-2  text-white">{{$formsubtitle}}</h2>
            <livewire:request-form :buttonText="$buttonText" inputClass="text-white"/>
        </div>
    </div>
    @endif
</div>
