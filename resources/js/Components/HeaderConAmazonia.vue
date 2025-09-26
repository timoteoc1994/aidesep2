<template>
    <header :class="[
        'fixed top-0 w-full text-[#c18815] z-[999] p-4 bg-white transition-shadow duration-300',
        scrolled ? 'shadow-md' : ''
    ]">
        <div class="w-full px-4 flex  items-center">
            <div class="text-2xl font-bold cursor-pointer"@click="smoothScrollTo('inicio')">
                <img width="15%" :src="logo" alt="Logo" />
            </div>

            <nav class="hidden md:flex mr-5">
                <ul class="flex space-x-4 md:space-x-12">
                    <li v-for="section in sections" :key="section.id">
                        <a href="javascript:void(0)" @click="smoothScrollTo(section.id)" :class="[
                            'relative tracking-wide font-semibold after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 hover:after:w-full',
                            activeSection === `#${section.id}`
                                ? 'text-[#00512e] after:bg-[#00512e] hover:text-[#00512e]'
                                : 'text-[#00512e] after:bg-[#00512e] hover:text-[#00512e]',
                            activeSection === `#${section.id}` ? 'after:w-full' : ''
                        ]">
                            {{ section.label }}
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="md:hidden">
                <button @click="toggleMenu" class="text-[#FFF8EA] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <ul v-if="menuOpen" class="absolute bg-white text-black mt-2 right-9 w-48 shadow-lg rounded-lg">
                    <li v-for="section in sections" :key="section.id" class="border-b border-gray-200 last:border-b-0">
                        <a href="javascript:void(0)" @click="smoothScrollTo(section.id)" :class="[
                            'block px-4 py-2 tracking-wide font-semibold',
                            activeSection === `#${section.id}` ? 'text-[#124228]' : 'text-gray-400'
                        ]">
                            {{ section.label }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script setup>
const props = defineProps(['sections', 'activeSection', 'scrolled', 'smoothScrollTo', 'menuOpen', 'toggleMenu', 'logo'])
</script>
