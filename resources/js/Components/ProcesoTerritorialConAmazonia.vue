<template>
  <section id="principios" class="bg-[#FFF8EA] py-16 px-4 text-center text-gray-800">
    <div class="max-w-5xl mx-auto">
      <div class="mb-10">
        <h2 class="relative inline-block">
          <span class="text-3xl md:text-4xl font-bold mb-4">Proceso Territorial</span>
          <span class="absolute left-1/2 bottom-0 w-32 h-1 bg-green-500 transform -translate-x-1/2 translate-y-3 rounded-full"></span>
        </h2>
        <h3 class="text-lg md:text-xl text-gray-600 mt-6 max-w-3xl mx-auto">
          Impulsando la Economía Indígena Sostenible
        </h3>
      </div>

      <!-- Párrafo descriptivo -->
      <p class="text-base md:text-lg mb-12">
        En colaboración con nuestras organizaciones indígenas, hemos avanzado en la identificación y mapeo de iniciativas económicas y bioemprendimientos, categorizándolos según su nivel de desarrollo. Este enfoque está basado en los sólidos principios de la economía indígena, combinados con las demandas y requisitos del mercado occidental. A través de estos proyectos, nuestras comunidades no solo impulsan su economía local, sino que también juegan un papel clave en la protección y sostenibilidad de la Amazonía.
      </p>

      <!-- Proceso visual -->
      <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-center md:gap-6 ">
        <!-- En móvil: en bloques de dos -->
        <template v-for="(bloque, i) in bloques" :key="i">
          <div class="flex items-center justify-center gap-4 md:gap-6">
            <template v-for="(etapa, j) in bloque" :key="j">
              <!-- Imagen -->
              <div class="flex flex-col items-center group">
                <div
                  class="relative w-20 h-20 rounded-full overflow-hidden bg-cover bg-center group-hover:brightness-110 transition-all duration-300"
                  :style="{ backgroundImage: `url(${etapa.img})` }"
                >
                  <div class="absolute inset-0 bg-black bg-opacity-30 group-hover:bg-opacity-10 transition-all duration-300"></div>
                  <div class="absolute inset-0 flex items-center justify-center">
                    <component :is="etapa.icon" class="w-7 h-7 text-[#FFF8EA]" />
                  </div>
                </div>
                <span class="font-semibold mt-2">{{ etapa.nombre }}</span>
              </div>

              <!-- Línea si no es el último en el bloque -->
              <div
                v-if="j < bloque.length - 1"
                class="w-12 h-1 bg-green-800"
              ></div>
            </template>
          </div>

          <!-- Línea horizontal grande entre bloques en móvil -->
          <div
            v-if="i < bloques.length - 1"
            class="block md:hidden h-4"
          ></div>

          <!-- Línea entre bloques en desktop -->
          <div
            v-if="i < bloques.length - 1"
            class="hidden md:block w-16 h-1 bg-green-800"
          ></div>
        </template>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Leaf, TreePine, Sprout, Flower2 } from 'lucide-vue-next'

const etapas = [
  { nombre: 'Siembra', img: '/images/amazonFairTrade/Chat6.png', icon: Sprout },
  { nombre: 'Hecha raíces', img: '/images/amazonFairTrade/Chat10.png', icon: TreePine },
  { nombre: 'Cosecha', img: '/images/amazonFairTrade/Chat8.png', icon: Flower2 },
  { nombre: 'Multiplica', img: '/images/amazonFairTrade/Chat9.png', icon: Leaf }
]

// Agrupamos las etapas en bloques de dos para móviles
const bloques = []
for (let i = 0; i < etapas.length; i += 2) {
  bloques.push(etapas.slice(i, i + 2))
}
</script>
