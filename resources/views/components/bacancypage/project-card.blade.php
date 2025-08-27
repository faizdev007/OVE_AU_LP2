@props([
    'project' => 'array',
])

<div class="relative">
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div class="grid lg:grid-cols-4 grid-cols-1 lg:gap-1 gap-y-1 lg:gap-y-0 items-center justify-center w-full">
        <div class="bg-white text-black border border-black p-4 h-full text-start flex flex-col gap-6 rounded">
            <span class="md:text-md text-xs 2xl:text-xl border rounded-full bg-bacancy-primary w-max text-white p-3">{{$project['label_tag']}}</span>
            <div class="flex flex-col gap-2">
                <h3 class="md:text-2xl 2xl:text-3xl font-bold">{{$project['project_name']}}</h3>
                <p class="md:text-md 2xl:text-2xl text-xs">{{$project['brief_detail']}}</p>
            </div>
            <ul class="overflow-auto lg:h-32 h-48 2xl:h-full text-xs 2xl:text-xl space-y-4 w-full no-scrollbar list-disc list-inside">
                @foreach($project['highlights'] as $point)
                    <li>{{$point}}</li>
                @endforeach
            </ul>
        </div>  
        <div class="bg-white border border-black h-full col-span-3 w-full flex items-center justify-center xl:px-18 rounded">
            <img src="{{ asset($project['web_pic'] ?? 'assets/bacancy/logo2.webp') }}" alt="Project Logo" class="w-full object-container">
        </div>
    </div>
</div>