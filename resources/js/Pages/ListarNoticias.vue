<template>

    <Head title="Listado de Noticias" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <Newspaper class="w-6 h-6 text-gray-700" /> Listado de Noticias
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Sin noticias -->
                <div class="flex justify-end mb-6">
                    <Link :href="route('noticias.create')"
                        class="inline-flex items-center px-4 py-2 rounded-md shadow-sm text-sm font-medium transition duration-300 bg-emerald-500 text-white hover:bg-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear Noticia
                    </Link>
                </div>
                <div v-if="!noticias?.data || noticias.data.length === 0"
                    class="bg-white p-6 rounded-lg shadow text-gray-600 flex items-center gap-2">
                    <Ban class="w-5 h-5 text-red-500" /> No hay noticias registradas.
                </div>

                <!-- Grid de noticias -->
                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div v-for="noticia in noticias.data" :key="noticia.id"
                        class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                        <!-- Imagen -->
                        <img v-if="noticia.imagen" :src="`https://amazonfairtrade.org/storage/${noticia.imagen}`" alt="Imagen de la noticia"
                            class="h-48 w-full object-cover" />
                        <div v-else class="h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                            <ImageOff class="w-6 h-6" />
                            <span class="text-sm ml-2">Sin imagen</span>
                        </div>

                        <!-- Contenido -->
                        <div class="p-5 flex flex-col justify-between flex-grow">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 truncate">{{ noticia.titulo }}</h3>
                                <p class="text-sm text-gray-500 mb-2 flex items-center gap-1">
                                    <Calendar class="w-4 h-4" /> {{ formatFecha(noticia.fecha) }}
                                </p>

                                <div class="text-sm text-gray-600 space-y-2 mb-4">
                                    <p class="flex items-center gap-1">
                                        <User class="w-4 h-4" /><strong>Autor:</strong> {{ noticia.autor || '—' }}
                                    </p>
                                    <p class="flex items-center gap-1">
                                        <MapPin class="w-4 h-4" /><strong>Ubicación:</strong> {{ noticia.ubicacion ||
                                        '—' }}
                                    </p>
                                    <p class="flex items-center gap-1">
                                        <Globe class="w-4 h-4" /><strong>Tipo:</strong>
                                        <span
                                            :class="noticia.es_global ? 'text-green-700 font-semibold' : 'text-blue-700 font-semibold'">
                                            {{ noticia.es_global ? 'Global' : 'Por país' }}
                                        </span>
                                    </p>
                                    <p class="flex items-center gap-1">
                                        <Flag class="w-4 h-4" /><strong>País:</strong> {{ noticia.pais?.nombre || 'S/P'
                                        }}
                                    </p>
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="flex justify-between mt-auto pt-4 border-t border-gray-200 space-x-2">
                                <Link :href="`/editar-noticia/${noticia.slug}`"
                                    class="w-full text-center text-sm px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors flex items-center justify-center gap-1">
                                <Edit class="w-4 h-4" /> Editar
                                </Link>
                                <button @click="eliminarNoticia(noticia.slug)"
                                    class="w-full text-center text-sm px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors flex items-center justify-center gap-1">
                                    <Trash2 class="w-4 h-4" /> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paginación con estilo emerald -->
                <div v-if="noticias.last_page > 1" class="flex justify-center mt-10">
                    <nav class="flex items-center gap-1 sm:gap-2" aria-label="Paginación">
                        <!-- Botón Anterior -->
                        <button :disabled="noticias.current_page === 1"
                            @click="cambiarPagina(noticias.current_page - 1)"
                            class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-emerald-400 text-emerald-400 hover:bg-emerald-100 hover:text-emerald-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                            aria-label="Anterior">
                            «
                        </button>

                        <!-- Números -->
                        <template v-for="page in totalPagesToShow" :key="page">
                            <button v-if="page !== '...'" @click="cambiarPagina(page)" :class="[
                                'flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border text-sm font-semibold',
                                page === noticias.current_page
                                    ? 'bg-emerald-400 text-white border-emerald-400 shadow'
                                    : 'text-emerald-600 border-emerald-300 hover:bg-emerald-100 hover:text-emerald-800 transition-all'
                            ]" :aria-current="page === noticias.current_page ? 'page' : undefined">
                                {{ page }}
                            </button>
                            <span v-else class="px-2 text-emerald-400 select-none">…</span>
                        </template>

                        <!-- Botón Siguiente -->
                        <button :disabled="noticias.current_page === noticias.last_page"
                            @click="cambiarPagina(noticias.current_page + 1)"
                            class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-emerald-400 text-emerald-400 hover:bg-emerald-100 hover:text-emerald-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                            aria-label="Siguiente">
                            »
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { format } from 'date-fns'
import { es } from 'date-fns/locale'
import Swal from 'sweetalert2'
import {
    Newspaper,
    Calendar,
    User,
    MapPin,
    Globe,
    Flag,
    Edit,
    Trash2,
    ImageOff,
    Ban
} from 'lucide-vue-next'
import { computed } from 'vue'

const props = defineProps({
    noticias: Object
})

console.log('📰 Datos recibidos:', props.noticias)

function formatFecha(fecha) {
    if (!fecha) return '—'
    try {
        return format(new Date(fecha), 'dd MMM yyyy', { locale: es })
    } catch {
        return fecha
    }
}

function eliminarNoticia(slug) {
    Swal.fire({
        title: '¿Eliminar esta noticia?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/eliminar-noticia/${slug}`, {
                onSuccess: () => {
                    Swal.fire('Eliminada', 'La noticia ha sido eliminada.', 'success')
                },
                onError: () => {
                    Swal.fire('Error', 'No se pudo eliminar la noticia.', 'error')
                }
            })
        }
    })
}

function cambiarPagina(page) {
    console.log('🔁 Cambiando a página:', page)
    router.get(route('noticias.listado'), { page }, {
        preserveState: true,
        preserveScroll: true
    })
}

// Computed para mostrar máximo 5 páginas (puedes ajustar a gusto)
const totalPagesToShow = computed(() => {
    const total = props.noticias.last_page
    const current = props.noticias.current_page
    const delta = 2
    const range = []

    for (let i = Math.max(1, current - delta); i <= Math.min(total, current + delta); i++) {
        range.push(i)
    }

    if (range[0] > 1) {
        if (range[0] > 2) range.unshift('...')
        range.unshift(1)
    }

    if (range[range.length - 1] < total) {
        if (range[range.length - 1] < total - 1) range.push('...')
        range.push(total)
    }

    return range
})
</script>
