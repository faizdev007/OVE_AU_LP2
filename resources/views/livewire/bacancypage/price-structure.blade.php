<div class="py-12">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="relative grid gap-4 px-4 py-2 sm:px-6 lg:px-8 overflow-hidden container mx-auto">
        <div class="w-full max-w-5xl mx-auto">
            <flux:heading class="text-center">
                <h2 class="text-2xl xl:text-[45px] font-extrabold text-gray-900 ">Choose the Right Pricing Plan for Your Custom Need</h2>
            </flux:heading>
            <flux:subheading class="text-center">
                <p class="mt-2 text-black xl:text-xl md:text-sm "><span class="underline">No hidden fees</span> — just simple, affordable pricing for teams of all sizes.</p>
            </flux:subheading>
        </div>
        <div class="grid grid-cols-5 text-black">
            <div class="border p-4 text-center flex h-full w-full items-center justify-center">
                <h5 class="text-2xl font-bold">Talent on Demand</h5>
            </div>
            <div class="border p-4 col-span-2 grid gap-4 text-center">
                <h4 class="text-xl font-bold text-center"> Dedicated Developers</h4>
                <p>Management Fee <strong class="text-2xl">$999/</strong>Month <strong class="text-2xl">( AUD )</strong> + Indian Salary of Developers</p>
                <div class="flex justify-center">
                    <flux:modal.trigger name="book-a-call">
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'book-a-call')" class="!text-white w-max flex gap-4 items-center cursor-pointer bg-bacancy-primary md:p-2 p-1 md:px-6 px-4 rounded hover:!bg-gray-800 focus:!ring-[#000000]">
                            Start Hiring Now
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </flux:modal.trigger>
                </div>
            </div>
            <div class="border p-4 col-span-2">
                <p>Includes: </p>
            </div>
        </div>
    </div>
</div>
