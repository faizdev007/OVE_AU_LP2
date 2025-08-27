<div class="py-12 bg-sv-secondary px-2">
    {{-- Success is as dangerous as failure. --}}
    <div class="max-w-5xl rounded-lg py-20 md:px-10 px-2 shadow-md mx-auto text-center text-white bg-sv-primary flex flex-col gap-10">
        <h2 class="text-xl md:text-4xl 2xl:text-5xl font-bold">Great Products Start With Great Teams.</h2>
        <p class="text-lg md:text-2xl 2xl:text-3xl">Hire your next developer today.</p>
        <flux:modal.trigger name="book-a-call">
            <x-silicon-valley.action-button class="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'Hire Now')" title="Talk to Us" class="hover:bg-sv-secondary/50 text-lg md:text-xl 2xl:text-3xl" />
        </flux:modal.trigger>
    </div>
</div>
