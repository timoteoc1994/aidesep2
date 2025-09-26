<template>
    <header :class="[
        'fixed top-0 w-full z-[999] p-4 transition-shadow duration-300 h-20 bg-[#124228]',
        scrolled ? 'shadow-md' : ''
    ]">
        <div class="w-full px-4 flex justify-between items-center h-full">
            <!-- Logo (sin dejar espacio si no hay) -->
            <div class="text-2xl font-bold flex items-center cursor-pointer
      " @click="smoothScrollTo('inicio')">
                <img class="h-10 md:h-10 lg:h-12 w-full" :src="logo" alt="Logo" />

            </div>

            <!-- Menú en escritorio -->
            <nav class="hidden md:flex items-center mr-5">
                <ul class="flex space-x-4 md:space-x-12">
                    <li v-for="section in sections" :key="section.id">
                        <a href="javascript:void(0)" @click="smoothScrollTo(section.id)"
                            class="relative tracking-wide font-semibold after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 hover:after:w-full transition-colors duration-300"
                            :style="{
                                color: emprendimiento.color_secundario_2,
                                '--hover-color': emprendimiento.color_secundario_2
                            }" :class="[
                'after:bg-[var(--hover-color)]',
                activeSection === `#${section.id}` ? 'after:w-full' : ''
            ]">
                            {{ section.label }}
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Menú móvil -->
            <!-- Menú móvil -->
            <div class="md:hidden flex items-center h-full relative">
                <button @click="toggleMenu" class="focus:outline-none text-[#FFF8EA]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <!-- MENÚ DESPLEGABLE -->
                <ul v-if="menuOpen"
                    class="absolute top-full mt-2 right-0 w-48 shadow-lg rounded-lg z-50 bg-white text-black">
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
const props = defineProps({
    sections: Array,
    activeSection: String,
    scrolled: Boolean,
    smoothScrollTo: Function,
    menuOpen: Boolean,
    toggleMenu: Function,
    emprendimiento: Object,
    logo: String,
})

const valido = (val) =>
    val !== null && val !== undefined && val !== 'undefined' && val !== ''
</script>
