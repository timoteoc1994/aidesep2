<template>
    <div class="bg-[#FBF8F3] text-[#124228]">
    <section id="mapa" class="flex flex-col bg-[#FBF8F3] text-[#124228] max-w-6xl mx-auto px-4 py-8 ">

        <!-- Título y subtítulo -->
        <div class="text-left" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl font-bold">Mapa de la Amazonía Boliviana</h1>
            <p class="text-xl mt-2">{{ activeprovinciaInfo.detalle }}</p>
        </div>

        <!-- Flecha animada apuntando a la derecha -->
        <div ref="arrowSection" class="flex justify-end" v-show="showArrow" data-aos="zoom-in" data-aos-duration="1000">
            <div class="text-4xl mt-2 arrow-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#0D6734]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </div>
        </div>

        <!-- Scroll horizontal de provincias (drag para scroll) -->
        <div ref="scrollContainer" data-aos="fade-left" data-aos-duration="1000"
            class="overflow-x-auto w-full block cursor-grab select-none scrollbar-hide mt-4" @mousedown="startDrag"
            @mousemove="onDrag" @mouseup="stopDrag" @mouseleave="stopDrag">
            <div class="inline-flex gap-3 min-w-fit py-2 px-1">
                <button v-for="(name, code) in provinciasBolivia" :key="code" @click="selectCountry(code)"
                    class="whitespace-nowrap px-4 py-2 rounded-full border transition-all duration-300 hover:bg-[#AB8219] hover:text-white"
                    :class="{
                        'bg-[#AB8219] text-white font-semibold': selectedCountry === code,
                        'bg-white text-[#0D6734] border-[#0D6734] hover:border-[#AB8219]': selectedCountry !== code
                    }">
                    {{ name }}
                </button>
            </div>
        </div>

        <!-- Mapa + info -->
        <div class="flex flex-col md:flex-row items-center ">

            <!-- Mapa -->
            <div class="w-full md:w-3/4 flex justify-center items-center" data-aos="fade-right"
                data-aos-duration="1000">
                <div class="w-full max-w-5xl h-[500px] sm:h-[600px] md:h-[700px] lg:h-[800px]">
                    <svg viewBox="-150 350 900 50" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"
                        preserveAspectRatio="xMidYMid meet">
                        <g>
                            <path v-for="(path, code) in boliviaPaths" :key="code" :d="path"
                                :fill="getCountryColor(code)" stroke="white" stroke-width="0.5"
                                :fill-opacity="getFillOpacity(code)" @mouseover="hoverCountry(code)"
                                @mouseout="unhoverCountry" @click="handleCountryClick(code)"
                                class="cursor-pointer transition-all duration-300 ease-out"
                                :class="{ 'border-2 border-white': hoveredCountry === code || selectedCountry === code }" />
                        </g>
                    </svg>
                </div>
            </div>

            <!-- Datos a la derecha -->
            <div
                class="w-full md:w-1/4 flex flex-col justify-center items-center md:items-end space-y-10 text-center md:text-right">

                <!-- ENVOLTORIO DE TEXTO FIJO -->
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div class="h-[80px] flex items-end justify-center md:justify-end">
                        <div class="text-5xl font-bold text-[#AB8219] leading-tight text-balance">
                            {{ activeprovinciaInfo.nombre.toUpperCase() }}
                        </div>
                    </div>
                    <p class="text-[#0D6734] mt-2">Provincia</p>
                </div>

                <div data-aos="fade-up" data-aos-duration="1200">
                    <div class="text-5xl font-bold text-[#AB8219]">
                        {{ activeprovinciaInfo.poblacion.split(" ")[0] }}
                        <span class="ml-2 text-xl text-[#AB8219]">M</span>
                    </div>
                    <p class="text-[#0D6734] mt-2">Población</p>
                </div>

                <div v-if="activeprovinciaInfo.children" data-aos="fade-up" data-aos-duration="1400">
                    <div class="text-5xl font-bold text-[#AB8219] ">{{ activeprovinciaInfo.children }}</div>
                    <p class="text-[#0D6734] mt-2">niños de 5–17 años</p>
                </div>

                <div v-if="activeprovinciaInfo.hazardous" data-aos="fade-up" data-aos-duration="1600">
                    <div class="text-5xl font-bold text-[#AB8219]">{{ activeprovinciaInfo.hazardous }}</div>
                    <p class="mt-2 text-[#0D6734]">en situación peligrosa</p>
                </div>
            </div>

        </div>
    </section>
</div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'

import Swal from 'sweetalert2'
import { boliviaPaths } from './boliviaPaths_high.js'

// Detecta la visibilidad de la flecha cuando haya contenido para hacer scroll
const scrollContainer = ref(null)
const arrowSection = ref(null)
const showArrow = ref(false)

onMounted(() => {
    // Verifica si el contenido requiere hacer scroll horizontal
    checkScrollVisibility()

    // Revisa cuando el tamaño del contenedor cambie
    window.addEventListener('resize', checkScrollVisibility)
})

onBeforeUnmount(() => {
    // Elimina el evento de escucha para evitar fugas de memoria
    window.removeEventListener('resize', checkScrollVisibility)
})

// Función que verifica si el contenido necesita hacer scroll
const checkScrollVisibility = () => {
    if (scrollContainer.value) {
        const isScrollable = scrollContainer.value.scrollWidth > scrollContainer.value.clientWidth
        showArrow.value = isScrollable
    }
}

const isDragging = ref(false)
const startX = ref(0)
const scrollLeft = ref(0)

const startDrag = (e) => {
    isDragging.value = true
    scrollContainer.value.classList.add('scrolling')
    startX.value = e.pageX - scrollContainer.value.offsetLeft
    scrollLeft.value = scrollContainer.value.scrollLeft
}

const onDrag = (e) => {
    if (!isDragging.value) return
    e.preventDefault()
    const x = e.pageX - scrollContainer.value.offsetLeft
    const walk = (x - startX.value) * 1.5 // velocidad
    scrollContainer.value.scrollLeft = scrollLeft.value - walk
}

const stopDrag = () => {
    isDragging.value = false
    scrollContainer.value?.classList.remove('scrolling')
}

onBeforeUnmount(() => {
    stopDrag()
})

const provinciasBolivia = {
  ELB: "El Beni",
  PAN: "Pando",
  COC: "Cochabamba",
  LAP: "La Paz",
  CHU: "Chuquisaca",
  POT: "Potosí",
  ORU: "Oruro",
  SAN: "Santa Cruz",
  TAR: "Tarija"
};

// Departamentos que forman parte de la Amazonía boliviana
const amazonProvinces = [
  'ELB', // El Beni
  'PAN', // Pando
  'LAP', // Parte amazónica de La Paz
  'COC', // Parte norte de Cochabamba
  'SAN'  // Parte norte de Santa Cruz
];


const provinciaColors = Object.fromEntries(
    Object.keys(provinciasBolivia).map(code => [
        code, amazonProvinces.includes(code) ? '#0D6734' : '#D9D9D9' // Si es amazónica, color verde, si no, gris
    ])
)
const getCountryColor = (code) => {
    return provinciaColors[code] || '#cccccc'
}


const provinciaInfo = {
  PAN: {
    nombre: "Pando",
    detalle: "Departamento más al norte, con densa selva tropical y biodiversidad.",
    poblacion: "110,000",
    children: "30,000",
    hazardous: "8,000"
  },
  ELB: {
    nombre: "El Beni",
    detalle: "Gran parte del territorio del Departamento es amazónico, con extensas zonas de bosque tropical y sabanas.",
    poblacion: "420,000",
    children: "90,000",
    hazardous: "25,000"
  },
  LAP: {
    nombre: "La Paz",
    detalle: "Las provincias de Franz Tamayo y Abel Iturralde, ubicadas al norte del Departamento, tienen región amazónica.",
    poblacion: "50,000",
    children: "12,000",
    hazardous: "3,000"
  },
  SAN: {
    nombre: "Santa Cruz",
    detalle: "Las provincias de José Miguel de Velasco, Guarayos y Ichilo, ubicadas al norte del Departamento, tienen región amazónica.",
    poblacion: "80,000",
    children: "20,000",
    hazardous: "5,000"
  },
  COC: {
    nombre: "Cochabamba",
    detalle: "Departamento del centro del país con zonas altas y parte norte amazónica.",
    poblacion: "1,900,000",
    children: "450,000",
    hazardous: "60,000"
  },
  CHU: {
    nombre: "Chuquisaca",
    detalle: "Ubicado al sur de Bolivia, con capital Sucre. No tiene territorio amazónico.",
    poblacion: "646,000",
    children: "150,000",
    hazardous: "35,000"
  },
  POT: {
    nombre: "Potosí",
    detalle: "Departamento minero del suroeste, con importantes centros históricos. No es amazónico.",
    poblacion: "881,000",
    children: "210,000",
    hazardous: "50,000"
  },
  ORU: {
    nombre: "Oruro",
    detalle: "Departamento del altiplano boliviano, centro cultural del carnaval de Oruro.",
    poblacion: "494,000",
    children: "120,000",
    hazardous: "28,000"
  },
  TAR: {
    nombre: "Tarija",
    detalle: "Ubicado al sur, fronterizo con Argentina, conocido por su producción vitivinícola.",
    poblacion: "583,000",
    children: "145,000",
    hazardous: "33,000"
  }
};


const selectedCountry = ref('ELB')
const hoveredCountry = ref(null)

const activeprovinciaInfo = computed(() => {
    const active = hoveredCountry.value || selectedCountry.value
    return provinciaInfo[active] || {
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
    if (boliviaPaths[code]) {
        hoveredCountry.value = code
    }
}

const unhoverCountry = () => {
    hoveredCountry.value = null
}

const handleCountryClick = (code) => {
    if (!amazonProvinces.includes(code)) {
        return;
    }
    // Redirigir a emprendimientos de la provincia
    inertiaRouter.visit(`/emprendimientosProvinciaBolivia/${code}`);
};


const resetMap = () => {
    hoveredCountry.value = null
    selectedCountry.value = 'ECA'
}

const getFillOpacity = (code) => {
    if (hoveredCountry.value === code) return 0.9
    if (selectedCountry.value === code) return 0.8
    if (provinciasBolivia[code]) return 0.6
    return 0.4
}
</script>

<style scoped>
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

path {
    transition: all 0.3s ease;
}

path:hover {
    fill-opacity: 0.8;
}

.scrolling {
    cursor: grabbing;
}

/* Flecha animada más sutil */
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
