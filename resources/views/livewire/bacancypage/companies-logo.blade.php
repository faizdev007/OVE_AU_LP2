<div class="my-12 scroll-mt-20" section="companies-logo">
    {{-- Because she competes with no one, no one can compete with her. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">Companies Logo</legend>
                <p class="text-gray-600">Upload and Remove Companies Logo for Current Landing Page.</p>
                
                <div x-data="{
                        previews: @entangle('existing_logos'),
                        removed: @entangle('removed_logos')
                    }">
                    <form wire:submit.prevent="save" class="space-y-4">
                        <!-- Upload New Logos -->
                        <input type="file" wire:model="company_logos" multiple accept=".webp" class="block mb-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 cursor-pointer transition" />
                        <div class="mt-2 text-sm text-gray-500">
                            Only <strong>.webp</strong> files are allowed. You can select multiple.
                        </div>
                        <!-- Preview Uploaded Logos -->
                        <div class="flex flex-wrap gap-3">
                            <template x-for="(logo, index) in previews" :key="logo">
                                <div class="relative w-24 border rounded">
                                    <img :src="'{{ url('') }}' + logo" alt="" class="w-full h-full object-cover rounded">
                                    <button type="button"
                                        @click="console.log(previews); removed.push(logo); previews.splice(index, 1)"
                                        class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded">
                                        ✕
                                    </button>
                                </div>
                            </template>
                        </div>
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
    @php
        $companyLogos = $existing_logos;
    @endphp
    <div class="relative flex-1 gap-4 overflow-hidden px-4 sm:px-6 lg:px-8 mx-auto ">
        <div class="logo-slider flex w-max md:space-x-8 space-x-4">
            @foreach ($companyLogos as $index => $logo)
                <img src="{{ asset($logo) }}" class="h-16 p-2 border border-black shadow w-auto border rounded" alt="Logo {{ $index + 1 }}">
            @endforeach
            @foreach ($companyLogos as $index => $logo)
                <img src="{{ asset($logo) }}" class="h-16 p-2 border border-black shadow w-auto border rounded" alt="Logo {{ $index + 1 }}">
            @endforeach
            @foreach ($companyLogos as $index => $logo)
                <img src="{{ asset($logo) }}" class="h-16 p-2 border border-black shadow w-auto border rounded" alt="Logo {{ $index + 1 }}">
            @endforeach
            @foreach ($companyLogos as $index => $logo)
                <img src="{{ asset($logo) }}" class="h-16 p-2 border border-black shadow w-auto border rounded" alt="Logo {{ $index + 1 }}">
            @endforeach
        </div>
    </div>
    @endif
</div>
