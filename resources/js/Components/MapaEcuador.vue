<template class="py-20 bg-gradient-to-b from-[#f7f8e5] to-[#f7f8e5]">
    <section id="mapa" class="flex flex-col bg-white text-[#005120] max-w-6xl mx-auto px-4 py-8 ">

        <!-- Título y subtítulo -->
        <div class="text-left" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl font-bold">Mapa de la Amazonia Peruana</h1>
            <p class="text-xl mt-2">{{ activeDepartamentoInfo.detalle }}</p>
        </div>

       
        <!-- Mapa + info -->
        <div class="flex flex-col md:flex-row items-center ">

            <!-- Mapa -->
            <div class="w-full md:w-3/4 flex justify-center items-center" data-aos="fade-right"
                data-aos-duration="1000">
                <div class="w-full max-w-5xl h-[500px] sm:h-[600px] md:h-[700px] lg:h-[800px]">
                    <svg ref="svgEl" viewBox="100 0 500 500" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"
                        preserveAspectRatio="xMidYMid meet">
                        <g>
                            <path v-for="(path, code) in peruPaths" :key="code" :d="path" :data-code="code"
                                :fill="getCountryColor(code)" stroke="white" stroke-width="0.5"
                                :fill-opacity="getFillOpacity(code)" @mouseover="hoverCountry(code)"
                                @mouseout="unhoverCountry" @click="handleCountryClick(code)"
                                class="cursor-pointer transition-all duration-300 ease-out"
                                :class="{ 'border-2 border-white': hoveredCountry === code || selectedCountry === code }" />
                        </g>

                        <!-- Labels dinámicos colocados en el centro del bbox de cada path -->
                        <g>
                            <text v-for="(name, code) in departamentosPeru" :key="'label-'+code"
                                :x="(labelPositions[code]?.x || 0) + (labelOffsets[code]?.x || 0)"
                                :y="(labelPositions[code]?.y || 0) + (labelOffsets[code]?.y || 0)"
                                text-anchor="middle"
                                :fill="getLabelTextColor(code)"
                                :style="{ fontSize: (labelPositions[code]?.fontSize || 12) + 'px', fontWeight: 600, pointerEvents: 'none' }">
                                {{ name }}
                            </text>
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
                        <div class="text-5xl font-bold text-[#005120] leading-tight text-balance">
                            {{ activeDepartamentoInfo.nombre.toUpperCase() }}
                        </div>
                    </div>
                    <p class="text-[#005120] mt-2">Departamento</p>
                </div>

                <div data-aos="fade-up" data-aos-duration="1200">
                    <div class="text-5xl font-bold text-[#005120]">
                        {{ activeDepartamentoInfo.poblacion.split(" ")[0] }}
                        <span class="ml-2 text-xl text-[#005120]">M</span>
                    </div>
                    <p class="text-[#005120] mt-2">Población</p>
                </div>

                <div v-if="activeDepartamentoInfo.children" data-aos="fade-up" data-aos-duration="1400">
                    <div class="text-5xl font-bold text-[#005120] ">{{ activeDepartamentoInfo.children }}</div>
                    <p class="text-[#005120] mt-2">niños de 5–17 años</p>
                </div>

                <div v-if="activeDepartamentoInfo.hazardous" data-aos="fade-up" data-aos-duration="1600">
                    <div class="text-5xl font-bold text-[#005120]">{{ activeDepartamentoInfo.hazardous }}</div>
                    <p class="mt-2 text-[#005120]">en situación peligrosa</p>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, reactive, nextTick } from 'vue'
import { router as inertiaRouter } from '@inertiajs/vue3'
import { peruPaths } from '@/Components/peruPaths_high'

import Swal from 'sweetalert2'

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

const departamentosPeru = {
    // Mapeo correcto basado en el SVG original con etiquetas de texto
    LOR: "Loreto",        // st1 - tiene texto "Loreto"
    UCY: "Ucayali",       // st2 - tiene texto "Ucayali"  
    AMZ: "Amazonas",      // st5 - tiene texto "Amazonas"
    SMA: "San Martín",    // st6 - tiene texto "San Martín"
    MDD: "Madre de Dios", // st4 - tiene texto "Madre de Dios"
    JUN: "Junín",         // st7 - tiene texto "Junín"
    PAS: "Pasco",         // st8 - tiene texto "Pasco"
    HUC: "Huánuco",       // st10 - tiene texto "Huánuco"
    
    // Costa Norte
    PIU: "Piura",         // st13 - tiene texto "Piura"
    LAM: "Lambayeque",    // st14 - tiene texto "Lambayeque"
    TUM: "Tumbes",        // st17 - tiene texto "Tumbes"
    CAJ: "Cajamarca",     // st22 - tiene texto "Cajamarca"
    LL: "La Libertad",    // st11 - tiene texto "La Libertad"
    
    // Costa Centro
    ANC: "Áncash",        // st12 - tiene texto "Ancash"
    LIMA: "Lima",         // st9 - tiene texto "Lima"
    ICA: "Ica",           // st16 - tiene texto "Ica"
    HVA: "Huancavelica",  // st18 - tiene texto "Huancavelica"
    
    // Costa Sur
    ARE: "Arequipa",      // st19 - tiene texto "Arequipa"
    MOQ: "Moquegua",      // st20 - tiene texto "Moquegua"
    TAC: "Tacna",         // st21 - tiene texto "Tacna"
    
    // Sierra
    CAH: "Cajamarca",     // Duplicado
    HUA: "Huancavelica",  // st23 - duplicado de Huancavelica
    CUS: "Cusco",         // st24 - tiene texto "Cusco"
    APU: "Apurímac",      // st25 - tiene texto "Apurímac"
    AYA: "Ayacucho",      // st26 - tiene texto "Ayacucho"
    PUN: "Puno"           // st3 - tiene texto "Puno"
}

const amazonDepartamentos = ['LOR', 'UCY', 'AMZ', 'SMA', 'MDD', 'JUN', 'PAS', 'HUC']

// Colores por defecto (verde para Amazonía, gris para el resto)
const defaultDepartamentoColors = Object.fromEntries(
    Object.keys(departamentosPeru).map(code => [
        code, amazonDepartamentos.includes(code) ? '#005120' : '#D9D9D9'
    ])
)

// Colores personalizados (overrides). Edita aquí para definir el color exacto
// de cada departamento. Usa el código (p.ej. 'LOR', 'JUN', 'PUN') como clave.
const departmentCustomColors = {
    // Ejemplo: asignar colores específicos inspirados en la imagen
    LOR: '#d14d78', // Loreto (rosa de ejemplo)
    UCY: '#2fb4de', // Ucayali (celeste)
    AMZ: '#94c973', // Amazonas (verde claro)
    JUN: '#005120', // Junín (verde principal)
    MDD: '#d9f25a', // Madre de Dios (amarillo verdoso)
    PUN: '#2fb4de'  // Puno (misma familia de celeste)
}

const getCountryColor = (code) => {
    if (departmentCustomColors[code]) return departmentCustomColors[code]
    if (defaultDepartamentoColors[code]) return defaultDepartamentoColors[code]
    return '#cccccc'
}

// --- Etiquetas dinámicas ---
const svgEl = ref(null)
const labelPositions = reactive({})

// Ajustes manuales por departamento si la etiqueta queda mal posicionada
const labelOffsets = {
    // Ejemplo: 'LOR': { x: 10, y: -5 }
}

const computeLabelPositions = async () => {
    await nextTick()
    if (!svgEl.value) return
    const svg = svgEl.value
    const paths = svg.querySelectorAll('path[data-code]')

    // Paso 1: cálculo inicial (centro del bbox)
    paths.forEach(p => {
        const code = p.getAttribute('data-code')
        try {
            const bb = p.getBBox()
            const cx = bb.x + bb.width / 2
            const cy = bb.y + bb.height / 2
            const fontSize = Math.max(10, Math.min(18, Math.round(bb.width / 8)))
            // y se desplaza un poco hacia abajo para centrar visualmente respecto al texto
            labelPositions[code] = { x: cx, y: cy + fontSize / 3, w: bb.width, h: bb.height, fontSize }
        } catch (e) {
            // Ignorar errores en getBBox
        }
    })

    // Paso 2: relajación para evitar solapamientos
    const codes = Object.keys(labelPositions)
    const maxIter = 12
    const damping = 0.6

    for (let iter = 0; iter < maxIter; iter++) {
        let moved = false
        for (let i = 0; i < codes.length; i++) {
            for (let j = i + 1; j < codes.length; j++) {
                const a = labelPositions[codes[i]]
                const b = labelPositions[codes[j]]
                if (!a || !b) continue

                // Estimación del radio mínimo según anchura del texto
                const ra = Math.max(10, a.w / 6)
                const rb = Math.max(10, b.w / 6)
                const minDist = ra + rb

                let dx = a.x - b.x
                let dy = a.y - b.y
                let dist = Math.sqrt(dx * dx + dy * dy)
                if (dist === 0) {
                    dx = (Math.random() - 0.5) * 0.1 + 0.1
                    dy = (Math.random() - 0.5) * 0.1 + 0.1
                    dist = Math.sqrt(dx * dx + dy * dy)
                }

                if (dist < minDist) {
                    moved = true
                    const overlap = (minDist - dist)
                    const ux = dx / dist
                    const uy = dy / dist
                    const shift = overlap * 0.5 * damping
                    // desplazar ambos en direcciones opuestas
                    a.x = a.x + ux * shift
                    a.y = a.y + uy * shift
                    b.x = b.x - ux * shift
                    b.y = b.y - uy * shift
                }
            }
        }
        if (!moved) break
    }

    // Aplicar offsets manuales si existen (se usan en template también)
    Object.keys(labelOffsets).forEach(code => {
        if (labelPositions[code]) {
            labelPositions[code].x += (labelOffsets[code].x || 0)
            labelPositions[code].y += (labelOffsets[code].y || 0)
        }
    })
}

// Recalcular posiciones al montar y al redimensionar
onMounted(() => {
    computeLabelPositions()
    window.addEventListener('resize', computeLabelPositions)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', computeLabelPositions)
})

const departamentoInfo = {
    // Mapeo correcto según el SVG original
    LOR: {
        nombre: "Loreto",
        detalle: "Departamento amazónico más grande del Perú. Capital: Iquitos.",
        poblacion: "1,025,000",
        children: "300K",
        hazardous: "50K"
    },
    UCY: {
        nombre: "Ucayali",
        detalle: "Departamento amazónico central. Capital: Pucallpa.",
        poblacion: "540,000",
        children: "160K",
        hazardous: "25K"
    },
    AMZ: {
        nombre: "Amazonas",
        detalle: "Departamento amazónico del norte. Capital: Chachapoyas.",
        poblacion: "420,000",
        children: "125K",
        hazardous: "20K"
    },
    SMA: {
        nombre: "San Martín",
        detalle: "Departamento amazónico de la selva alta. Capital: Moyobamba.",
        poblacion: "850,000",
        children: "255K",
        hazardous: "40K"
    },
    MDD: {
        nombre: "Madre de Dios",
        detalle: "Departamento amazónico del sudeste. Capital: Puerto Maldonado.",
        poblacion: "140,000",
        children: "42K",
        hazardous: "7K"
    },
    JUN: {
        nombre: "Junín",
        detalle: "Departamento de la sierra central con región amazónica. Capital: Huancayo.",
        poblacion: "1,350,000",
        children: "405K",
        hazardous: "68K"
    },
    PAS: {
        nombre: "Pasco",
        detalle: "Departamento de la sierra central. Capital: Cerro de Pasco.",
        poblacion: "280,000",
        children: "84K",
        hazardous: "14K"
    },
    HUC: {
        nombre: "Huánuco",
        detalle: "Departamento de la sierra central con región amazónica. Capital: Huánuco.",
        poblacion: "850,000",
        children: "255K",
        hazardous: "43K"
    },
    
    // Región Costa
    PIU: {
        nombre: "Piura",
        detalle: "Departamento costero del norte. Capital: Piura.",
        poblacion: "1,860,000",
        children: "558K",
        hazardous: "93K"
    },
    LAM: {
        nombre: "Lambayeque", 
        detalle: "Departamento costero del norte. Capital: Chiclayo.",
        poblacion: "1,280,000",
        children: "384K",
        hazardous: "64K"
    },
    TUM: {
        nombre: "Tumbes",
        detalle: "Departamento costero fronterizo con Ecuador. Capital: Tumbes.",
        poblacion: "240,000",
        children: "72K",
        hazardous: "12K"
    },
    CAJ: {
        nombre: "Cajamarca",
        detalle: "Departamento de la sierra norte. Capital: Cajamarca.",
        poblacion: "1,530,000",
        children: "459K",
        hazardous: "77K"
    },
    LL: {
        nombre: "La Libertad",
        detalle: "Departamento costero del norte. Capital: Trujillo.",
        poblacion: "1,905,000",
        children: "571K",
        hazardous: "95K"
    },
    ANC: {
        nombre: "Áncash",
        detalle: "Departamento de la sierra y costa central. Capital: Huaraz.",
        poblacion: "1,150,000",
        children: "345K",
        hazardous: "58K"
    },
    LIMA: {
        nombre: "Lima",
        detalle: "Departamento costero central, incluye Lima Metropolitana. Capital: Lima.",
        poblacion: "10,628,000",
        children: "3,188K",
        hazardous: "531K"
    },
    ICA: {
        nombre: "Ica",
        detalle: "Departamento costero del sur. Capital: Ica.",
        poblacion: "850,000",
        children: "255K",
        hazardous: "43K"
    },
    HVA: {
        nombre: "Huancavelica",
        detalle: "Departamento de la sierra central. Capital: Huancavelica.",
        poblacion: "480,000",
        children: "144K",
        hazardous: "24K"
    },
    ARE: {
        nombre: "Arequipa",
        detalle: "Departamento del sur, región costera y sierra. Capital: Arequipa.",
        poblacion: "1,380,000",
        children: "414K",
        hazardous: "69K"
    },
    MOQ: {
        nombre: "Moquegua", 
        detalle: "Departamento costero del sur. Capital: Moquegua.",
        poblacion: "180,000",
        children: "54K",
        hazardous: "9K"
    },
    TAC: {
        nombre: "Tacna",
        detalle: "Departamento costero fronterizo con Chile. Capital: Tacna.",
        poblacion: "340,000",
        children: "102K",
        hazardous: "17K"
    },
    
    // Región Sierra
    CUS: {
        nombre: "Cusco",
        detalle: "Departamento de la sierra sur, antigua capital del Imperio Inca. Capital: Cusco.",
        poblacion: "1,360,000",
        children: "408K",
        hazardous: "68K"
    },
    APU: {
        nombre: "Apurímac",
        detalle: "Departamento de la sierra sur. Capital: Abancay.",
        poblacion: "460,000",
        children: "138K",
        hazardous: "23K"
    },
    AYA: {
        nombre: "Ayacucho",
        detalle: "Departamento de la sierra sur. Capital: Ayacucho.",
        poblacion: "680,000",
        children: "204K",
        hazardous: "34K"
    },
    PUN: {
        nombre: "Puno",
        detalle: "Departamento de la sierra sur, junto al Lago Titicaca. Capital: Puno.",
        poblacion: "1,415,000",
        children: "425K",
        hazardous: "71K"
    },
    
    // Códigos duplicados
    CAH: {
        nombre: "Cajamarca",
        detalle: "Departamento de la sierra norte. Capital: Cajamarca.",
        poblacion: "1,530,000",
        children: "459K",
        hazardous: "77K"
    },
    HUA: {
        nombre: "Huancavelica",
        detalle: "Departamento de la sierra central. Capital: Huancavelica.",
        poblacion: "480,000",
        children: "144K",
        hazardous: "24K"
    }
}

// (Ahora usamos `peruPaths` importado desde 'peruPaths_high.js')

const selectedCountry = ref('LOR')
const hoveredCountry = ref(null)

const activeDepartamentoInfo = computed(() => {
    const active = hoveredCountry.value || selectedCountry.value
    return departamentoInfo[active] || {
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
    if (peruPaths[code]) {
        hoveredCountry.value = code
    }
}

const unhoverCountry = () => {
    hoveredCountry.value = null
}

const handleCountryClick = (code) => {
    if (!amazonDepartamentos.includes(code)) {
        return;
    }
    // Redirigir a emprendimientos del departamento
    inertiaRouter.visit(`/emprendimientosProvincia/${code}`);
};


const resetMap = () => {
    hoveredCountry.value = null
    selectedCountry.value = 'LOR'
}

const getFillOpacity = (code) => {
    if (hoveredCountry.value === code) return 0.9
    if (selectedCountry.value === code) return 0.8
    if (departamentosPeru[code]) return 0.6
    return 0.4
}

// Devuelve color de texto (blanco o verde oscuro) según contraste del fondo
const getLabelTextColor = (code) => {
    const hex = getCountryColor(code).replace('#','')
    const r = parseInt(hex.substring(0,2),16)
    const g = parseInt(hex.substring(2,4),16)
    const b = parseInt(hex.substring(4,6),16)
    // Luminance perceptual
    const lum = 0.299*r + 0.587*g + 0.114*b
    return lum < 140 ? '#ffffff' : '#005120'
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

.map-label {
    paint-order: stroke;
    stroke: rgba(255,255,255,0.85);
    stroke-width: 3px;
    stroke-linejoin: round;
    -webkit-font-smoothing: antialiased;
    dominant-baseline: middle;
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
