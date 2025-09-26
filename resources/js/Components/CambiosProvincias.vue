<template>
    <section id="mapa" class="flex flex-col bg-white text-emerald-400 max-w-6xl mx-auto px-4 py-8 space-y-12">

        <!-- Título y subtítulo -->
        <div class="text-left">
            <h1 class="text-5xl font-bold">{{ activeprovinciaInfo.nombre.toUpperCase() }}</h1>
            <p class="text-xl mt-2">{{ activeprovinciaInfo.detalle }}</p>
        </div>

        <!-- Scroll horizontal de provincias -->

        <!-- Scroll horizontal de provincias (drag para scroll) -->
        <div ref="scrollContainer" class="overflow-x-auto w-full block cursor-grab select-none scrollbar-hide"
            @mousedown="startDrag" @mousemove="onDrag" @mouseup="stopDrag" @mouseleave="stopDrag">
            <div class="inline-flex gap-3 min-w-fit py-2 px-1">
                <button v-for="(name, code) in provinciasEcuador" :key="code" @click="selectCountry(code)"
                    class="whitespace-nowrap px-4 py-2 rounded-full border transition-all duration-300 hover:bg-emerald-400 hover:text-white" :class="{
                        'bg-emerald-400 text-white font-semibold': selectedCountry === code,
                        'bg-white text-emerald-400 border-emerald-300': selectedCountry !== code
                    }">
                    {{ name }}
                </button>
            </div>
        </div>




        <!-- Mapa + info -->
        <div class="flex flex-col md:flex-row gap-8 items-center ">

            <!-- Mapa -->
            <div class="w-full md:w-3/4 flex justify-center items-center">
                <div class="w-full max-w-5xl h-[500px] sm:h-[600px] md:h-[700px] lg:h-[800px]">
                    <svg viewBox="500 100 350 100" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"
                        preserveAspectRatio="xMidYMid meet">
                        <g>
                            <path v-for="(path, code) in ecuadorPaths" :key="code" :d="path"
                                :fill="getCountryColor(code)" stroke="#0C2924" stroke-width="1"
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
                <div>
                    <div class="text-5xl font-bold">
                        {{ activeprovinciaInfo.poblacion.split(" ")[0] }}
                        <span class="ml-2 text-xl">M</span>
                    </div>
                    <p class="text-emerald-400 mt-2">Población</p>
                </div>

                <div v-if="activeprovinciaInfo.children">
                    <div class="text-5xl font-bold">{{ activeprovinciaInfo.children }}</div>
                    <p class="text-emerald-400 mt-2">niños de 5–17 años</p>
                </div>

                <div v-if="activeprovinciaInfo.hazardous">
                    <div class="text-5xl font-bold">{{ activeprovinciaInfo.hazardous }}</div>
                    <p class="text-emerald-400 mt-2">en situación peligrosa</p>
                </div>
            </div>

        </div>
    </section>
</template>


<script setup>
import { ref, computed } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'
import { ecuadorPaths } from '@/Components/ecuadorPaths_high'

import Swal from 'sweetalert2'

import { onMounted, onBeforeUnmount } from 'vue'

const scrollContainer = ref(null)
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


const provinciasEcuador = {
    ECA: "Azuay",
    ECB: "Bolívar",
    ECF: "Cañar",
    ECC: "Carchi",
    ECH: "Chimborazo",
    ECX: "Cotopaxi",
    ECO: "El Oro",
    ECE: "Esmeraldas",
    ECK: "Galápagos",
    ECG: "Guayas",
    ECI: "Imbabura",
    ECL: "Loja",
    ECR: "Los Ríos",
    ECM: "Manabí",
    ECS: "Morona Santiago",
    ECN: "Napo",
    ECD: "Orellana",
    ECY: "Pastaza",
    ECP: "Pichincha",
    ECSE: "Santa Elena",
    ECSD: "Santo Domingo",
    ECU: "Sucumbíos",
    ECT: "Tungurahua",
    ECZ: "Zamora Chinchipe",
    ECW: "Francisco de Orellana",
    ECQ: "Guaranda",
    ECJ: "La Concordia",
    ECV: "Zaruma"
}


const amazonCountryColors = {
    ECA: "#1D4B44",
    PE: "#2A685F",
    CO: "#378476",
    VE: "#439F8C",
    EC: "#64B29F",
    BO: "#85C4B2",
    GY: "#A7D7C5",
    SR: "#C8E9D7",
    GF: "#E0F5EB",
}

const provinciaColors = Object.fromEntries(
    Object.keys(provinciasEcuador).map(code => [code, '#64B29F'])
)

const getCountryColor = (code) => {
    return provinciaColors[code] || '#cccccc'
}


const provinciaInfo = {
    ECA: {
        nombre: "Azuay",
        detalle: "Provincia andina ubicada en el sur del país, capital Cuenca.",
        poblacion: "881,394",
        children: "220K",
        hazardous: "45K"
    },
    ECB: {
        nombre: "Bolívar",
        detalle: "Ubicada en el centro del Ecuador, su capital es Guaranda.",
        poblacion: "183,641",
        children: "45K",
        hazardous: "9K"
    },
    ECF: {
        nombre: "Cañar",
        detalle: "Provincia de la sierra sur, su capital es Azogues.",
        poblacion: "276,145",
        children: "70K",
        hazardous: "15K"
    },
    ECC: {
        nombre: "Carchi",
        detalle: "Provincia fronteriza con Colombia, capital Tulcán.",
        poblacion: "183,653",
        children: "48K",
        hazardous: "10K"
    },
    ECH: {
        nombre: "Chimborazo",
        detalle: "Provincia andina, famosa por el volcán Chimborazo.",
        poblacion: "524,563",
        children: "130K",
        hazardous: "29K"
    },
    ECX: {
        nombre: "Cotopaxi",
        detalle: "Ubicada en la Sierra Central, capital Latacunga.",
        poblacion: "510,683",
        children: "128K",
        hazardous: "27K"
    },
    ECO: {
        nombre: "El Oro",
        detalle: "Provincia costera con fuerte actividad minera y bananera.",
        poblacion: "742,000",
        children: "190K",
        hazardous: "43K"
    },
    ECE: {
        nombre: "Esmeraldas",
        detalle: "Provincia costera con diversidad cultural, capital Esmeraldas.",
        poblacion: "639,000",
        children: "165K",
        hazardous: "40K"
    },
    ECK: {
        nombre: "Galápagos",
        detalle: "Archipiélago insular, patrimonio natural de la humanidad.",
        poblacion: "33,042",
        children: "8K",
        hazardous: "1.5K"
    },
    ECG: {
        nombre: "Guayas",
        detalle: "Provincia más poblada del país, capital Guayaquil.",
        poblacion: "4,386,000",
        children: "1.05M",
        hazardous: "230K"
    },
    ECI: {
        nombre: "Imbabura",
        detalle: "Provincia de lagos y volcanes, capital Ibarra.",
        poblacion: "495,000",
        children: "124K",
        hazardous: "27K"
    },
    ECL: {
        nombre: "Loja",
        detalle: "Provincia del sur andino, reconocida por su cultura.",
        poblacion: "510,000",
        children: "125K",
        hazardous: "28K"
    },
     ECR: {
        nombre: "Los Ríos",
        detalle: "Provincia agrícola con capital Babahoyo.",
        poblacion: "896,000",
        children: "226K",
        hazardous: "52K"
    },
    ECM: {
        nombre: "Manabí",
        detalle: "Provincia costera afectada por el terremoto de 2016.",
        poblacion: "1,602,000",
        children: "405K",
        hazardous: "95K"
    },
    ECS: {
        nombre: "Morona Santiago",
        detalle: "Provincia amazónica, rica en biodiversidad.",
        poblacion: "196,500",
        children: "48K",
        hazardous: "11K"
    },
    ECN: {
        nombre: "Napo",
        detalle: "Provincia amazónica con capital Tena.",
        poblacion: "139,000",
        children: "35K",
        hazardous: "8K"
    },
    ECD: {
        nombre: "Orellana",
        detalle: "Provincia amazónica con explotación petrolera.",
        poblacion: "162,000",
        children: "40K",
        hazardous: "9K"
    },
    ECY: {
        nombre: "Pastaza",
        detalle: "Provincia amazónica, capital Puyo.",
        poblacion: "114,000",
        children: "29K",
        hazardous: "6K"
    },
    ECP: {
        nombre: "Pichincha",
        detalle: "Provincia donde se encuentra la capital del país, Quito.",
        poblacion: "3,228,000",
        children: "805K",
        hazardous: "180K"
    },
    ECSE: {
        nombre: "Santa Elena",
        detalle: "Provincia costera con playas turísticas.",
        poblacion: "401,000",
        children: "100K",
        hazardous: "23K"
    },
    ECSD: {
        nombre: "Santo Domingo de los Tsáchilas",
        detalle: "Provincia joven y productiva, con fuerte crecimiento urbano.",
        poblacion: "500,000",
        children: "125K",
        hazardous: "29K"
    },
     ECU: {
        nombre: "Sucumbíos",
        detalle: "Provincia fronteriza al noreste, capital Nueva Loja.",
        poblacion: "240,000",
        children: "60K",
        hazardous: "13K"
    },
    ECT: {
        nombre: "Tungurahua",
        detalle: "Provincia andina, capital Ambato.",
        poblacion: "614,000",
        children: "154K",
        hazardous: "35K"
    },
    ECZ: {
        nombre: "Zamora Chinchipe",
        detalle: "Provincia amazónica y minera en el sur del país.",
        poblacion: "123,000",
        children: "31K",
        hazardous: "7K"
    },
    ECW: {
        nombre: "Francisco de Orellana",
        detalle: "Región con fuerte presencia petrolera y biodiversidad.",
        poblacion: "147,000",
        children: "37K",
        hazardous: "8K"
    },
    ECQ: {
        nombre: "Guaranda",
        detalle: "Nombre alternativo para la provincia Bolívar (duplicado, puede omitirse).",
        poblacion: "183,641",
        children: "45K",
        hazardous: "9K"
    },
    ECJ: {
        nombre: "La Concordia",
        detalle: "Zona disputada entre Esmeraldas y Santo Domingo, ahora cantón.",
        poblacion: "42,000",
        children: "11K",
        hazardous: "2.5K"
    },
    ECV: {
        nombre: "Zaruma",
        detalle: "Ciudad patrimonial de El Oro, usualmente no considerada provincia separada.",
        poblacion: "27,000",
        children: "7K",
        hazardous: "1.5K"
    }
};


const selectedCountry = ref('ECA')
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
    if (ecuadorPaths[code]) {
        hoveredCountry.value = code
    }
}

const unhoverCountry = () => {
    hoveredCountry.value = null
}

const handleCountryClick = (code) => {
    if (!provinciasEcuador[code]) return // Desactiva por completo

    if (code === 'EC') {
        inertiaRouter.visit('/conAmazonia')
    } else {
        inertiaRouter.visit(`/pais/${code}`)
    }
}




const resetMap = () => {
    hoveredCountry.value = null
    selectedCountry.value = 'ECA'
}

const getFillOpacity = (code) => {
    if (hoveredCountry.value === code) return 0.9
    if (selectedCountry.value === code) return 0.8
    if (provinciasEcuador[code]) return 0.6
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
</style>
