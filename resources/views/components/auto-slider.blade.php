{{-- If your happiness depends on money, you will never be happy with yourself. --}}
<div 
    x-data="{
        activeIndex: 0,
        autoSlide: @json($autoSlide),
        interval: @json($interval),
        showNav: @json($showNav),
        perPage: 1,
        cardmd: @json($cardmd ?? 2),
        cardlg: @json($cardlg ?? 3),
        cardxl: @json($cardxl ?? 4),
        card2xl: @json($card2xl ?? 5),
        scrollContainer: null,
        isScrollable: true,
        autoSlideInterval: null,

        init() {
            this.scrollContainer = $refs.cards;
            this.setResponsivePerPage();
            this.updateWidths();
            this.checkIfScrollable();
            this.scrollToCard(this.activeIndex);

            window.addEventListener('resize', () => {
                this.setResponsivePerPage();
                this.updateWidths();
                this.checkIfScrollable();
                this.scrollToCard(this.activeIndex);
            });

            if (this.autoSlide) {
                this.startAutoSlide();
            }
        },

        // Determine how many cards to show based on screen width
        setResponsivePerPage() {
            const width = window.innerWidth;
            if (width < 640) {
                this.perPage = 1;
            } else if (width < 1024) {
                this.perPage = this.cardmd;
            } else if (width < 1280) {
                this.perPage = this.cardlg;
            } else if (width < 1500) {
                this.perPage = this.cardxl;
            } else {
                this.perPage = this.card2xl;
            }
        },

        getSlideWidth() {
            const screenWidth = window.innerWidth;
            if (screenWidth < 768) return '100%';
            return `calc((100% - 1rem * (${this.perPage} - 1)) / ${this.perPage})`;
        },

        updateWidths() {
            const width = this.getSlideWidth();
            Array.from(this.scrollContainer.children).forEach((el) => {
                el.style.flex = '0 0 auto';
                el.style.width = width;
                el.classList.add('snap-start');
            });
        },

        checkIfScrollable() {
            const totalWidth = Array.from(this.scrollContainer.children).reduce(
                (total, el) => total + el.offsetWidth,
                0
            );
            const visibleWidth = this.scrollContainer.offsetWidth;
            this.isScrollable = totalWidth > visibleWidth;

            if (!this.isScrollable) {
                this.autoSlide = false;
                this.showNav = false;
            }
        },

        scrollToCard(index) {
            const card = this.scrollContainer.children[0];
            if (!card) return;

            const gap = parseInt(getComputedStyle(card).marginRight) || 16;
            const scrollAmount = index * (card.offsetWidth + gap);

            this.scrollContainer.scrollTo({
                left: scrollAmount,
                behavior: 'smooth'
            });
        },

        autoNext() {
            const cards = this.scrollContainer.children;
            const maxIndex = cards.length - this.perPage;
            if (this.activeIndex < maxIndex) {
                this.activeIndex++;
            } else {
                this.activeIndex = 0;
            }
            this.scrollToCard(this.activeIndex);
        },

        next() {
            const cards = this.scrollContainer.children;
            const maxIndex = cards.length - this.perPage;
            if (this.activeIndex < maxIndex) {
                this.activeIndex++;
                this.scrollToCard(this.activeIndex);
            }
        },

        prev() {
            if (this.activeIndex > 0) {
                this.activeIndex--;
                this.scrollToCard(this.activeIndex);
            }
        },

        startAutoSlide() {
            this.autoSlideInterval = setInterval(() => {
                if (this.autoSlide && this.isScrollable) {
                    this.autoNext();
                }
            }, this.interval);
        },

        pauseAutoSlide() {
            if (this.autoSlideInterval) {
                clearInterval(this.autoSlideInterval);
                this.autoSlideInterval = null;
            }
        },

        resumeAutoSlide() {
            if (!this.autoSlideInterval && this.autoSlide) {
                this.startAutoSlide();
            }
        }
    }"
    x-init="init()"
    @mouseenter="pauseAutoSlide"
    @mouseleave="resumeAutoSlide"
    class="relative w-full overflow-hidden md:px-4"
>
    <!-- Left Arrow -->
    <template x-if="showNav && isScrollable">
        <button 
            @click="prev" 
            class="absolute h-10 w-10 left-2 top-1/2 transform -translate-y-1/2 -translate-x-1/5 bg-bacancy-primary/50 hover:bg-bacancy-primary/90 text-white p-2 rounded-full shadow z-20"
        >
            &#8592;
        </button>
    </template>

    <!-- Cards Container -->
    <div 
        x-ref="cards" 
        class="flex gap-4 overflow-x-auto scroll-smooth no-scrollbar items-stretch snap-x snap-mandatory"
    >
        {{ $slot }}
    </div>

    <!-- Right Arrow -->
    <template x-if="showNav && isScrollable">
        <button 
            @click="next" 
            class="absolute h-10 w-10 right-2 top-1/2 transform -translate-y-1/2 translate-x-1/5 bg-bacancy-primary/50 hover:bg-bacancy-primary/90 text-white p-2 rounded-full shadow z-10"
        >
            &#8594;
        </button>
    </template>
</div>
