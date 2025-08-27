<div class="py-12 bg-black text-white" section="our-office-location">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @if(Route::currentRouteName() === 'create_lp_content' || Route::currentRouteName() === 'livewire.update' && auth()->check())
        <div class="py-4">
            <fieldset class="container relative max-w-6xl p-4 rounded mx-auto border-2 border-bacancy-primary">
                <x-messagestatus :successMessage="$successMessage" :errorMessage="$errorMessage"></x-messagestatus>
                <legend class="text-xl font-bold text-gray-900  markque px-2 text-white">Our Office Locations section</legend>
                <p class="text-gray-600 dark:text-gray-400 text-white">update Our Office Locations display!</p>
                    <div>
                        <form wire:submit.prevent="save" class="mt-2 p-1 flex-1 overflow-hidden max-w-7xl mx-auto ">
                        <div class="md:flex mb-3">
                            <input wire:model="title" type="text"
                                    class="bg-white md:text-md xl:text-xl sm:text-sm text-xs text-black border p-2  border-bacancy-primary rounded-md w-full"
                                    placeholder="Title" />
                        </div>
                        <div class="grid md:grid-cols-2 lg:grid-cols-4 lg:divide-x-2 divide-y-2 md:divide-y-0 divide-[#5b5b5b] px-4">
                        @php
                            $locations = [
                                1=>['name' => 'Australia', 'image' => 'assets/location/AUSTRALIA.webp', 'address' => 'Level 15, 333 Collins St, Melbourne 3000, Victoria, Australia'],
                                2=>['name' => 'USA', 'image' => 'assets/location/USA.webp', 'address' => '109 Mojonera Court, Los Gatos, CA, USA 95032'],
                                3=>['name' => 'UK', 'image' => 'assets/location/UK.webp', 'address' => '4TH Floor, Rex House, 4-12 Regent Street, London SW1Y 4PE(UK)'],
                                4=>['name' => 'India', 'image' => 'assets/location/INDIA.webp', 'address' => 'B27, Sector 132, Noida, Uttar Pardesh 201301.'],
                            ];

                             // Sort by order values
                            $orderedLocations = collect($orders)
                                ->filter(fn($order) => !empty($order))
                                ->sort()
                                ->mapWithKeys(fn($order, $key) => [$key => $locations[$key]])
                                ->all();
                        @endphp
                        @foreach($orderedLocations as $key=>$location)
                            <div class="flex flex-col px-4 py-6" aria-labelledby="autralia-office">
                                <div class="flex gap-2 mb-4 items-center">
                                    <input type="text"  wire:model.defer="orders.{{$key}}"
                                    class="bg-white w-8 text-center text-xs text-black border p-1  border-bacancy-primary rounded-md"
                                    />
                                    <img loading="lazy" src="{{ asset($location['image']) }}" alt="Australia Office" class="aspect-[2/1] w-12 object-cover">
                                    <h2 class="font-bold">{{$location['name']}}</h2>
                                </div>
                                <p class="text-sm">{{$location['address']}}</p>
                            </div>
                        @endforeach
                    </div>
                        <!-- Save Button -->
                        <div class="absolute -top-10 px-2 end-0 flex justify-center">
                            <button type="submit" wire:loading.attr="disabled" class="px-6 cursor-pointer py-3 bg-bacancy-primary text-white rounded-full hover:bg-blue-600 transition">
                                <span wire:loading wire:target="save">saving...</span>
                                <span wire:loading.remove wire:target="save">Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    @else
    <div class="mx-auto space-y-10 sm:px-6 lg:px-8">
        <h2 class="font-bold md:text-5xl mb-10 sm:text-2xl text-xl text-center uppercase outlined-text">{{$title}}</h2>

        @php
            $locations = [
                1 => [
                    'name' => 'Australia',
                    'image' => 'assets/location/AUSTRALIA.webp',
                    'address' => 'Level 15, 333 Collins St, Melbourne 3000, Victoria, Australia'
                ],
                2 => [
                    'name' => 'USA',
                    'image' => 'assets/location/USA.webp',
                    'address' => '109 Mojonera Court, Los Gatos, CA, USA 95032'
                ],
                3 => [
                    'name' => 'UK',
                    'image' => 'assets/location/UK.webp',
                    'address' => '4TH Floor, Rex House, 4-12 Regent Street, London SW1Y 4PE(UK)'
                ],
                4 => [
                    'name' => 'India',
                    'image' => 'assets/location/INDIA.webp',
                    'address' => 'B27, Sector 132, Noida, Uttar Pradesh 201301.'
                ],
            ];
            $orderedLocations = collect($orders)
                ->filter(fn($order) => !empty($order))
                ->sort()
                ->mapWithKeys(fn($order, $key) => [$key => $locations[$key]])
                ->all();
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-4 lg:divide-x-2 divide-y-2 md:divide-y-0 divide-[#5b5b5b] px-4">
            @foreach($orderedLocations as $order)
                <div class="flex flex-col px-4 py-6" aria-labelledby="{{ strtolower($order['name']) }}">
                    <div class="flex gap-2 mb-4 items-center">
                        <img loading="lazy" src="{{ asset($order['image']) }}"
                            alt="{{ $order['name'] }}" class="aspect-[2/1] w-12 object-cover">
                        <h2 class="xl:text-xl font-bold">{{ $order['name'] }}</h2>
                    </div>
                    <p class="text-sm">{{ $order['address'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
