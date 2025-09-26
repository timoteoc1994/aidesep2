<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Noticia</h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow-sm">
          <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
            <!-- Título -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Título</label>
              <input v-model="form.titulo" type="text" class="input" required />
            </div>

            <!-- Descripción -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Descripción</label>
              <textarea v-model="form.descripcion" rows="5" class="input" required></textarea>
            </div>

            <!-- Fecha -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Fecha</label>
              <input v-model="form.fecha" type="date" class="input" />
            </div>

            <!-- Autor -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Autor</label>
              <input v-model="form.autor" type="text" class="input" />
            </div>

            <!-- Ubicación -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Ubicación</label>
              <input v-model="form.ubicacion" type="text" class="input" />
            </div>

            <!-- País y Global -->
            <div class="flex items-center space-x-4">
              <select v-model="form.pais_id" class="input">
                <option value="">País</option>
                <option v-for="pais in paises" :key="pais.id" :value="pais.id">{{ pais.nombre }}</option>
              </select>
              <label class="flex items-center space-x-2">
<input type="checkbox" v-model="form.es_global" />
                <span>Es global</span>
              </label>
            </div>

           <!-- Imagen -->
<div class="form-group">
  <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen de la Noticia</label>

  <!-- Vista previa -->
  <div class="mt-2">
    <div v-if="imagePreview" class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePreview" alt="Vista previa"
             class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>

      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg"
               class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24"
               stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="truncate max-w-xs">{{ imageFile.name }}</span>
          <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile.size) }}</span>
        </div>

        <!-- Botones -->
        <div class="flex space-x-2">
          <!-- Botón Eliminar -->
          <button type="button" @click="removeImage"
                  class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>

          <!-- Botón Cambiar -->
          <label for="imagen"
                 class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            Cambiar
          </label>
          <input id="imagen" type="file" class="hidden" accept="image/*" @change="handleImageUpload" />
        </div>
      </div>
    </div>

    <!-- Drag & Drop -->
    <div v-else
         class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
         @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
         @drop.prevent="handleDrop"
         :class="{ 'bg-purple-50 border-purple-300': dragOver }">
      <input id="imagen" type="file"
             class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
             accept="image/*" @change="handleImageUpload">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
             fill="none" viewBox="0 0 48 48" aria-hidden="true">
          <path
            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex justify-center text-sm text-gray-600">
          <span class="text-purple-600">Sube una imagen</span>
          <span class="pl-1">o arrastra y suelta aquí</span>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 5MB</p>
      </div>
    </div>
  </div>

  <!-- Recomendación -->
  <p class="mt-2 text-xs text-gray-500">Para una mejor visualización, recomendamos imágenes de al menos 800x800 píxeles.</p>
</div>

            <!-- Botón -->
            <div>
              <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Swal from 'sweetalert2'

const props = defineProps({ paises: Array })

const form = ref({
  titulo: '',
  descripcion: '',
  fecha: '',
  autor: '',
  ubicacion: '',
  pais_id: '',
  es_global: false, // This is already correct
  imagen: null
})

const imageFile = ref(null)
const imagePreview = ref(null)
const dragOver = ref(false)

function handleImageUpload(event) {
  const file = event.target.files[0]
  if (!file) return
  imageFile.value = file
  form.value.imagen = file
  imagePreview.value = URL.createObjectURL(file)
}
watch(() => form.value.es_global, (newVal) => {
  if (newVal) {
    form.value.pais_id = ''
  }
})
function handleDrop(event) {
  dragOver.value = false
  const file = event.dataTransfer.files[0]
  if (file && file.type.startsWith('image/')) {
    const dummyEvent = { target: { files: [file] } }
    handleImageUpload(dummyEvent)
  }
}

function removeImage() {
  form.value.imagen = null
  imageFile.value = null
  imagePreview.value = null
}

function formatFileSize(size) {
  const kb = size / 1024
  return kb > 1024 ? `${(kb / 1024).toFixed(2)} MB` : `${kb.toFixed(2)} KB`
}

function submitForm() {
  const formData = new FormData()

  // Convert es_global to a proper boolean (1 or 0) for backend compatibility
  const esGlobalValue = form.value.es_global ? 1 : 0

  // Append all form data
  for (const key in form.value) {
    if (key === 'imagen' && form.value.imagen) {
      formData.append('imagen', form.value.imagen)
    } else if (key === 'es_global') {
      formData.append(key, esGlobalValue)
    } else {
      formData.append(key, form.value[key])
    }
  }

  router.post(route('noticias.store'), formData, {
    forceFormData: true,
    onSuccess: () => {
      Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Noticia creada correctamente.',
        timer: 2000,
        showConfirmButton: false,
      })
    },
    onError: (errors) => {
      console.error('Errores al guardar:', errors)
      Swal.fire({
        icon: 'error',
        title: 'Error al guardar',
        text: 'Revisa los campos requeridos o el formato de imagen.',
      })
    }
  })
}

</script>

<style scoped>
.input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
}
</style>
