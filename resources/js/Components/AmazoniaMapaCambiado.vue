<template>
    <section id="mapa" class="flex flex-col md:flex-row bg-white text-emerald-400 max-w-6xl mx-auto">
        <!-- Panel izquierdo -->
        <div class="w-full md:w-1/4 p-8 flex flex-col justify-between">
            <div class="flex-1 min-h-[5rem]">
                <h1 class="text-6xl font-bold mb-6 transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)]">
                    {{ activeCountryInfo.nombre.toUpperCase() }}
                </h1>

                <!-- Mobile: scroll horizontal -->
                <div class="block md:hidden mt-5 mb-5 overflow-x-auto scrollbar-hide">
                    <div class="flex gap-3 w-max">
                        <button v-for="(name, code) in amazonCountries" :key="code" @click="selectCountry(code)"
                            class="whitespace-nowrap px-4 py-2 rounded-full border transition-all duration-300" :class="{
                                'bg-emerald-400 text-white font-semibold': selectedCountry === code,
                                'bg-white text-emerald-400 border-emerald-300': selectedCountry !== code
                            }">
                            {{ name }}
                        </button>
                    </div>
                </div>

                <p
                    class="text-emerald-400 mb-8 text-base sm:text-lg md:text-xl lg:text-2xl transition-opacity duration-500 ease-in-out h-[4rem] sm:h-[5rem] md:h-[10rem] lg:h-[9rem] overflow-hidden">
                    {{ activeCountryInfo.detalle }}
                </p>
            </div>

            <!-- Desktop: lista vertical -->
            <nav class="hidden md:block mt-12">
                <ul class="space-y-3">
                    <li v-for="(name, code) in amazonCountries" :key="code">
                        <button @click="selectCountry(code)"
                            class="relative inline-flex items-center justify-start overflow-hidden py-1 px-2 rounded-md transition-all duration-300 ease-out group"
                            :class="{
                                'text-white font-bold': selectedCountry === code,
                                'text-emerald-400 hover:text-white': selectedCountry !== code
                            }">
                            <span class="relative z-10 text-left">{{ name }}</span>
                            <span
                                class="absolute left-0 top-0 w-full h-full bg-emerald-400 opacity-0 group-hover:opacity-100 rounded-md transition-all duration-300 ease-out"
                                :class="{ 'opacity-100': selectedCountry === code }"></span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Mapa tablet 225 150 750 700  celular  -->
        <div class="w-full md:w-2/4 flex items-center justify-center mb-5 md:mt-14">
            <div class="w-full flex justify-center items-center h-[300px] sm:h-[500px] md:h-full lg:h-full">
                <!-- SVG con viewBox diferente para pantallas pequeñas -->
                <svg viewBox="150 550 250 1" xmlns="http://www.w3.org/2000/svg" class="w-full h-[500px] md:h-full"
                    preserveAspectRatio="xMidYMid meet">
                    <g>
                        <path v-for="(path, code) in countryPaths" :key="code" :d="path" :fill="getCountryColor(code)"
                            stroke="#0C2924" stroke-width="0.1" :fill-opacity="getFillOpacity(code)"
                            @mouseover="hoverCountry(code)" @mouseout="unhoverCountry" @click="handleCountryClick(code)"
                            class="cursor-pointer transition-all duration-300 ease-out" :class="{
                                'border-2 border-white': hoveredCountry === code || selectedCountry === code,
                            }" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- Panel derecho -->
        <div class="w-full md:w-1/4 p-8 flex flex-col justify-center items-center md:items-end">
            <div class="space-y-12">
                <div>
                    <div class="text-5xl font-bold transition-all duration-500 ease-out">
                        {{ activeCountryInfo.poblacion.split(" ")[0] }}
                        <span class="ml-2 text-xl transition-all duration-300">M</span>
                    </div>
                    <p class="text-emerald-400 mt-2 transition-colors duration-500">Población</p>
                </div>

                <div v-if="activeCountryInfo.children" class="transition-all duration-500">
                    <div class="text-5xl font-bold">{{ activeCountryInfo.children || 'S/R' }}</div>
                    <p class="text-emerald-400 mt-2">niños de 5–17 años</p>
                </div>

                <div v-if="activeCountryInfo.hazardous" class="transition-all duration-500">
                    <div class="text-5xl font-bold">{{ activeCountryInfo.hazardous }}</div>
                    <p class="text-emerald-400 mt-2">en situación peligrosa</p>
                </div>

            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'
import { countryPaths } from '@/Components/countryPaths_high.js'
import Swal from 'sweetalert2'

const amazonCountries = {
    BR: "Brasil",
    PE: "Perú",
    CO: "Colombia",
    VE: "Venezuela",
    EC: "Ecuador",
    BO: "Bolivia",
    GY: "Guyana",
    SR: "Surinam",
    GF: "Guayana Francesa",
}

const amazonCountryColors = {
    BR: "#1D4B44",
    PE: "#2A685F",
    CO: "#378476",
    VE: "#439F8C",
    EC: "#64B29F",
    BO: "#85C4B2",
    GY: "#A7D7C5",
    SR: "#C8E9D7",
    GF: "#E0F5EB",
}

const countryInfo = {
    BR: {
        nombre: "Brasil",
        capital: "Brasilia",
        poblacion: "213 millones",
        superficie: "8.5 millones km²",
        children: "3.28M",
        hazardous: "0.72M",
        detalle: "El país más grande de Sudamérica y América Latina."
    },
    PE: {
        nombre: "Perú",
        capital: "Lima",
        poblacion: "33 millones",
        superficie: "1.28 millones km²",
        children: "880K",
        hazardous: "210K",
        detalle: "Diversidad geográfica y cultural."
    },
    CO: {
        nombre: "Colombia",
        capital: "Bogotá",
        poblacion: "51 millones",
        superficie: "1.14 millones km²",
        children: "1.2M",
        hazardous: "300K",
        detalle: "Con grandes selvas tropicales."
    },
    VE: {
        nombre: "Venezuela",
        capital: "Caracas",
        poblacion: "28 millones",
        superficie: "916 mil km²",
        children: "600K",
        hazardous: "150K",
        detalle: "Rico en biodiversidad amazónica."
    },
    EC: {
        nombre: "Ecuador",
        capital: "Quito",
        poblacion: "17 millones",
        superficie: "256 mil km²",
        children: "400K",
        hazardous: "95K",
        detalle: "Selvas muy biodiversas."
    },
    BO: {
        nombre: "Bolivia",
        capital: "La Paz / Sucre",
        poblacion: "12 millones",
        superficie: "1.09 millones km²",
        children: "320K",
        hazardous: "80K",
        detalle: "60% del territorio es amazónico."
    },
    GY: {
        nombre: "Guyana",
        capital: "Georgetown",
        poblacion: "790 mil",
        superficie: "215 mil km²",
        children: "90K",
        hazardous: "25K",
        detalle: "Gran parte del país es selva tropical poco explorada."
    },
    SR: {
        nombre: "Surinam",
        capital: "Paramaribo",
        poblacion: "618 mil",
        superficie: "164 mil km²",
        children: "70K",
        hazardous: "18K",
        detalle: "País pequeño, pero en su mayoría cubierto de selva."
    },
    GF: {
        nombre: "Guayana Francesa",
        capital: "Cayena",
        poblacion: "300 mil",
        superficie: "84 mil km²",
        children: "35K",
        hazardous: "9K",
        detalle: "Territorio francés en Sudamérica, rico en biodiversidad amazónica."
    }
};

const selectedCountry = ref('BR')
const hoveredCountry = ref(null)

const activeCountryInfo = computed(() => {
    const active = hoveredCountry.value || selectedCountry.value
    return countryInfo[active] || {
        nombre: active,
        detalle: "No pertenece a la cuenca amazónica.",
        poblacion: "S/R",
        children: "S/R",
        hazardous: "S/R"
    }
})

const selectCountry = (code) => {
    selectedCountry.value = code
    hoveredCountry.value = null
}

const hoverCountry = (code) => {
    if (countryPaths[code]) {
        hoveredCountry.value = code
    }
}

const unhoverCountry = () => {
    hoveredCountry.value = null
}

const handleCountryClick = (code) => {
  if (!amazonCountries[code]) return // Desactiva por completo

  if (code === 'EC') {
    inertiaRouter.visit('/conAmazonia')
  } else {
    inertiaRouter.visit(`/pais/${code}`)
  }
}




const resetMap = () => {
    hoveredCountry.value = null
    selectedCountry.value = 'BR'
}

const getCountryColor = (code) => {
    return amazonCountryColors[code] || '#cccccc'
}

const getFillOpacity = (code) => {
    if (hoveredCountry.value === code) return 0.9
    if (selectedCountry.value === code) return 0.8
    if (amazonCountries[code]) return 0.6
    return 0.4
}
</script>

<style scoped>
/* Aplicando el borde solo en hover */
path {
    transition: all 0.3s ease;
}

path:hover {
    border: 2px solid white;
    /* Esto solo agrega el borde sin cambiar el tamaño del país */
    fill-opacity: 0.8;
}
h1 {
    white-space: nowrap;
}

</style>
