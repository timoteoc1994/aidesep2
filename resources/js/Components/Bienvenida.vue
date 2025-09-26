<template>
  <section class="w-full px-6 md:px-12 lg:px-20 bg-[#FBF8F3] text-gray-800 pt-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
      <!-- Columna Izquierda: Imagen de fondo -->
      <div data-aos="zoom-in" data-aos-delay="100" class="relative w-full h-[500px] md:h-auto mt-2 rounded-lg shadow-md overflow-hidden">
        <img src="/images/amazonFairTrade/Bienvenida.webp" alt="Amazonía" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black bg-opacity-30" />
      </div>

      <!-- Columna Derecha: Textos informativos -->
      <div>
        <div data-aos="zoom-in" data-aos-delay="200" class="max-h-[350px] overflow-y-auto pr-2 scrollbar-hide">
          <div
            v-for="(item, index) in infoBloques"
            :key="index"
            class="border-b border-[#ab821a] pb-4 mb-4"
          >
            <h3 class="text-xl font-semibold text-[#ab821a]">{{ item.title }}</h3>
            <p class="text-base leading-relaxed text-[#244040] mt-2">
              {{ item.content }}
            </p>
          </div>
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="mt-4 md:mt-5">
          <h2 class="text-3xl font-extrabold mb-1 text-[#ab821a]">¿Qué es la economía indígena?</h2>
          <div class="h-1 w-24 rounded-full mb-6 bg-[#0D6734]" />
          <p class="text-base leading-relaxed text-[#244040]">
            La Economía Indígena es un sistema de producción, distribución y consumo basado en los principios de sostenibilidad, reciprocidad y equilibrio con la naturaleza. A diferencia de los modelos económicos convencionales, que priorizan el crecimiento y la acumulación de riqueza, la economía indígena se fundamenta en el respeto a la Tierra, el bienestar colectivo y la transmisión del conocimiento ancestral.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const infoBloques = [
  {
    title: 'Conectando al mundo',
    content: 'Una plataforma digital que impulsa bioemprendimientos basados en la Economía Indígena...'
  },
  {
    title: 'Comercio justo y sostenible',
    content: 'Facilitamos el acceso de productos indígenas al mercado global de forma justa y respetuosa...'
  }
]
</script>
