<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Noticia</h2>
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
           <div class="flex flex-wrap items-center gap-4">
  <div class="flex-1 min-w-[200px]">
    <select v-model="form.pais_id" class="input w-full">
      <option value="">País</option>
      <option v-for="pais in paises" :key="pais.id" :value="pais.id">{{ pais.nombre }}</option>
    </select>
  </div>
  <label class="flex items-center space-x-2 text-sm text-gray-700">
    <input type="checkbox" v-model="form.es_global" class="form-checkbox h-4 w-4 text-blue-600" />
    <span>Es global</span>
  </label>
</div>


            <!-- Imagen -->
            <div class="form-group">
              <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de la Noticia</label>
              <div class="mt-2">
                <div v-if="imagePreview" class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
                  <div class="flex items-center justify-center">
                    <img :src="imagePreview" alt="Vista previa" class="h-52 max-h-52 w-auto object-contain rounded-md" />
                  </div>
                  <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-600">
                      <span class="truncate max-w-xs">{{ imageFile?.name || 'Imagen actual' }}</span>
                    </div>
                    <div class="flex space-x-2">
                      <label for="imagen"
                        class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                        Cambiar
                      </label>
                      <input id="imagen" type="file" class="hidden" accept="image/*" @change="handleImageUpload" />
                    </div>
                  </div>
                </div>
                <div v-else class="text-sm text-gray-500">No hay imagen cargada.</div>
              </div>
            </div>

            <!-- Botón -->
            <div>
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Actualizar
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
import Swal from 'sweetalert2'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  noticia: Object,
  paises: Array
})

const form = ref({
  titulo: props.noticia.titulo || '',
  descripcion: props.noticia.descripcion || '',
  fecha: props.noticia.fecha || '',
  autor: props.noticia.autor || '',
  ubicacion: props.noticia.ubicacion || '',
  pais_id: props.noticia.pais_id || '',
  es_global: !!props.noticia.es_global,
  imagen: null
})

const imageFile = ref(null)
const imagePreview = ref(props.noticia.imagen ? `https://amazonfairtrade.org/storage/${props.noticia.imagen}` : null)

watch(() => form.value.es_global, (newVal) => {
  if (newVal) form.value.pais_id = ''
})

watch(() => form.value.pais_id, (newVal) => {
  if (newVal) form.value.es_global = false
})


function handleImageUpload(event) {
  const file = event.target.files[0]
  if (!file) return
  imageFile.value = file
  form.value.imagen = file
  imagePreview.value = URL.createObjectURL(file)
}

function submitForm() {
  const formData = new FormData()
  const esGlobalValue = form.value.es_global ? '1' : '0'

  console.log('🧪 INICIO DEL SUBMIT ------------------------')
  console.log('🔍 Título:', form.value.titulo)
  console.log('🔍 Descripción:', form.value.descripcion)
  console.log('🔍 Fecha:', form.value.fecha)
  console.log('🔍 Autor:', form.value.autor)
  console.log('🔍 Ubicación:', form.value.ubicacion)
  console.log('🔍 País ID:', form.value.pais_id)
  console.log('🔍 ¿Es global?:', esGlobalValue)
  console.log('🔍 Imagen:', form.value.imagen)

  if (!form.value.es_global && !form.value.pais_id) {
    console.warn('⚠️ Validación: Si no es global, debe tener un país.')
    Swal.fire({
      icon: 'error',
      title: 'Error de validación',
      text: 'Debe seleccionar un país si la noticia no es global.',
    })
    return
  }

  Object.keys(form.value).forEach(key => {
    if (key === 'imagen') return

    let value = form.value[key]

    if (key === 'es_global') {
      value = esGlobalValue
    }

    if (value === null || value === undefined) {
      value = ''
    }

    console.log(`📦 Añadiendo al FormData -> ${key}:`, value)
    formData.append(key, value)
  })

  if (form.value.imagen instanceof File) {
    formData.append('imagen', form.value.imagen)
    console.log('📷 Imagen nueva añadida al FormData:', form.value.imagen.name)
  } else {
    console.log('📷 No se añadió nueva imagen, se mantiene la existente.')
  }

  console.log('🚀 Enviando PUT a:', `/editar-noticia/${props.noticia.slug}`)

formData.append('_method', 'PUT') // 👈 Añadimos el método manualmente

router.post(`/editar-noticia/${props.noticia.slug}`, formData, {
  forceFormData: true,
    onSuccess: () => {
      console.log('✅ Noticia actualizada correctamente')
      Swal.fire({
        icon: 'success',
        title: 'Actualizado',
        text: 'La noticia fue actualizada correctamente.',
        timer: 2000,
        showConfirmButton: false,
      })

    },
    onError: (errors) => {
      console.error('❌ Error de validación recibido desde el backend:', errors)
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ocurrió un error al actualizar la noticia.',
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
