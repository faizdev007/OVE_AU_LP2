<div class="my-12 py-12 scroll-mt-20" id="726" section="faq">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2">FAQ section</legend>
                <p class="text-gray-600 dark:text-gray-400">You can add and remove FAQ which you want to display!</p>
                    <div>
                        <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                        <div class="md:flex mb-3">
                            <input wire:model="title" type="text"
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Title" />
                        </div>
                        <textarea wire:model="subtitle" rows="2" type="text"
                            class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2 border-bacancy-primary rounded-md w-full"
                            placeholder="SubTitle" ></textarea>
                        <div class="md:flex mb-3 p-2 bg-bacancy-primary rounded-full w-max px-8">
                            <input wire:model="btntitle" type="text"
                                    class="bg-white md:text-md w-max bg-white xl:text-xl sm:text-sm text-xs text-black border p-0 px-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Button Text" />
                        </div>
                        <fieldset class="mb-4 border-2 border-black p-4">
                            <legend class="text-gray-600 dark:text-gray-400 font-bold">FAQ Information Area</legend>
                            <div class="grid md:grid-cols-3 gap-4">
                                @foreach ($faqs as $index => $faq)
                                    <div>
                                        <div class="border p-4 col-span-2 rounded flex flex-col text-black justify-between shadow relative">

                                            {{-- Remove Button --}}
                                            <div class="text-right">
                                                @if (count($faqs) > 1)
                                                    <button type="button" wire:click="removefaq({{ $index }})"
                                                        class="absolute top-0 end-0 bg-red-500 text-white h-8 w-8 rounded hover:bg-red-600">
                                                        X
                                                    </button>
                                                @endif
                                            </div>

                                            <div class="mt-5">
                                                <input type="text" wire:model.defer="faqs.{{ $index }}.question"
                                                    placeholder="Question" class="w-full mb-2 border p-2 rounded" />
                                                @error("faqs.$index.question") <span class="text-red-500">{{ $message }}</span> @enderror

                                                <textarea wire:model.defer="faqs.{{ $index }}.answer" rows="2"
                                                    placeholder="Answer" class="w-full mb-2 border p-2 rounded"></textarea>
                                                @error("faqs.$index.answer") <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Add New FAQ Button --}}
                            <button type="button" wire:click="addfaq"
                                class="mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                + Add More FAQ
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
    <div class="relative md:flex grid gap-4 px-4 py-2 sm:px-6 lg:px-8 mx-auto ">
        <div class="xl:w-[500px] md:text-start md:block flex flex-col items-center md:w-[250px]">
            <flux:heading class="">
                <h2 class="md:text-2xl text-xl text-black xl:text-[45px] font-extrabold">{{$title}}</h2>
            </flux:heading>
            <div class="md:block hidden">
                <flux:subheading class="">
                    <p class="mt-2 text-black xl:text-xl 2xl:text-2xl md:text-sm mb-6 text-nowrap">{{$subtitle}}</p>
                </flux:subheading>
                <flux:modal.trigger name="book-a-call">
                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" class="!text-white cursor-pointer w-max flex gap-4 2xl:text-[1.5rem] items-center bg-bacancy-primary md:p-2 p-1 md:px-6 px-4 rounded hover:!bg-gray-800 focus:!ring-[#000000]">
                        {{ $btntitle }}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </flux:modal.trigger>
            </div>
        </div>
        <div class="flex-1 w-full grid gap-4 mx-auto">
            <div class="w-full mx-auto space-y-4">
                <div x-data="{ faqs: @js($faqs) }" class="space-y-4">
                    <template x-for="(faq, index) in faqs" :key="index">
                        <div x-data="{ open: false }" class="border border-black rounded-lg w-full shadow-sm">
                            <button 
                                @click="open = !open" 
                                class="flex items-center justify-between w-full px-4 py-2 text-left text-gray-800 font-medium"
                            >
                                <span class="2xl:text-2xl" x-text="faq.question"></span>
                                <svg 
                                    :class="{ 'rotate-180': open }" 
                                    class="w-5 h-5 transition-transform transform duration-200" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24" 
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div 
                                x-show="open" 
                                x-transition 
                                class="px-4 pb-4 text-sm text-gray-800 border-t 2xl:text-[1.5rem] border-gray-300 bg-white rounded-b-lg py-2"
                                x-cloak
                            >
                                <span x-text="faq.answer"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="md:hidden block flex flex-col items-center">
                <flux:subheading class="">
                    <p class="mt-2 text-black xl:text-xl md:text-sm mb-6 text-nowrap">{{$subtitle}}</p>
                </flux:subheading>
                <flux:modal.trigger name="book-a-call">
                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" class="!text-white  cursor-pointer w-max flex gap-4 items-center bg-bacancy-primary md:p-2 p-1 md:px-6 px-4 rounded hover:!bg-gray-800 focus:!ring-[#000000]">
                        {{ $btntitle }}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </flux:modal.trigger>
            </div>
        </div>
    </div>
    @endif
</div>
