<template>
    <section
      class="relative py-16 px-4 text-center bg-cover bg-center bg-no-repeat"
      style="background-image: url('/images/amazonFairTrade/dark-jungle.jpg')"
    >
      <!-- Capa negra translúcida que cubre toda la imagen -->
      <div class="absolute inset-0 bg-black bg-opacity-65"></div>

      <!-- Contenido principal con posicionamiento relativo para sobresalir del fondo -->
      <div class="relative z-10 max-w-5xl mx-auto">
        <div data-aos="zoom-in" data-aos-delay="100" class="mb-10">
          <h2 class="relative inline-block">
            <span class="text-3xl md:text-4xl font-bold mb-4 text-[#AB8219]">Proceso Territorial</span>
          </h2>
          <h3 class="text-lg md:text-xl text-[#AB8219] mt-6 max-w-3xl mx-auto font-medium">
            Impulsando la Economía Indígena Sostenible
          </h3>
        </div>

        <p data-aos="zoom-in" data-aos-delay="200" class="text-base md:text-lg mb-12 text-[#FBF8F3] font-medium">
            En colaboración con nuestras organizaciones indígenas, hemos avanzado en la identificación y mapeo de iniciativas económicas y bioemprendimientos, categorizándolos según su nivel de desarrollo. Este enfoque está basado en los sólidos principios de la economía indígena, combinados con las demandas y requisitos del mercado occidental. A través de estos proyectos, nuestras comunidades no solo impulsan su economía local, sino que también juegan un papel clave en la protección y sostenibilidad de la Amazonía.
        </p>

        <div data-aos="zoom-in" data-aos-delay="200" class="flex flex-col gap-6 md:flex-row md:items-center md:justify-center md:gap-6 mb-12">
          <template v-for="(bloque, i) in bloques" :key="i">
            <div class="flex items-center justify-center gap-4 md:gap-6">
              <template v-for="(etapa, j) in bloque" :key="j">
                <div class="flex flex-col items-center group">
                    <div
  class="relative w-20 h-20 rounded-full overflow-hidden bg-cover bg-center transition-all duration-300 group-hover:brightness-110 border-2 border-transparent group-hover:border-[#AB8219]"
  :style="{ backgroundImage: `url(${etapa.img})` }"
>

                    <div class="absolute inset-0 bg-black bg-opacity-30 group-hover:bg-opacity-10 transition-all duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                      <component :is="etapa.icon" class="w-7 h-7 text-white" />
                    </div>
                  </div>
                  <span data-aos="zoom-in" data-aos-delay="300" class="font-medium mt-2 text-[#AB8219]">{{ etapa.nombre }}</span>
                </div>
                <div v-if="j < bloque.length - 1" class="w-12 h-1 bg-[#AB8219]"></div>
              </template>
            </div>

            <div v-if="i < bloques.length - 1" class="block md:hidden h-4"></div>
            <div v-if="i < bloques.length - 1" class="hidden md:block w-16 h-1 bg-[#AB8219]"></div>
          </template>
        </div>

        <p data-aos="zoom-in" data-aos-delay="400" class="text-base md:text-lg text-[#FBF8F3] font-medium">
            Al invertir en esta visión, estás contribuyendo a un modelo económico innovador, basado en la armonía entre el conocimiento ancestral y las oportunidades del mercado global, con un fuerte compromiso con la preservación del medio ambiente y el bienestar de las comunidades indígenas. ¡Únete a nosotros en esta transformación hacia un futuro más sostenible y próspero!
        </p>
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

  const bloques = []
  for (let i = 0; i < etapas.length; i += 2) {
    bloques.push(etapas.slice(i, i + 2))
  }
  </script>
