<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight"
        :style="{ color: emprendimiento.color_principal_1 }"
      >
        Mis Productos
      </h2>
    </template>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg p-6"
        :style="{ backgroundColor: emprendimiento.color_secundario_2 }"
      >
        <div class="mb-6 text-right">
    <Link
      :href="route('create-product')"
      class="inline-flex items-center px-4 py-2 rounded-md shadow-sm text-sm font-medium transition duration-300"
      :style="{
        backgroundColor: emprendimiento.color_secundario_1,
        color: emprendimiento.color_secundario_2
      }"
    >
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4v16m8-8H4"/>
      </svg>
      Crear nuevo producto
    </Link>
  </div>
        <div v-if="productos.length">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
              v-for="producto in productos"
              :key="producto.id"
              class="rounded-xl shadow-md overflow-hidden flex flex-col h-full transition-all duration-300 hover:-translate-y-2 group"
              :style="{
                backgroundColor: emprendimiento.color_secundario_2,
                border: `1px solid ${emprendimiento.color_secundario_1}50`
              }"
            >
              <!-- Imagen -->
              <div class="relative h-52 overflow-hidden">
                <img
                  :src="`https://amazonfairtrade.org/storage/${producto.imagen}`"
                  :alt="producto.nombre"
                  class="w-full h-full object-cover"
                />
                <div
                  class="absolute inset-0 group-hover:opacity-100 opacity-0 transition-opacity duration-300"
                  :style="{
                    backgroundImage: `linear-gradient(to top, ${emprendimiento.color_secundario_1}50, transparent)`
                  }"
                >
                <!--
                  <div class="absolute bottom-4 left-4">
                    <span class="font-medium"
                      :style="{ color: emprendimiento.color_secundario_2 }"
                    >
                      Ver más detalles
                    </span>
                  </div>
                  -->
                </div>

                <!-- Etiqueta Calidad -->
                <div
  v-if="getFirstEtiquetaCalidad(producto.etiquetas_calidad)"
  class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold z-10"
  :style="{
    backgroundColor: emprendimiento.color_secundario_1,
    color: emprendimiento.color_secundario_2,
  }"
>
  {{ getFirstEtiquetaCalidad(producto.etiquetas_calidad) }}
</div>
              </div>

              <!-- Contenido -->
              <div class="p-6 space-y-3 flex-grow">
                <h3 class="text-xl font-bold"
                  :style="{ color: emprendimiento.color_principal_1 }"
                >
                  {{ producto.nombre }}
                </h3>

                <div class="flex flex-wrap gap-2">
                  <span
                    v-for="(etiqueta, index) in parseEtiquetas(producto.etiquetas_presentacion)"
                    :key="index"
                    class="text-xs font-medium px-2 py-1 rounded-full border border-black text-black"
                  >
                    {{ etiqueta }}
                  </span>
                </div>

                <p class="text-sm line-clamp-3 text-black"
                >
                  {{ producto.descripcion }}
                </p>
              </div>

              <!-- Botón Editar -->
               <div class="px-6 pb-6">
                <div class="flex items-center gap-3">
                  <Link
                    :href="`/editar-producto/${producto.slug}`"
                    class="flex-1 text-center text-sm font-medium rounded-md py-2 transition duration-300"
                    :style="{
                      backgroundColor: emprendimiento.color_secundario_1,
                      color: emprendimiento.color_secundario_2
                    }"
                  >
                    <span class="flex items-center justify-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                      Editar
                    </span>
                  </Link>

                  <button
                    @click="confirmarEliminacion(producto.slug)"
                    class="flex-1 text-center text-sm font-medium rounded-md py-2 transition duration-300 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white"
                  >
                    <span class="flex items-center justify-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      Eliminar
                    </span>
                  </button>
                </div>
            </div>
          </div>
                    </div>

        </div>

        <div v-else class="text-center mt-8"
          :style="{ color: emprendimiento.color_secundario_1 }"
        >
          No tienes productos aún.
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
import { defineProps } from 'vue'

import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

const confirmarEliminacion = (slug) => {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esta acción eliminará el producto permanentemente.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6B7280',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/eliminar-producto/${slug}`, {
        onSuccess: () => {
          Swal.fire('Eliminado', 'El producto ha sido eliminado.', 'success')
        },
        onError: () => {
          Swal.fire('Error', 'No se pudo eliminar el producto.', 'error')
        }
      })
    }
  })
}

const props = defineProps({
  productos: Array,
  emprendimiento: Object
})

const getFirstEtiquetaCalidad = (etiquetasCalidad) => {
  const etiquetas = parseEtiquetas(etiquetasCalidad)
  return etiquetas.length > 0 ? etiquetas[0] : ''
}

const parseEtiquetas = (etiquetas) => {
  try {
    return etiquetas ? JSON.parse(etiquetas) : []
  } catch (error) {
    console.error('Error al parsear etiquetas:', error)
    return []
  }
}
</script>
