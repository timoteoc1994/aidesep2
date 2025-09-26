<template>
      <div class="bg-[#FBF8F3]">
    <section id="mapa" class="flex flex-col md:flex-row bg-[#FBF8F3] text-[#AB8219] max-w-6xl mx-auto">
        <!-- Panel izquierdo -->
        <div class="w-full md:w-1/4 p-8 flex flex-col justify-between">
            <div class="flex-1 min-h-[5rem]">
                <h1 data-aos="zoom-in" data-aos-delay="100" class="text-6xl font-bold mb-6 transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)]">
                    {{ activeCountryInfo.nombre.toUpperCase() }}
                </h1>

                <!-- Mobile: scroll horizontal -->
                <div data-aos="zoom-in" data-aos-delay="200" class="block md:hidden mt-5 mb-5">
                    <!-- Arrow above the scrollable content -->
                    <div class="flex justify-end mb-2">
                        <div class="text-4xl arrow-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#0E6736]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Scrollable buttons below -->
                    <div class="overflow-x-auto scrollbar-hide pb-2">
                        <div class="flex gap-3 w-max">
                            <button v-for="(name, code) in amazonCountries" :key="code" @click="selectCountry(code)"
                                class="whitespace-nowrap px-4 py-2 rounded-full border transition-all duration-300"
                                :class="{
                                    'bg-[#0D6734] text-white font-semibold': selectedCountry === code,
                                    'bg-white text-[#0D6734] border-[#0D6734]': selectedCountry !== code
                                }">
                                {{ name }}
                            </button>
                        </div>
                    </div>
                </div>
                <p
                data-aos="zoom-in" data-aos-delay="500" class="text-[#0E6736] mb-8 text-base sm:text-lg md:text-xl lg:text-2xl transition-opacity duration-500 ease-in-out h-[4rem] sm:h-[5rem] md:h-[10rem] lg:h-[9rem] overflow-hidden">
                    {{ activeCountryInfo.detalle }}
                </p>
            </div>

            <!-- Desktop: lista vertical -->
            <nav data-aos="zoom-in" data-aos-delay="300" class="hidden md:block ">
                <ul class="space-y-3">
                    <li v-for="(name, code) in amazonCountries" :key="code">
                        <button @click="selectCountry(code)"
                            class="relative inline-flex items-center justify-start overflow-hidden py-1 px-2 rounded-md transition-all duration-300 ease-out group"
                            :class="{
                                'text-white font-bold': selectedCountry === code,
                                'text-[#0E6736] hover:text-white': selectedCountry !== code
                            }">
                            <span class="relative z-10 text-left">{{ name }}</span>
                            <span
                                class="absolute left-0 top-0 w-full h-full bg-[#AB8219] opacity-0 group-hover:opacity-100 rounded-md transition-all duration-300 ease-out"
                                :class="{ 'opacity-100': selectedCountry === code }"></span>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Mapa tablet 225 150 750 700  celular  -->
        <div data-aos="zoom-in" data-aos-delay="400" class="w-full md:w-2/4 flex items-center justify-center mb-5 md:mt-14">
            <div class="w-full flex justify-center items-center h-[300px] sm:h-[500px] md:h-full lg:h-full">
                <!-- SVG con viewBox diferente para pantallas pequeñas -->
                <svg viewBox="170 530 250 1" xmlns="http://www.w3.org/2000/svg" class="w-full h-[500px] md:h-full"
                    preserveAspectRatio="xMidYMid meet">
                    <g>
                        <path v-for="(path, code) in countryPaths" :key="code" :d="path" :fill="getCountryColor(code)"
                            stroke="#0C2924" stroke-width="0.2" :fill-opacity="getFillOpacity(code)"
                            @mouseover="hoverCountry(code)" @mouseout="unhoverCountry" @click="handleCountryClick(code)"
                            class="cursor-pointer transition-all duration-300 ease-out" :class="{
                                'border-2 border-white': hoveredCountry === code || selectedCountry === code,
                            }" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- Panel derecho -->
        <div data-aos="zoom-in" data-aos-delay="500" class="w-full md:w-1/4 p-8 flex flex-col justify-center items-center md:items-end">
            <div class="space-y-12">
                <div>
                    <div class="text-5xl font-bold transition-all duration-500 ease-out">
                        {{ activeCountryInfo.poblacion.split(" ")[0] }}
                        <span class="ml-2 text-xl transition-all duration-300">M</span>
                    </div>
                    <p class="text-[#0E6736] mt-2 transition-colors duration-500">Población</p>
                </div>

                <div v-if="activeCountryInfo.children" class="transition-all duration-500">
                    <div class="text-5xl font-bold">{{ activeCountryInfo.children || 'S/R' }}</div>
                    <p class="text-[#0E6736] mt-2">niños de 5–17 años</p>
                </div>

                <div v-if="activeCountryInfo.hazardous" class="transition-all duration-500">
                    <div class="text-5xl font-bold">{{ activeCountryInfo.hazardous }}</div>
                    <p class="text-[#0E6736] mt-2">en situación peligrosa</p>
                </div>

            </div>
        </div>
    </section>
</div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'
import { countryPaths } from '@/Components/countryPaths_high.js'
import Swal from 'sweetalert2'

const amazonCountries = {
    EC: "Ecuador",
    PE: "Perú",
    BO: "Bolivia",
    VE: "Venezuela",
    CO: "Colombia",
    BR: "Brasil",
    GY: "Guyana",
    SR: "Surinam",
    GF: "Guayana Francesa",
}

const amazonCountryColors = {
  BR: "#0C6734", // L ≈ 22.7% (base)
  PE: "#12944A", // L ≈ 32.7%
  CO: "#18C161", // L ≈ 42.7%
  VE: "#29E37A", // L ≈ 52.7%
  EC: "#56E996", // L ≈ 62.7%
  BO: "#83EFB2", // L ≈ 72.7%
  GY: "#B0F5CE", // L ≈ 82.7%
  SR: "#D1F9E2", // L ≈ 90.0%
  GF: "#E8FCF0", // L ≈ 95.0%
};




const countryInfo = {
    EC: {
        nombre: "Ecuador",
        capital: "Quito",
        poblacion: "17 millones",
        superficie: "256 mil km²",
        children: "400K",
        hazardous: "95K",
        detalle: "Selvas muy biodiversas."
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
    BO: {
        nombre: "Bolivia",
        capital: "La Paz / Sucre",
        poblacion: "12 millones",
        superficie: "1.09 millones km²",
        children: "320K",
        hazardous: "80K",
        detalle: "60% del territorio es amazónico."
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
    BR: {
        nombre: "Brasil",
        capital: "Brasilia",
        poblacion: "213 millones",
        superficie: "8.5 millones km²",
        children: "3.28M",
        hazardous: "0.72M",
        detalle: "El país más grande de Sudamérica y América Latina."
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

const selectedCountry = ref('EC')
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
    // Primero seleccionamos el país
    selectedCountry.value = code;
    hoveredCountry.value = null;

    // Navegamos hacia el país seleccionado
    if (code === 'EC') {
        // Si es Ecuador, redirigimos a la URL específica
        window.location.href = 'https://conamazonia.com';  // O la URL que necesites
    } else if (code === 'BO') {
        inertiaRouter.visit('/conBolivia');  // Redirigir a la página de Bolivia
    } else {
        // Navegar a la página del país en la aplicación
        inertiaRouter.visit(`/pais/${code}`);
    }
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
    if (!amazonCountries[code]) return

    if (code === 'EC') {
        window.location.href = 'https://conamazonia.com';
    } else if (code === 'BO') {
        inertiaRouter.visit('/conBolivia');
    } else {
        inertiaRouter.visit(`/pais/${code}`);
    }
}




const resetMap = () => {
    hoveredCountry.value = null
    selectedCountry.value = 'EC'
}

const getCountryColor = (code) => {
    return amazonCountryColors[code] || '#cccccc'
}

const getFillOpacity = (code) => {
    if (hoveredCountry.value === code) return 0.9
    if (selectedCountry.value === code) return 0.8
    if (amazonCountries[code]) return 0.7
    return 0.4
}
</script>

<style scoped>
/* Aplicando el borde solo en hover */
path {
    transition: all 0.3s ease;
}

path:hover {
  /* Relleno amarillo-ocre */
  fill: #AB8219 !important;
  /* Trazo blanco de 2px */
  stroke: black !important;
  stroke-width: 0.2 !important;
}


h1 {
    white-space: nowrap;
}

@keyframes subtleBounce {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
  100% {
    transform: translateY(0);
  }
}

.arrow-bounce {
  animation: subtleBounce 1.5s ease-in-out infinite;
}
</style>
