<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Emprendimientos</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Botón Crear Emprendimiento -->
<div class="flex justify-end mb-6">
  <button
    @click="router.visit(route('create'))"
    class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-emerald-700 transition-all"
  >
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
      <path d="M12 4v16m8-8H4" />
    </svg>
    Crear Emprendimiento
  </button>
</div>

        <!-- Si no hay emprendimientos -->
        <div v-if="!emprendimientos.data.length" class="bg-white p-6 rounded shadow text-gray-600">
          No hay emprendimientos registrados.
        </div>

        <!-- Cards -->
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="e in emprendimientos.data"
            :key="e.id"
            class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-shadow flex flex-col"
          >
            <!-- Imagen -->
            <div class="h-48 bg-gray-100">
              <img
                v-if="e.imagen_principal"
                :src="`https://amazonfairtrade.org/storage/${e.imagen_principal}`"
                :alt="e.titulo"
                class="w-full h-full object-cover"
              />
              <div v-else class="h-full w-full flex items-center justify-center text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                     stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 4v16m8-8H4" />
                </svg>
                <span class="ml-2 text-sm">Sin imagen</span>
              </div>
            </div>

            <!-- Contenido -->
            <div class="p-5 flex flex-col flex-grow">
              <h3 class="text-lg font-bold text-gray-800 truncate">{{ e.titulo }}</h3>

              <p class="text-sm text-gray-600 mt-1">
                <strong>Categoría:</strong> {{ e.categoria?.nombre || '—' }}
              </p>
              <p class="text-sm text-gray-600">
                <strong>País:</strong> {{ e.pais?.nombre || '—' }}
              </p>
              <p class="text-sm text-gray-600">
                <strong>Provincia:</strong> {{ e.provincia?.nombre || '—' }}
              </p>

              <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                {{ e.descripcion }}
              </p>
            </div>
          </div>
        </div>

        <!-- Paginación -->
        <!-- Paginación estilo emerald -->
<div v-if="emprendimientos.last_page > 1" class="flex justify-center mt-10">
  <nav class="flex items-center gap-1 sm:gap-2" aria-label="Paginación">
    <!-- Botón Anterior -->
    <button
      :disabled="emprendimientos.current_page === 1"
      @click="cambiarPagina(emprendimientos.current_page - 1)"
      class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-emerald-400 text-emerald-400 hover:bg-emerald-100 hover:text-emerald-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
      aria-label="Anterior"
    >
      «
    </button>

    <!-- Números de página -->
    <template v-for="page in totalPagesToShow" :key="page">
      <button
        v-if="page !== '...'"
        @click="cambiarPagina(page)"
        :class="[
          'flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border text-sm font-semibold',
          page === emprendimientos.current_page
            ? 'bg-emerald-400 text-white border-emerald-400 shadow'
            : 'text-emerald-600 border-emerald-300 hover:bg-emerald-100 hover:text-emerald-800 transition-all'
        ]"
        :aria-current="page === emprendimientos.current_page ? 'page' : undefined"
      >
        {{ page }}
      </button>
      <span v-else class="px-2 text-emerald-400 select-none">…</span>
    </template>

    <!-- Botón Siguiente -->
    <button
      :disabled="emprendimientos.current_page === emprendimientos.last_page"
      @click="cambiarPagina(emprendimientos.current_page + 1)"
      class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-emerald-400 text-emerald-400 hover:bg-emerald-100 hover:text-emerald-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
      aria-label="Siguiente"
    >
      »
    </button>
  </nav>
</div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { router } from '@inertiajs/vue3'
import { computed } from 'vue';

const props = defineProps({
  emprendimientos: Object
})

function cambiarPagina(page) {
  router.get(route('emprendimientos.listado'), { page }, {
    preserveScroll: true,
    preserveState: true
  })
}

// Cálculo de páginas a mostrar (con saltos)
const totalPagesToShow = computed(() => {
  const total = props.emprendimientos.last_page
  const current = props.emprendimientos.current_page
  const delta = 2
  const range = []
  const pages = []

  for (let i = Math.max(2, current - delta); i <= Math.min(total - 1, current + delta); i++) {
    range.push(i)
  }

  if (current - delta > 2) range.unshift('...')
  if (current + delta < total - 1) range.push('...')

  range.unshift(1)
  if (total > 1) range.push(total)

  return range
})
</script>
