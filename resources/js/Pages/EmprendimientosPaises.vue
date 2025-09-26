<template>
    <Head>
  <title>Emprendimientos de {{ categoriaNormalizada }} | Con Amazonía</title>
  <meta
    name="description"
    content="Descubre emprendimientos de {{ categoriaNormalizada }} que fusionan sabiduría ancestral y sostenibilidad en la Amazonía."
  />
  <meta
    name="keywords"
    content="emprendimientos amazónicos, {{ categoriaNormalizada }}, sostenibilidad, saberes ancestrales, pueblos indígenas"
  />

  <!-- Open Graph -->
  <meta property="og:title" :content="`Emprendimientos de ${categoriaNormalizada} | Con Amazonía`" />
  <meta
    property="og:description"
    :content="`Explora proyectos innovadores de ${categoriaNormalizada} que protegen la Amazonía y promueven cultura y sostenibilidad.`"
  />
  <meta property="og:type" content="website" />
  <meta property="og:url" :content="`https://conamazonia.com/emprendimientosPaises/${props.categoria}`" />
  <meta
    property="og:image"
    content="https://conamazonia.com/images/conAmazonia/Patrones.webp"
  />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta
    name="twitter:title"
    :content="`Emprendimientos de ${categoriaNormalizada} | Con Amazonía`"
  />
  <meta
    name="twitter:description"
    :content="`Conoce los emprendimientos de ${categoriaNormalizada} que impulsan un futuro sostenible desde la Amazonía.`"
  />
  <meta
    name="twitter:image"
    content="https://conamazonia.com/images/conAmazonia/Patrones.webp"
  />

  <link :rel="'canonical'" :href="`https://conamazonia.com/emprendimientosPaises/${props.categoria}`" />
</Head>

    <div v-if="cargando" class="fixed inset-0 bg-[#124228] z-50 flex flex-col items-center justify-center">
        <svg class="w-16 h-16 text-[#FFF8EA] animate-spin mb-4" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
        </svg>
        <h3 class="text-xl font-semibold text-[#FFF8EA]">Cargando emprendimientos...</h3>
    </div>
    <section class="py-16 px-6 md:px-12 lg:px-20 bg-[#124228]">
        <div class="w-full mx-auto">
            <!-- Encabezado -->
            <div class="mb-12 text-center relative">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#FFF8EA] mb-4">
                    Emprendimientos de {{ categoriaNormalizada }}
                </h2>
                <span class="inline-block h-1 w-20 bg-[#73A847] mb-4 rounded"></span>
                <p class="text-lg text-[#FFF8EA]/90 max-w-2xl mx-auto">
                    Descubre proyectos amazónicos que combinan tradición, sostenibilidad e innovación
                </p>
                <div class="absolute top-0 right-0 -z-10 w-72 h-72 bg-emerald-100 rounded-full opacity-20 blur-3xl">
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-8">
                <!-- SIDEBAR ESCRITORIO -->
                <div class="w-full sm:w-52 lg:w-56 shrink-0 hidden md:block">
                    <div class="bg-[#FFF8EA] p-4 rounded-lg sticky top-4 border-2 border-[#73A847]">
                        <div class="mb-4 flex justify-between items-center">
                            <h3 class="font-semibold text-[#124228]">Filtros</h3>
                            <button
                                v-if="filtrosPais.length || filtrosProvincia.length || filtrosEtiquetas.length || filtroCertificaciones.length"
                                @click="resetearFiltros" class="text-xs text-[#73A847] hover:text-[#124228]">
                                Resetear filtros
                            </button>
                        </div>
                        <!-- Filtros (reutilizamos el mismo bloque que luego mostramos en móvil también) -->
                        <div>
                            <!-- País -->
                            <div class="mb-4 border-b border-[#73A847] pb-3">
                                <div @click="toggleSeccion('pais')"
                                    class="flex justify-between items-center cursor-pointer">
                                    <h4 class="font-medium text-[#73A847] text-sm">País</h4>
                                    <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionPais ? 'rotate-180' : '']"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="mostrarSeccionPais"
                                    class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                    <div v-for="pais in paisesDisponibles" :key="pais" class="flex items-center">
                                        <input :id="`pais-${pais}`" type="checkbox" :value="pais" v-model="filtrosPais"
                                            class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                        <label :for="`pais-${pais}`" class="ml-2 text-sm text-[#124228]">{{ pais
                                            }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Provincia -->
                            <div class="mb-4 border-b border-[#73A847] pb-3">
                                <div @click="toggleSeccion('provincia')"
                                    class="flex justify-between items-center cursor-pointer">
                                    <h4 class="font-medium text-[#73A847] text-sm">Provincia</h4>
                                    <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionProvincia ? 'rotate-180' : '']"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="mostrarSeccionProvincia"
                                    class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                    <div v-for="provincia in provinciasDisponibles" :key="provincia"
                                        class="flex items-center">
                                        <input :id="`provincia-${provincia}`" type="checkbox" :value="provincia"
                                            v-model="filtrosProvincia"
                                            class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                        <label :for="`provincia-${provincia}`" class="ml-2 text-sm text-[#124228]">{{
                                            provincia }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Etiquetas -->
                            <div class="mb-4 border-b border-[#73A847] pb-3">
                                <div @click="toggleSeccion('etiquetas')"
                                    class="flex justify-between items-center cursor-pointer">
                                    <h4 class="font-medium text-[#73A847] text-sm">Etiquetas</h4>
                                    <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionEtiquetas ? 'rotate-180' : '']"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="mostrarSeccionEtiquetas"
                                    class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                    <div v-for="etiqueta in etiquetasDisponibles" :key="etiqueta"
                                        class="flex items-center">
                                        <input :id="`etiqueta-${etiqueta}`" type="checkbox" :value="etiqueta"
                                            v-model="filtrosEtiquetas"
                                            class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                        <label :for="`etiqueta-${etiqueta}`" class="ml-2 text-sm text-[#124228]">{{
                                            etiqueta }}</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Certificaciones -->
                            <div>
                                <div @click="toggleSeccion('certificaciones')"
                                    class="flex justify-between items-center cursor-pointer">
                                    <h4 class="font-medium text-[#73A847] text-sm">Certificaciones</h4>
                                    <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionCertificaciones ? 'rotate-180' : '']"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="mostrarSeccionCertificaciones"
                                    class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                    <div v-for="cert in certificacionesDisponibles" :key="cert"
                                        class="flex items-center">
                                        <input :id="`cert-${cert}`" type="checkbox" :value="cert"
                                            v-model="filtroCertificaciones"
                                            class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                        <label :for="`cert-${cert}`" class="ml-2 text-sm text-[#124228]">{{ cert
                                            }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTENIDO PRINCIPAL -->
                <div class="flex-1">
                    <!-- Buscador y botón filtros móvil -->
                    <div class="relative mb-6 flex items-center gap-2">
                        <div class="relative flex-1 group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-[#73A847] group-focus-within:text-[#1A695B] transition-all duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input v-model="busqueda" @input="handleBusqueda" type="text"
                                class="w-full pl-12 text-[#124228] font-bold border-2 border-[#73A847] rounded-lg focus:outline-none focus:ring-0 focus:border-[#1A695B]"
                                placeholder="Buscar por nombre o descripción..." />
                        </div>

                        <!-- Botón filtros -->
                        <button @click="mostrarSidebarMovil = true"
                            class="md:hidden p-2 border-2 border-[#73A847] rounded-lg text-[#FFF8EA] hover:bg-[#FFF8EA] hover:text-[#73A847]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zm0 5h18v2H3V9zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" />
                            </svg>
                        </button>
                    </div>


                    <!-- Mostrar resultados o estado vacío -->
                    <div v-if="emprendimientos.length === 0" class="text-center py-16">
                        <svg class="w-16 h-16 text-[#FFF8EA] mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-[#FFF8EA] mb-2">No se encontraron emprendimientos</h3>
                        <p class="text-[#FFF8EA]/90">Prueba con otros criterios de búsqueda o filtros diferentes.</p>
                        <button @click="resetearFiltros"
                            class="mt-4 px-4 py-2 bg-[#73A847] text-[#FFF8EA] hover:text-[#73A847] font-medium rounded-lg hover:bg-[#FFF8EA] transition-all">
                            Limpiar filtros
                        </button>
                    </div>

                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        <div v-for="(e, index) in emprendimientos" :key="e.id" @click="verPerfilEmprendimiento(e.slug)"
                            class="group rounded-2xl overflow-hidden bg-[#FFF8EA] shadow-md transition duration-300 transform border border-[#FFF8EA] hover:-translate-y-2 cursor-pointer">
                            <div class="relative h-64 overflow-hidden">
                                <img :src="`https://amazonfairtrade.org/storage/${e.imagen_principal}`" :alt="e.titulo"
                                    :data-loaded="loadedImages[index] ? 'true' : 'false'" @load="onImageLoad(index)"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute bottom-4 left-4">
                                        <span class="text-white font-medium">
                                            {{ e.pais?.nombre }} · {{ e.provincia?.nombre }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-[#73A847]">{{ e.titulo }}</h3>
                                <p class="text-[#124228] mb-4 line-clamp-3">{{ e.descripcion }}</p>

                                <div class="flex flex-wrap gap-2 mt-auto">
                                    <template v-if="getTagsArray(e.etiquetas_1).length > 0">
                                        <span v-for="(tag, i) in getTagsArray(e.etiquetas_1)" :key="`tag-${i}`"
                                            class="text-xs font-medium text-[#73A847] px-2 py-1 rounded-full border-[#73A847] border-2">
                                            {{ tag }}
                                        </span>
                                    </template>

                                    <template v-if="getTagsArray(e.etiquetas_2).length > 0">
                                        <span v-for="(cert, i) in getTagsArray(e.etiquetas_2)" :key="`cert-${i}`"
                                            class="text-xs font-medium text-amber-700 px-2 py-1 rounded-full border-amber-500 border-2">
                                            {{ cert }}
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Paginador -->
            <div v-if="paginacion.last_page > 1" class="flex justify-center mt-8">
                <nav class="flex items-center gap-1 sm:gap-2" aria-label="Paginación">

                    <!-- Botón Anterior -->
                    <button :disabled="paginacion.current_page === 1"
                        @click="obtenerEmprendimientos(paginacion.current_page - 1)"
                        class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-[#FFF8EA] text-[#FFF8EA] hover:bg-[#FFF8EA] hover:text-[#124228] transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Anterior">
                        «
                    </button>

                    <!-- Números de páginas -->
                    <template v-for="page in totalPagesToShow" :key="page">
                        <button v-if="page !== '...'" @click="obtenerEmprendimientos(page)" :class="[
                            'flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border text-sm font-semibold',
                            page === paginacion.current_page
                                ? 'bg-[#FFF8EA] text-[#124228] border-[#FFF8EA] shadow-md'
                                : 'text-[#FFF8EA] border-[#FFF8EA] hover:bg-[#FFF8EA] hover:text-[#124228] transition-all'
                        ]" :aria-current="page === paginacion.current_page ? 'page' : undefined">
                            {{ page }}
                        </button>
                        <span v-else class="px-2 text-[#FFF8EA] select-none">…</span>
                    </template>

                    <!-- Botón Siguiente -->
                    <button :disabled="paginacion.current_page === paginacion.last_page"
                        @click="obtenerEmprendimientos(paginacion.current_page + 1)"
                        class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-[#FFF8EA] text-[#FFF8EA] hover:bg-[#FFF8EA] hover:text-[#124228] transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Siguiente">
                        »
                    </button>

                </nav>
            </div>

            <!-- SIDEBAR MÓVIL (OFFCANVAS) -->
            <div v-if="mostrarSidebarMovil"
                class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-end md:hidden">
                <div class="w-4/5 sm:w-2/3 h-full bg-white shadow-lg p-4 overflow-y-auto custom-scrollbar">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#73A847]">Filtros</h3>
                        <button @click="mostrarSidebarMovil = false" class="text-emerald-500 hover:text-[#73A847]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div>
                        <!-- Botón para resetear filtros -->
                        <div class="mb-4 flex justify-between items-center">
                            <h4 class="font-semibold text-[#73A847] text-sm">Opciones</h4>
                            <button
                                v-if="filtrosPais.length > 0 || filtrosProvincia.length > 0 || filtrosEtiquetas.length > 0 || filtroCertificaciones.length > 0"
                                @click="resetearFiltros" class="text-xs text-emerald-400 hover:text-[#73A847]">
                                Resetear filtros
                            </button>
                        </div>

                        <!-- País -->
                        <div class="mb-4 border-b border-[#73A847] pb-3">
                            <div @click="toggleSeccion('pais')"
                                class="flex justify-between items-center cursor-pointer">
                                <h4 class="font-medium text-[#73A847] text-sm">País</h4>
                                <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionPais ? 'rotate-180' : '']"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div v-if="mostrarSeccionPais"
                                class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                <div v-for="pais in paisesDisponibles" :key="pais" class="flex items-center">
                                    <input :id="`movil-pais-${pais}`" type="checkbox" :value="pais"
                                        v-model="filtrosPais"
                                        class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                    <label :for="`movil-pais-${pais}`" class="ml-2 text-sm text-[#124228]">{{ pais
                                        }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Provincia -->
                        <div class="mb-4 border-b border-[#73A847] pb-3">
                            <div @click="toggleSeccion('provincia')"
                                class="flex justify-between items-center cursor-pointer">
                                <h4 class="font-medium text-[#73A847] text-sm">Provincia</h4>
                                <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionProvincia ? 'rotate-180' : '']"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div v-if="mostrarSeccionProvincia"
                                class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                <div v-for="provincia in provinciasDisponibles" :key="provincia"
                                    class="flex items-center">
                                    <input :id="`movil-provincia-${provincia}`" type="checkbox" :value="provincia"
                                        v-model="filtrosProvincia"
                                        class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                    <label :for="`movil-provincia-${provincia}`" class="ml-2 text-sm text-[#124228]">{{
                                        provincia }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Etiquetas -->
                        <div class="mb-4 border-b border-[#73A847] pb-3">
                            <div @click="toggleSeccion('etiquetas')"
                                class="flex justify-between items-center cursor-pointer">
                                <h4 class="font-medium text-[#73A847] text-sm">Etiquetas</h4>
                                <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionEtiquetas ? 'rotate-180' : '']"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div v-if="mostrarSeccionEtiquetas"
                                class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                <div v-for="etiqueta in etiquetasDisponibles" :key="etiqueta" class="flex items-center">
                                    <input :id="`movil-etiqueta-${etiqueta}`" type="checkbox" :value="etiqueta"
                                        v-model="filtrosEtiquetas"
                                        class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                    <label :for="`movil-etiqueta-${etiqueta}`" class="ml-2 text-sm text-[#124228]">{{
                                        etiqueta }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Certificaciones -->
                        <div class="mb-4">
                            <div @click="toggleSeccion('certificaciones')"
                                class="flex justify-between items-center cursor-pointer">
                                <h4 class="font-medium text-[#73A847] text-sm">Certificaciones</h4>
                                <svg :class="['w-4 h-4 text-[#73A847] transition-transform', mostrarSeccionCertificaciones ? 'rotate-180' : '']"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div v-if="mostrarSeccionCertificaciones"
                                class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar mt-2">
                                <div v-for="cert in certificacionesDisponibles" :key="cert" class="flex items-center">
                                    <input :id="`movil-cert-${cert}`" type="checkbox" :value="cert"
                                        v-model="filtroCertificaciones"
                                        class="w-4 h-4 text-[#73A847] rounded focus:ring-0 focus:ring-offset-0" />
                                    <label :for="`movil-cert-${cert}`" class="ml-2 text-sm text-[#124228]">{{ cert
                                        }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import { Head, router } from '@inertiajs/vue3';

// Props
const props = defineProps({
    categoria: {
        type: String,
        required: true
    }
});

const filtrosDisponibles = ref({
    paises: [],
    provincias: [],
    etiquetas: [],
    certificaciones: [],
});

const handleBusqueda = () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        obtenerEmprendimientos(1);
    }, 1500);
};

const obtenerFiltros = async () => {
    try {
        const response = await axios.get(`/api/filtros/categoria-ecuador/${props.categoria}`);
        filtrosDisponibles.value.paises = response.data.paises.sort();
        filtrosDisponibles.value.provincias = response.data.provincias.sort();
        filtrosDisponibles.value.etiquetas = response.data.etiquetas.sort();
        filtrosDisponibles.value.certificaciones = response.data.certificaciones.sort();
        console.log('✅ Filtros globales cargados');
    } catch (error) {
        console.error('❌ Error al obtener filtros globales:', error);
    }
};

// Estados
const emprendimientos = ref([]);
const loadedImages = ref([]);
const cargando = ref(true);
const paginacion = ref({
    current_page: 1,
    last_page: 1
});

// Filtros
const busqueda = ref('');
const filtrosPais = ref([]);
const filtrosProvincia = ref([]);
const filtrosEtiquetas = ref([]);
const filtroCertificaciones = ref([]);
const mostrarSidebarMovil = ref(false);

// Mostrar/ocultar secciones
const mostrarSeccionPais = ref(true);
const mostrarSeccionProvincia = ref(true);
const mostrarSeccionEtiquetas = ref(true);
const mostrarSeccionCertificaciones = ref(true);

// Helpers
const getTagsArray = (tags) => {
    if (!tags) return [];
    if (Array.isArray(tags)) return tags;
    if (typeof tags === 'string') {
        try {
            const parsed = JSON.parse(tags);
            return Array.isArray(parsed) ? parsed : [];
        } catch (err) {
            console.error(`❌ Error al parsear etiquetas:`, tags);
            return [];
        }
    }
    return [];
};

// Normalizar categoría
const categoriaNormalizada = computed(() => {
    return props.categoria
        .replace(/-/g, ' ')
        .toLowerCase()
        .replace(/(^|\s)\S/g, l => l.toUpperCase());
});

// Obtener emprendimientos paginados con filtros
const obtenerEmprendimientos = async (pagina = 1) => {
    cargando.value = true;
    try {
        const response = await axios.get(`/api/emprendimientos/categoria-ecuador/${props.categoria}`, {
            params: {
                page: pagina,
                paises: filtrosPais.value,
                provincias: filtrosProvincia.value,
                etiquetas: filtrosEtiquetas.value,
                certificaciones: filtroCertificaciones.value,
                busqueda: busqueda.value
            }
        });

        emprendimientos.value = response.data.data;
        paginacion.value = {
            current_page: response.data.current_page,
            last_page: response.data.last_page
        };
        loadedImages.value = new Array(emprendimientos.value.length).fill(false);
    } catch (error) {
        console.error('❌ Error al obtener emprendimientos:', error);
    } finally {
        cargando.value = false;
    }
};

// Imagen cargada
const onImageLoad = (index) => {
    loadedImages.value[index] = true;
};

// Resetear filtros
const resetearFiltros = () => {
    busqueda.value = '';
    filtrosPais.value = [];
    filtrosProvincia.value = [];
    filtrosEtiquetas.value = [];
    filtroCertificaciones.value = [];
};

// Toggle secciones
const toggleSeccion = (seccion) => {
    switch (seccion) {
        case 'pais':
            mostrarSeccionPais.value = !mostrarSeccionPais.value;
            break;
        case 'provincia':
            mostrarSeccionProvincia.value = !mostrarSeccionProvincia.value;
            break;
        case 'etiquetas':
            mostrarSeccionEtiquetas.value = !mostrarSeccionEtiquetas.value;
            break;
        case 'certificaciones':
            mostrarSeccionCertificaciones.value = !mostrarSeccionCertificaciones.value;
            break;
    }
};

// Ver perfil
const verPerfilEmprendimiento = (slug) => {
    if (!slug) {
        console.error('❌ No se encontró el slug del emprendimiento');
        return;
    }
    console.log('👉 slug clickeado:', slug);
    router.get(`/emprendimiento/${slug}`);
};


const paisesDisponibles = computed(() => filtrosDisponibles.value.paises);
const provinciasDisponibles = computed(() => filtrosDisponibles.value.provincias);
const etiquetasDisponibles = computed(() => filtrosDisponibles.value.etiquetas);
const certificacionesDisponibles = computed(() => filtrosDisponibles.value.certificaciones);

// Paginación inteligente
const totalPagesToShow = computed(() => {
    const total = paginacion.value.last_page || 1;
    const current = paginacion.value.current_page || 1;
    const delta = 2;

    const range = [];
    for (let i = Math.max(1, current - delta); i <= Math.min(total, current + delta); i++) {
        range.push(i);
    }

    if (range[0] > 1) {
        if (range[0] > 2) range.unshift('...');
        range.unshift(1);
    }

    if (range[range.length - 1] < total) {
        if (range[range.length - 1] < total - 1) range.push('...');
        range.push(total);
    }

    return range;
});

// Watch filtros con debounce
let timeout;
watch([filtrosPais, filtrosProvincia, filtrosEtiquetas, filtroCertificaciones, busqueda], () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        obtenerEmprendimientos(1);
    }, 300);
});

// Inicializar
onMounted(async () => {
    await obtenerFiltros(); // <-- primero traemos todos los filtros de toda la base
    await obtenerEmprendimientos(); // <-- luego traemos los emprendimientos filtrados por categoría
});

</script>


<style scoped>
/* Scrollbar personalizada */
.custom-scrollbar::-webkit-scrollbar {
    width: 10px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgb(115, 168, 71);
    /* Verde de fondo */
    border-radius: 9999px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: rgb(255, 248, 234);
    /* Crema claro para el thumb */
    border-radius: 9999px;
    border: 2px solid rgb(115, 168, 71);
    /* Borde del thumb verde */
}

/* Prevenir scroll horizontal innecesario */
section#noticias {
    overflow-x: hidden;
}
</style>
