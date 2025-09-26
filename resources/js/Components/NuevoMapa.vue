<template>
    <section id="mapa" class="flex flex-col bg-white text-emerald-400 max-w-6xl mx-auto">
        <!-- Primera fila: Título y subtítulo -->
        <div class="w-full p-8 text-left">
            <h1 class="text-6xl font-bold mb-2 transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)]">
                {{ activeprovinciaInfo.nombre.toUpperCase() }}
            </h1>
            <p class="text-emerald-400 text-xl transition-opacity duration-500 ease-in-out">
                {{ activeprovinciaInfo.detalle }}
            </p>
        </div>

        <!-- Segunda fila: 3 columnas -->
        <div class="flex flex-col md:flex-row w-full ">
            <!-- Columna izquierda: Listado de provincias -->
            <div class="w-full md:w-1/4 p-4 md:p-8 ">
                <!-- Mobile: scroll horizontal -->
                <div class="block md:hidden mb-5 overflow-x-auto scrollbar-hide">
                    <div class="flex gap-3 w-max">
                        <button v-for="(name, code) in provinciasEcuador" :key="code" @click="selectCountry(code)"
                            class="whitespace-nowrap px-4 py-2 rounded-full border transition-all duration-300" :class="{
                                'bg-emerald-400 text-white font-semibold': selectedCountry === code,
                                'bg-white text-emerald-400 border-emerald-300': selectedCountry !== code
                            }">
                            {{ name }}
                        </button>
                    </div>
                </div>


                <!-- Desktop: lista vertical -->
                <nav class="hidden md:block top-0">
                    <ul class="space-y-3">
                        <li v-for="(name, code) in provinciasEcuador" :key="code">
                            <button @click="selectCountry(code)"
                                class="relative inline-flex items-center justify-start overflow-hidden py-1 px-2 rounded-md transition-all duration-300 ease-out group"
                                :class="{
                                    'text-white font-bold': selectedCountry === code,
                                    'text-emerald-400 hover:text-white': selectedCountry !== code
                                }">

                                <!-- Solo el texto, sin ocupar todo el ancho -->
                                <span class="relative z-10">{{ name }}</span>

                                <!-- Fondo del hover limitado al tamaño del texto -->
                                <span
                                    class="absolute left-0 top-0 w-full h-full bg-emerald-400 opacity-0 group-hover:opacity-100 rounded-md transition-all duration-300 ease-out"
                                    :class="{ 'opacity-100': selectedCountry === code }"
                                    style="width: 100%; height: 100%; z-index: 0;"></span>

                            </button>
                        </li>
                    </ul>
                </nav>

            </div>

            <!-- Columna central: Mapa (la más ancha) -->
            <div class="w-full md:w-2/4 flex items-center justify-center p-4 ">
                <div class="w-full h-[500px] sm:h-[600px] md:h-[700px] lg:h-[800px]">
                    <svg viewBox="500 100 300 100" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"
                        preserveAspectRatio="xMidYMid meet">
                        <g>
                            <path v-for="(path, code) in ecuadorPaths" :key="code" :d="path"
                                :fill="getCountryColor(code)" stroke="#0C2924" stroke-width="1"
                                :fill-opacity="getFillOpacity(code)" @mouseover="hoverCountry(code)"
                                @mouseout="unhoverCountry" @click="handleCountryClick(code)"
                                class="cursor-pointer transition-all duration-300 ease-out" :class="{
                                    'border-2 border-white': hoveredCountry === code || selectedCountry === code,
                                }" />
                        </g>
                    </svg>
                </div>
            </div>

            <!-- Columna derecha: Datos -->
            <div class="w-full md:w-1/4 p-4 md:p-8 flex flex-col justify-center ">
                <div class="space-y-8">
                    <div>
                        <div class="text-5xl font-bold transition-all duration-500 ease-out">
                            {{ activeprovinciaInfo.poblacion.split(" ")[0] }}
                            <span class="ml-2 text-xl transition-all duration-300">M</span>
                        </div>
                        <p class="text-emerald-400 mt-2 transition-colors duration-500">Población</p>
                    </div>

                    <div v-if="activeprovinciaInfo.children" class="transition-all duration-500">
                        <div class="text-5xl font-bold">{{ activeprovinciaInfo.children || 'S/R' }}</div>
                        <p class="text-emerald-400 mt-2">niños de 5–17 años</p>
                    </div>

                    <div v-if="activeprovinciaInfo.hazardous" class="transition-all duration-500">
                        <div class="text-5xl font-bold">{{ activeprovinciaInfo.hazardous }}</div>
                        <p class="text-emerald-400 mt-2">en situación peligrosa</p>
                    </div>
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

const provinciasEcuador = {
    ECA: "Azuay",
    ECB: "Bolívar",
    ECC: "Cañar",
    ECD: "Carchi",
    ECE: "Chimborazo",
    ECF: "Cotopaxi",
    ECG: "El Oro",
    ECH: "Esmeraldas",
    ECI: "Galápagos",
    ECJ: "Guayas",
    ECK: "Imbabura",
    ECL: "Loja",
    ECM: "Los Ríos",
    ECN: "Manabí",
    ECO: "Morona Santiago",
    ECP: "Napo",
    ECQ: "Orellana",
    ECR: "Pastaza",
    ECS: "Pichincha",
    ECSD: "Santa Elena",
    ECSE: "Santo Domingo",
    ECT: "Sucumbíos",
    ECU: "Tungurahua",
    ECV: "Zamora Chinchipe",
    ECW: "Francisco de Orellana",
    ECX: "Guaranda",
    ECY: "La Concordia",
    ECZ: "Zaruma"
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
    ECC: {
        nombre: "Cañar",
        detalle: "Provincia de la sierra sur, su capital es Azogues.",
        poblacion: "276,145",
        children: "70K",
        hazardous: "15K"
    },
    ECD: {
        nombre: "Carchi",
        detalle: "Provincia fronteriza con Colombia, capital Tulcán.",
        poblacion: "183,653",
        children: "48K",
        hazardous: "10K"
    },
    ECE: {
        nombre: "Chimborazo",
        detalle: "Provincia andina, famosa por el volcán Chimborazo.",
        poblacion: "524,563",
        children: "130K",
        hazardous: "29K"
    },
    ECF: {
        nombre: "Cotopaxi",
        detalle: "Ubicada en la Sierra Central, capital Latacunga.",
        poblacion: "510,683",
        children: "128K",
        hazardous: "27K"
    },
    ECG: {
        nombre: "El Oro",
        detalle: "Provincia costera con fuerte actividad minera y bananera.",
        poblacion: "742,000",
        children: "190K",
        hazardous: "43K"
    },
    ECH: {
        nombre: "Esmeraldas",
        detalle: "Provincia costera con diversidad cultural, capital Esmeraldas.",
        poblacion: "639,000",
        children: "165K",
        hazardous: "40K"
    },
    ECI: {
        nombre: "Galápagos",
        detalle: "Archipiélago insular, patrimonio natural de la humanidad.",
        poblacion: "33,042",
        children: "8K",
        hazardous: "1.5K"
    },
    ECJ: {
        nombre: "Guayas",
        detalle: "Provincia más poblada del país, capital Guayaquil.",
        poblacion: "4,386,000",
        children: "1.05M",
        hazardous: "230K"
    },
    ECK: {
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
    ECM: {
        nombre: "Los Ríos",
        detalle: "Provincia agrícola con capital Babahoyo.",
        poblacion: "896,000",
        children: "226K",
        hazardous: "52K"
    },
    ECN: {
        nombre: "Manabí",
        detalle: "Provincia costera afectada por el terremoto de 2016.",
        poblacion: "1,602,000",
        children: "405K",
        hazardous: "95K"
    },
    ECO: {
        nombre: "Morona Santiago",
        detalle: "Provincia amazónica, rica en biodiversidad.",
        poblacion: "196,500",
        children: "48K",
        hazardous: "11K"
    },
    ECP: {
        nombre: "Napo",
        detalle: "Provincia amazónica con capital Tena.",
        poblacion: "139,000",
        children: "35K",
        hazardous: "8K"
    },
    ECQ: {
        nombre: "Orellana",
        detalle: "Provincia amazónica con explotación petrolera.",
        poblacion: "162,000",
        children: "40K",
        hazardous: "9K"
    },
    ECR: {
        nombre: "Pastaza",
        detalle: "Provincia amazónica, capital Puyo.",
        poblacion: "114,000",
        children: "29K",
        hazardous: "6K"
    },
    ECS: {
        nombre: "Pichincha",
        detalle: "Provincia donde se encuentra la capital del país, Quito.",
        poblacion: "3,228,000",
        children: "805K",
        hazardous: "180K"
    },
    ECSD: {
        nombre: "Santa Elena",
        detalle: "Provincia costera con playas turísticas.",
        poblacion: "401,000",
        children: "100K",
        hazardous: "23K"
    },
    ECSE: {
        nombre: "Santo Domingo de los Tsáchilas",
        detalle: "Provincia joven y productiva, con fuerte crecimiento urbano.",
        poblacion: "500,000",
        children: "125K",
        hazardous: "29K"
    },
    ECT: {
        nombre: "Sucumbíos",
        detalle: "Provincia fronteriza al noreste, capital Nueva Loja.",
        poblacion: "240,000",
        children: "60K",
        hazardous: "13K"
    },
    ECU: {
        nombre: "Tungurahua",
        detalle: "Provincia andina, capital Ambato.",
        poblacion: "614,000",
        children: "154K",
        hazardous: "35K"
    },
    ECV: {
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
    ECX: {
        nombre: "Guaranda",
        detalle: "Nombre alternativo para la provincia Bolívar (duplicado, puede omitirse).",
        poblacion: "183,641",
        children: "45K",
        hazardous: "9K"
    },
    ECY: {
        nombre: "La Concordia",
        detalle: "Zona disputada entre Esmeraldas y Santo Domingo, ahora cantón.",
        poblacion: "42,000",
        children: "11K",
        hazardous: "2.5K"
    },
    ECZ: {
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
/* Aplicando el borde solo en hover */
path {
    transition: all 0.3s ease;
}

path:hover {
    /* Esto solo agrega el borde sin cambiar el tamaño del país */
    fill-opacity: 0.8;
}
</style>
