<div class="border-b border-white text-white bg-sv-gradient-bottomtop pt-10 relative">
    <div class="pt-6 h-full relative max-w-5xl mx-auto text-center">
        <h2 class="text-center text-white md:text-3xl text-lg font-bold mb-10">
            <code><</code>Communication is the Key to Better Problem-Solving <code>/ ></code>
        </h2>
        <p class="mb-6">Tell us what you need and we’ll give you a transparent cost breakdown—no hidden fees.</p>

        <div class="w-full px-3 bottom-0 mx-auto">
            <form wire:submit.prevent="submitForm" class="relative overflow-hidden">
                <!-- Step 1 -->
                <div
                    id="step1"
                    class="relative inset-shadow-sm inset-shadow-white z-10 w-full top-0 left-0 bg-sv-primary text-white md:px-20 px-10 py-5"
                    style="clip-path: polygon(95% 100%, 5% 100%, 0% 0%, 100% 0%)"
                >
                    <div class="py-20 flex flex-col items-center gap-6">
                        <p class="font-mono text-base sm:text-lg md:text-xl font-bold mb-4">
                            &lt; How many developers do you need? / &gt;
                        </p>
                        <div class="space-y-3 md:w-1/2 text-start sm:space-y-4 pl-1 sm:pl-3">
                            @php
                                $devsOptions = [
                                    'One developer' => 'One developer',
                                    'More Than One developer' => 'More Than One developer',
                                    'I am looking for a cross-functional team' => 'I am looking for a cross-functional team',
                                    "I'm not sure yet" => "I'm not sure yet"
                                ];
                            @endphp
                            @foreach ($devsOptions as $value => $label)
                                <label class="flex items-center space-x-3">
                                    <input type="radio" id="{{$value}}" value="{{$value}}" wire:model="requriedpoeple" class="accent-white w-5 h-5" />
                                    <span class="font-mono text-sm sm:text-base flex-1 text-gray-300">{{$label}}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-silicon-valley.action-button onclick="next('step2')" :title="'Next'" class="hover:bg-sv-secondary/50 mt-6"/>
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    id="step2"
                    x-transition:enter="transition translate-y-full ease-out duration-800"
                    x-transition:enter-start="transform translate-y-full"
                    x-transition:enter-end="transform translate-y-0"
                    x-transition:leave="transition ease-in duration-800"
                    x-transition:leave-start="transform translate-y-0"
                    x-transition:leave-end="transform translate-y-full"
                    class="absolute h-full inset-shadow-sm inset-shadow-white transition translate-y-full z-20 w-full top-0 left-0 bg-sv-primary text-white md:px-20 px-10 py-5"
                    style="clip-path: polygon(95% 100%, 5% 100%, 0% 0%, 100% 0%)"
                >
                    <div class="py-20 flex flex-col items-center gap-6">
                        <p class="font-mono text-base sm:text-lg md:text-xl font-bold text-center">
                            &lt; When do you wish to hire? / &gt;
                        </p>
                        <div class="space-y-3 md:w-1/2 text-start sm:space-y-4 pl-1 sm:pl-3">
                            <!-- Repeat same labels -->
                            @php
                                $devsOptions = [
                                    'Today' => 'Today',
                                    'In a week' => 'In a week',
                                    'In a month' => 'In a month',
                                    'Not Sure' => "Not Sure"
                                ];
                            @endphp
                            @foreach ($devsOptions as $value => $label)
                                <label class="flex items-center space-x-3">
                                    <input type="radio" id="{{$value}}" value="{{$value}}" wire:model="requiredwithin" class="accent-white w-5 h-5" />
                                    <span class="font-mono text-sm sm:text-base flex-1 text-gray-300">{{$label}}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="flex gap-4 justify-center pb-4 mt-6">
                            <x-silicon-valley.action-button onclick="previouse('step2')" :title="'Previous'" class="!bg-sv-primary hover:!bg-sv-secondary/30 border border-white"/>
                            <x-silicon-valley.action-button onclick="next('step3')" :title="'Next'" class="hover:bg-sv-secondary/50"/>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    id="step3"
                    x-transition:enter="transition translate-y-full ease-out duration-800"
                    x-transition:enter-start="transform translate-y-full"
                    x-transition:enter-end="transform translate-y-0"
                    x-transition:leave="transition ease-in duration-800"
                    x-transition:leave-start="transform translate-y-0"
                    x-transition:leave-end="transform translate-y-full"
                    class="absolute inset-shadow-sm inset-shadow-white transition translate-y-full z-20 w-full top-0 left-0 bg-sv-primary text-white md:px-20 px-10 py-5"
                    style="clip-path: polygon(95% 100%, 5% 100%, 0% 0%, 100% 0%)"
                >
                    <div class="py-20 flex flex-col items-center gap-6 pb-4">
                        <p class="font-mono text-base sm:text-lg md:text-xl font-bold text-center">
                            &lt; Tell Us more about your requirement? / &gt;
                        </p>
                        <div class="">
                            <div class="my-4">
                                <label for="name" class="block text-sm font-medium mb-1 hidden">Full Name</label>
                                <input type="text" autocomplete="true" id="name" wire:model.defer="name" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white" placeholder="Full Name"/>
                                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
    
                            
                            <div class="md:flex gap-4">
                                <div class="my-4">
                                    <label for="email" class="block text-sm font-medium mb-1 hidden">Email</label>
                                    <input type="email" autocomplete="true" id="email" placeholder="Email" wire:model.defer="email" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"/>
                                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="my-4">
                                    <label for="phone" class="block text-sm font-medium mb-1 hidden">phone</label>
                                    <input type="phone" autocomplete="true" id="phone" placeholder="Phone" wire:model.defer="phone"
                                    inputmode="numeric" 
                                    pattern="\d*" 
                                    required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                    maxlength="14"
                                    class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"/>
                                    @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
    
                            <div class="my-4">
                                <label for="project_brief" class="block text-sm font-medium mb-1 hidden">Project Brief</label>
                                <textarea type="text" rows="2" id="project_brief" placeholder="Requirement" wire:model.defer="project_brief" class="w-full border-0 border-b border-white bg-transparent px-3 py-2 text-white placeholder-white focus:outline-none focus:ring-0 focus:border-white"></textarea>
                                @error('projectBrief') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex gap-4 justify-center mt-6">
                                <x-silicon-valley.action-button onclick="previouse('step3')" :title="'Previous'"  class="!bg-sv-primary hover:!bg-sv-secondary/30 border border-white"/>
                                <x-submit-button 
                                    type="submit" 
                                    title="Submit" 
                                    target="submitForm"
                                    class="hover:bg-sv-secondary/50 bg-sv-secondary !py-2 !rounded-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Alpine Script -->
    <script>
        function next(blockId) {
            const currentStep = document.getElementById(blockId);
            currentStep.classList.remove('transform');
            currentStep.classList.remove('translate-y-full');
        }
        function previouse(blockId) {
            const prevStep = document.getElementById(blockId);
            prevStep.classList.add('transform');
            prevStep.classList.add('translate-y-full');
        }
    </script>
</div>
