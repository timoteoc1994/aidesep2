<template>
  <section class="py-16 px-6 md:px-12 lg:px-20 bg-white">
    <div class="w-full mx-auto">
      <!-- Encabezado -->
      <div class="mb-12 text-center relative">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-emerald-900 mb-4">
          Emprendimientos de {{ categoriaNormalizada }}
        </h2>
        <span class="inline-block h-1 w-20 bg-emerald-400 mb-4 rounded"></span>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Descubre proyectos amazónicos que combinan tradición, sostenibilidad e innovación
        </p>
      </div>

      <!-- Mostrar emprendimientos -->
      <div v-if="emprendimientos.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="(emprendimiento, index) in emprendimientos"
          :key="emprendimiento.id"
          class="group rounded-2xl overflow-hidden bg-white shadow-md transition duration-300 transform border border-emerald-100 hover:-translate-y-2 cursor-pointer"
        >
          <!-- Imagen principal -->
          <div class="relative h-64 overflow-hidden">
            <img
              :src="`https://amazonfairtrade.org/storage/${emprendimiento.imagen_principal}`"
              :alt="emprendimiento.titulo"
              :data-loaded="loadedImages[index] ? 'true' : 'false'"
              @load="onImageLoad(index)"
              class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
              <div class="absolute bottom-4 left-4">
                <span class="text-white font-medium">
                  {{ emprendimiento.pais?.nombre }} · {{ emprendimiento.provincia?.nombre }}
                </span>
              </div>
            </div>
          </div>

          <!-- Texto -->
          <div class="p-6">
            <h3 class="text-xl font-bold text-emerald-700">{{ emprendimiento.titulo }}</h3>
            <p class="text-gray-600 mb-4">{{ emprendimiento.descripcion }}</p>
          </div>
        </div>
      </div>

      <!-- Estado vacío -->
      <div v-else class="text-center py-16">
        <svg class="w-16 h-16 text-emerald-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="text-xl font-semibold text-emerald-900 mb-2">No se encontraron emprendimientos</h3>
        <p class="text-gray-600">Prueba con otros criterios de búsqueda o filtros diferentes.</p>
      </div>
    </div>
  </section>
</template>
<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
  categoria: {
    type: String,
    required: true
  }
});

const emprendimientos = ref([]);
const loadedImages = ref([]);

const categoriaNormalizada = computed(() => {
  return props.categoria
    .replace(/-/g, ' ')
    .toLowerCase()
    .replace(/(^|\s)\S/g, l => l.toUpperCase());
});

const obtenerEmprendimientos = async () => {
  try {
    const response = await axios.get(`/api/emprendimientos/categoria/${props.categoria}`);
    emprendimientos.value = response.data;
    loadedImages.value = new Array(emprendimientos.value.length).fill(false);

    console.log('✅ Toda la data de emprendimientos:');
    console.table(emprendimientos.value);
    console.log('📦 Emprendimientos JSON completo:', JSON.stringify(emprendimientos.value, null, 2));
  } catch (error) {
    console.error('❌ Error al obtener emprendimientos:', error);
  }
};

const onImageLoad = (index) => {
  loadedImages.value[index] = true;
};

onMounted(() => {
  obtenerEmprendimientos();
});
</script>
<style scoped>
/* Efecto de carga blur */
img[data-loaded='false'] {
  filter: blur(12px);
  transform: scale(1.05);
  opacity: 0;
}

img[data-loaded='true'] {
  animation: fadeIn 0.6s ease-out forwards;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: scale(1.02);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
