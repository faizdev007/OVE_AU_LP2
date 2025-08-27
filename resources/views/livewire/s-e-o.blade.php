<div>
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900 markque px-2">SEO Section</legend>
                <p class="text-gray-600 ">Customize SEO section.</p>
                <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                    <label class="text-black" for="metaTitle">Meta Title</label>
                    <textarea id="metaTitle" wire:model="metaTitle" type="text"        
                            class="bg-white md:text-md xl:text-xl mb-4 sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                            placeholder="{{$metaTitle}}" rows="1"></textarea>
                    <label class="text-black" for="metaDescription">Meta Description</label>
                    <textarea id="metaDescription" wire:model="metaDescription" type="text"        
                        class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                        placeholder="{{$metaDescription}}" ></textarea>
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
    @endif
</div>
