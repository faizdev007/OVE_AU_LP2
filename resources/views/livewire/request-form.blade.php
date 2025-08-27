@props(['rows' => '3'])
<div {{ $attributes->merge(['class' => 'p-6']) }}>
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
        <div class="my-4">
            <label for="name" class="block text-sm font-medium mb-1 hidden">Full Name</label>
            <input type="text" autocomplete="true" id="name" wire:model.defer="name" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white" placeholder="Full Name"/>
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        
        <div class="md:flex gap-4">
            <div class="my-4">
                <label for="email" class="block text-sm font-medium mb-1 hidden">Email</label>
                <input type="email" autocomplete="true" id="email" placeholder="Email" wire:model.defer="email" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"/>
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="my-4">
                <label for="phone" class="block text-sm font-medium mb-1 hidden">phone</label>
                <input type="phone" autocomplete="true" id="phone" placeholder="Phone" wire:model.defer="phone"
                inputmode="numeric" 
                pattern="\d*" 
                required
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                maxlength="14"
                class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"/>
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="my-4">
            <label for="project_brief" class="block text-sm font-medium mb-1 hidden">Project Brief</label>
            <textarea type="text" rows="{{$rows}}" id="project_brief" placeholder="Requirement" wire:model.defer="project_brief" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"></textarea>
            @error('projectBrief') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-center space-x-2">
            <x-submit-button 
                type="submit" 
                title="{{$buttonText ?? 'Book a 30 mins strategy call'}}" 
                target="submitquery"
                class="!text-black w-max !md:text-2xl !bg-white hover:!bg-gray-900 hover:!text-white focus:!ring-[#000000]"
            />
        </div>
    </form>
</div>
