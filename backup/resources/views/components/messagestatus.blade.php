@props(['successMessage' => '','errorMessage'=>''])
@if($successMessage)
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => {show = false; $wire.set('successMessage','');}, 3000)" 
        x-show="show"
        class="bg-green-100 text-green-800 px-3 py-2 rounded mb-3"
    >
        {{ $successMessage }}
    </div>
@endif

@if($errorMessage)
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => {show = false; $wire.set('errorMessage','');}, 3000)" 
        x-show="show"
        class="bg-red-100 text-red-800 px-3 py-2 rounded mb-3"
    >
        {{ $errorMessage }}
    </div>
@endif