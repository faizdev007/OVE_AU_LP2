<x-layouts.page.bacancy :header="$header" :seo="$seo??['metaTitle'=>'','metaDescription'=>'']" :title="__('Optimal Virtual Employee')">
    <livewire:s-e-o :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.header :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.herosection :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.profiles :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.companies-logo :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.under-one-roof :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.tech-stack :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.ai-block :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.clients-profile :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.projects :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.faq :lp_data="$lp_data ?? []"/>
    <livewire:bacancypage.our-office-location :lp_data="$lp_data ?? []"/>
</x-layouts.page.bacancy>
