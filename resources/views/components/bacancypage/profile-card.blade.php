@props([
    'profile' => 'array',
])

<div class="w-[100%] h-full flex-col">
    <div class="relative mt-20 bg-bacancy-primary rounded h-full overflow-visible z-10">
        <div class="mb-4 z-30 absolute top-0 start-0 end-0 insite-0 h-10 flex items-center justify-center">
            <div class="bg-white w-48 h-48 rounded-full overflow-visible">
                <img loading="lazy" class="w-full top-0 rounded-full mb-4 aspect-[1/1] object-cover bg-bacancy-lightblue p-1" src="{{ asset($profile['avtar']) }}" alt="{{$profile['name']}}" />
            </div>
        </div>
        <div class="p-6 h-100 pt-32 flex flex-col items-center justify-center">
            <flux:heading>
                <h1 class="text-xl font-bold text-white">{{$profile['name']}}</h1>
            </flux:heading>
            <p class="text-white text-xs mb-2">{{$profile['profile']}}</p>
            <p class="text-white mb-1">PREVIOUSLY AT</p>
            <img loading="eager" fetchpriority="high" decoding="async" class="aspect-[2/1] object-container h-16 mb-2" src="{{ asset($profile['company_logo']) }}" alt="{{$profile['profile']}}"/>
            <div class="flex flex-wrap justify-center items-center gap-2">
                @php
                    $lists = explode(',',$profile['tools']);
                @endphp
                @foreach($lists as $item)
                    <span type="button" class="w-max px-4 rounded-full shadow !text-white !bg-black hover:!bg-gray-900 focus:!ring-gray-300">{{$item}}</span>
                @endforeach
            </div>
            <p class="text-white mt-4 text-center text-xs line-clamp-2 leading-6" title="{{$profile['info'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'}}">
                {{$profile['info'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'}}
            </p>
        </div>
    </div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    <div class="bg-bacancy-primary hidden relative rounded-lg shadow-xl flex flex-col items-center justify-center mt-32">
        <div class="mb-4 relative insite-0 h-10 flex items-center justify-center">
            <div class="bg-white w-48 h-48 rounded-full overflow-hidden">
                <img loading="lazy" class="w-full top-0 rounded-full mb-4 aspect-[1/1] object-cover bg-bacancy-lightblue p-1" src="{{ asset($profile['avtar']) }}" alt="{{$profile['name']}}" />
            </div>
        </div>
        <div class="p-6 mt-10 flex flex-col items-center justify-center">
            <flux:heading>
                <h1 class="text-xl font-bold text-white">{{$profile['name']}}</h1>
            </flux:heading>
            <p class="text-white text-xs mb-2">{{$profile['profile']}}</p>
            <p class="text-white mb-1">PREVIOUSLY</p>
            <img loading="eager" fetchpriority="high" decoding="async" class="aspect-[2/1] object-container h-16 mb-2" src="{{ asset($profile['company_logo']) }}" alt="{{$profile['profile']}}"/>
            <div class="flex flex-wrap justify-center items-center gap-2">
                @php
                    $lists = explode(',',$profile['tools']);
                @endphp
                @foreach($lists as $item)
                    <span type="button" class="w-max px-4 rounded-full shadow !text-white !bg-black hover:!bg-gray-900 focus:!ring-gray-300">{{$item}}</span>
                @endforeach
            </div>
            <p class="text-white mt-4 text-center text-xs line-clamp-2" title="{{$profile['info'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'}}">
                {{$profile['info'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'}}
            </p>
        </div>
    </div>
</div>