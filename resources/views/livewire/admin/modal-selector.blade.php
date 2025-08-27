<div>
    <h2 class="text-2xl font-bold mb-4">Select Modal to Edit</h2>

    <flux:select 
        name="template"
        wire:model.live="selectedModal"
        required
        class="">
        @foreach($modalOptions as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
    </flux:select>
    
    <div class="mt-6">
        @if($selectedModal)
            {{-- Dynamically load selected modal Livewire component --}}
            <livewire:is :component="$selectedModal" :key="$selectedModal" />
        @endif
    </div>
</div>
