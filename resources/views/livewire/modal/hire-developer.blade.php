<div>
    <div class="md:flex md:p-0 py-4 items-center justify-between">
        <!-- Left info panel -->
        <div class="flex-1 w-full aspect-[1/1] relative md:block hidden">
            <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/modalpic2.webp') }}" alt="book_a_30_mins_strategy_call" height="500px" width="500px" class="w-full h-full object-cover" />
            <div class="bg-black/50 h-full w-full absolute top-0 bottom-0 start-0 end-0 z-10"></div>
            <div class="absolute top-0 bottom-0 start-0 end-0 z-20 flex flex-col justify-around h-full gap-2 p-4 text-white">
                <h2 class="md:text-2xl text-xl text-center">{{ $title }}</h2>
                <ul>
                    @foreach($lists as $key => $item)
                    <li class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-green-500">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                        {{$item}}
                    </li>
                    @endforeach
                </ul>
                <div class="grid gap-2">
                    <h4>{{ $stacktitle }}</h4>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($stack as $key => $single)
                        <div class="">
                            <h3 class="font-bold uppercase">{{$single['title']}}</h3>
                            <p>{{$single['description']}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex justify-start">
                    <img loading="lazy" decoding="async" src="{{asset($old_path)}}" alt="google rating" class="h-14"/>
                </div>
            </div>
        </div>

        <!-- Right form panel -->
        <div class="flex-1 w-full aspect-[1/1] md:py-0">
            <div class="max-w-3xl mx-auto p-6 space-y-2">
                <flux:heading center>
                    <h2 class="text-xl md:text-3xl font-bold  text-black text-center">{{$formtitle}}</h2>
                </flux:heading>
                <h2 class="md:text-xl text-md text-center py-2  text-black">{{$formsubtitle}}</h2>
                <hr class="border-black">
                {{-- Progress Bar --}}
                <div class="w-full hidden bg-gray-200 rounded-full h-2 mb-6">
                    <div class="h-2 bg-bacancy-primary rounded-full transition-all duration-300"
                         style="width: {{ $step == 1 ? '50%' : '100%' }};">
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="mb-4 rounded-lg bg-green-50 text-green-800 px-4 py-3">{{ session('message') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="mb-4 rounded-lg bg-red-50 text-red-800 px-4 py-3">{{ session('error') }}</div>
                @endif

                {{-- STEP 1 --}}
                @if ($step == 1)
                    <form wire:submit.prevent="nextStep" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="full_name">Full Name</label>
                            <input type="text" id="full_name" wire:model="full_name" 
                                   class="w-full rounded-md border px-3 py-3 focus:outline-none focus:ring-2 bg-white focus:ring-blue-700 @error('full_name') border-red-600 @enderror"
                                   placeholder="Enter full name">
                            @error('full_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="company_email">Company Email</label>
                            <input type="email" id="company_email" wire:model="company_email"
                                   class="w-full rounded-md border px-3 py-3 focus:outline-none focus:ring-2 bg-white focus:ring-blue-700 @error('company_email') border-red-600 @enderror"
                                   placeholder="Enter email">
                            @error('company_email')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            <small class="text-gray-500">— no Gmail/Yahoo/Hotmail allowed</small>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="phone">Phone</label>
                            <input type="text" id="phone" wire:model="phone"
                                   class="w-full rounded-md border px-3 py-3 focus:outline-none focus:ring-2 bg-white focus:ring-blue-700 @error('phone') border-red-600 @enderror"
                                   placeholder="Enter phone number">
                            @error('phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <x-submit-button 
                            type="submit" 
                            title="Next"
                            target="nextStep"
                            otp-triger="true"
                            class="w-full !md:text-2xl hover:!bg-gray-900 hover:!text-white focus:!ring-[#000000]"
                        />
                    </form>
                @endif

                {{-- STEP 2 --}}
                @if ($step == 2)
                    <form wire:submit.prevent="verifyOtp" aria-label="otpcount" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="otp">Enter the OTP sent to your email</label>
                            <input type="text" id="otp" wire:model="otp"
                                   class="w-full rounded-md border px-3 py-3 focus:outline-none focus:ring-2 bg-white focus:ring-blue-700 @error('otp') border-red-600 @enderror"
                                   placeholder="@error('otp') {{ $message }} @else Enter OTP @enderror">
                        </div>

                        <div>
                            @if ($otpSent)
                                @if ($cooldown)
                                    <button disabled>
                                        Resend OTP ({{ $secondsRemaining }}s)
                                    </button>
                                @else
                                    <button wire:click="resendOtp" aria-label="resentotpactive" class="underline text-blue-800 cursor-pointer">Resend OTP</button>
                                @endif
                            @endif
                        </div>

                        <div class="flex justify-between">
                            <x-submit-button 
                                type="submit" 
                                title="Verify OTP"
                                target="nextStep"
                                class="w-full !md:text-2xl hover:!bg-gray-900 hover:!text-white focus:!ring-[#000000]"
                            />
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const observer = new MutationObserver(() => {
            const otpElement = document.querySelector('[aria-label="otpcount"]');
            if (otpElement) {
                console.log("OTP section loaded ✅");
                startOtpCountdown();
                // observer.disconnect(); // stop watching once found
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });

    function startOtpCountdown() {
        let seconds = 60;
        const countdown = setInterval(() => {
            seconds--;
            
            Livewire.dispatch('updateCooldownTimer', { seconds });

            if (seconds <= 0) {
                clearInterval(countdown);
                Livewire.dispatch('resetResendCooldown');
            }

        }, 1000);

        // Attach button click immediately when countdown starts
        const button = document.querySelector('[aria-label="resentotpactive"]');

        if (button) {
            button.addEventListener("click", () => {
                console.log("Resend OTP clicked 🔄");
                clearInterval(countdown); // stop old countdown
                startOtpCountdown();      // restart countdown
            }); // ensure listener runs once per click
        }
    }
</script>