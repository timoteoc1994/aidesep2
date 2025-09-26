<template>
  <section id="noticias" class="bg-[#FBF8F3] py-16 px-4 overflow-hidden">
    <div class="max-w-6xl mx-auto">
      <!-- Encabezado -->
      <div class="mb-16 text-center" data-aos="fade" data-aos-duration="1000">
        <h2 class="text-4xl md:text-5xl font-extrabold text-[#0D6734] relative inline-block" data-aos="fade" data-aos-duration="1200">
          <span class="relative z-10">Noticias</span>
          <div class="h-1 w-24 bg-[#244041] rounded-full mx-auto mb-6" data-aos="fade" data-aos-duration="1400"></div>
        </h2>
        <p class="text-lg text-gray-600 mt-6 max-w-3xl mx-auto" data-aos="fade" data-aos-duration="1600">
          Mantente informado con las últimas actualizaciones, eventos y logros relacionados con la conservación y las comunidades de la Amazonía.
        </p>
      </div>

      <!-- Lista dinámica de noticias -->
      <div class="space-y-20 max-h-[800px] overflow-y-auto pr-2 custom-scrollbar" data-aos="fade" data-aos-duration="1000">
        <div v-for="(noticia, index) in noticias" :key="noticia.id" class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
          <!-- Texto izquierda si index impar -->
          <div :class="index % 2 === 0 ? 'order-2 md:order-1' : 'order-1 md:order-2'">
            <h2 class="text-3xl font-semibold text-[#0D6734] mb-4" data-aos="fade" data-aos-duration="1200">
              {{ noticia.titulo }}
            </h2>
            <p class="text-gray-700 mb-3 text-justify" v-html="noticia.descripcion" data-aos="fade" data-aos-duration="1400" />
          </div>

          <!-- Imagen -->
          <div
            class="bg-[#0D6734] rounded-xl shadow-lg overflow-hidden w-full max-w-md mx-auto hover:-translate-y-2 duration-300 transition-all"
            :class="index % 2 === 0 ? 'order-1 md:order-2' : 'order-2 md:order-1'"
            data-aos="fade"
            data-aos-duration="1600"
          >
            <img
              :src="'https://amazonfairtrade.org/storage/' + noticia.imagen"
              :alt="noticia.titulo"
              class="w-full h-56 object-cover"
            />
            <div class="p-4">
              <h4 class="text-lg font-semibold text-[#FFF8EA] mb-2">{{ noticia.titulo }}</h4>
              <div class="flex items-center text-sm text-[#FFF8EA] mb-1">
                <Calendar class="w-4 h-4 mr-2" />
                {{ formatFecha(noticia.fecha) }} &nbsp; | &nbsp; {{ noticia.autor ?? 'Autor desconocido' }}
              </div>
              <div class="flex items-center text-sm text-[#FFF8EA]">
                <MapPin class="w-4 h-4 mr-2" />
                {{ noticia.ubicacion ?? 'Ubicación no especificada' }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>



<script setup>
import { ref, onMounted } from 'vue'
import { Calendar, MapPin } from "lucide-vue-next"
import axios from 'axios'

const noticias = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('/api/noticias-globales')
    noticias.value = response.data
    console.log('Noticias cargadas:', noticias.value)
  } catch (error) {
    console.error('Error cargando noticias:', error)
  }
})

function formatFecha(fecha) {
  if (!fecha) return ''
  const f = new Date(fecha)
  return f.toLocaleDateString('es-EC', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}
</script>



<style scoped>
/* Scrollbar personalizada */
.custom-scrollbar::-webkit-scrollbar {
    width: 10px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgb(13, 103, 52);
    border-radius: 9999px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: hsl(182, 29%, 20%);
    border-radius: 9999px;
    border: 2px solid rgb(13, 103, 52);
}

/* Prevenir scroll horizontal */
section#noticias {
    overflow-x: hidden;
}
</style>
