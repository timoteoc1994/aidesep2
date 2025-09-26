<script setup>
import { ref } from 'vue'
import { Diamond } from 'lucide-vue-next'

const avatarLoaded = ref(false)
</script>

<template>
  <section
    id="nosotros"
    class="relative bg-cover bg-center text-[#FBF8F3] py-20 px-6 md:px-12 lg:px-20"
    style="background-image: url('/images/amazonFairTrade/sunny-tropical.jpg')"
  >
    <!-- overlay semitransparente -->
    <div class="absolute inset-0 bg-black bg-opacity-75"></div>

    <!-- TODO el contenido va en un contenedor con z-10 -->
    <div class="relative z-10 max-w-6xl mx-auto space-y-16">
      <!-- CABECERA -->
      <div data-aos="zoom-in" data-aos-delay="300" class="text-center space-y-6 max-w-6xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[#AB8219]">
          Amazon Fair Trade es una iniciativa del Programa Regional de Economía
          Indígena de la COICA
        </h2>
        <p class="leading-relaxed">
            Nuestro propósito es transformar la economía de la Amazonia mediante un enfoque sostenible y basado en el conocimiento ancestral de los pueblos indígenas.
        </p>
        <p class="leading-relaxed">
            Impulsamos un nuevo paradigma de desarrollo, donde la valorización de los servicios ecosistémicos es clave para mantener el equilibrio ambiental necesario para la producción de bienes y servicios. Los pueblos indígenas, como guardianes de estos ecosistemas, desempeñan un papel fundamental en su conservación y aprovechamiento sostenible.
        </p>
      </div>

      <!-- TARJETA CENTRAL -->
      <div data-aos="zoom-in" data-aos-delay="400" class="mx-auto p-8 border-2 rounded-xl border-[#AB8219] max-w-6xl">
  <div class="flex flex-col items-center md:flex-row md:items-start gap-6">
    <!-- AVATAR -->
    <div data-aos="zoom-in" data-aos-delay="400" class="flex-shrink-0 mx-auto">
      <div class="relative w-56 h-56 rounded-2xl overflow-hidden shadow-lg">
        <div v-show="!avatarLoaded" class="absolute inset-0 shimmer z-0"></div>
        <img
          src="/images/amazonFairTrade/FanyKuiru.webp"
          alt="Fany Kuiru"
          loading="lazy"
          decoding="async"
          fetchpriority="low"
          :data-loaded="avatarLoaded"
          @load="avatarLoaded = true"
          class="w-full h-full object-cover transition-[opacity,filter,transform] duration-700 ease-out z-10"
        />
      </div>
    </div>

    <!-- TEXTO PERFIL -->
    <div data-aos="zoom-in" data-aos-delay="500" class="mt-6 md:mt-0 text-center md:text-left flex-1">
      <h3 class="text-2xl font-serif font-semibold text-[#FBF8F3] mb-1">
        Fany Kuiru Castro
      </h3>
      <p class="text-sm font-medium text-[#FBF8F3] uppercase tracking-wider mb-4">
        Coordinadora General de COICA
      </p>
      <img
        src="/images/amazonFairTrade/base-linea-dorada.png"
        alt="Productos sostenibles"
        class="h-8 object-cover rounded-xl mb-4 mx-auto md:mx-0"
      />
      <blockquote class="leading-relaxed text-[#FBF8F3] font-bold">
        “En la Amazonía, la sostenibilidad no es una meta, es una forma de vida. Por eso, hoy la economía indígena es una alternativa de vida en la Amazonía y no solamente para los pueblos indígenas, sino para toda la región. De esta manera mejoramos la calidad de vida de las comunidades mientras cuidamos el medio ambiente, la biodiversidad y el territorio.”
      </blockquote>
    </div>
  </div>
</div>


      <!-- PÁRRAFOS FINALES -->
      <div data-aos="zoom-in" data-aos-delay="600" class="max-w-6xl mx-auto space-y-6 text-center">
        <p>
            A nivel territorial, tiene como objetivo fortalecer la estructura de gobernanza indígena, promoviendo la visibilidad de los principios fundamentales de la economía indígena y los sistemas de conocimiento ancestral. Además, fomenta la implementación de esta visión en la gestión integral del territorio, con el fin de mejorar la calidad de vida de los pueblos indígenas y preservar su identidad cultural.
        </p>
        <p>
            En este marco, se aborda todo el proceso económico en la Amazonía, destacando la necesidad de que sea un enfoque sinérgico entre los conocimientos y mecanismos occidentales, que garantizan el acceso al mercado, y los saberes ancestrales, que aseguran la conservación del bioma, vital para el planeta.
        </p>
      </div>
    </div>
  </section>
</template>

<style scoped>
@keyframes shimmer {
  0% {
    background-position: -500px 0;
  }
  100% {
    background-position: 500px 0;
  }
}
.shimmer {
  background: linear-gradient(
    100deg,
    #d1fae5 30%,
    #ecfdf5 45%,
    #d1fae5 60%
  );
  background-size: 1000px 100%;
  animation: shimmer 1.8s infinite linear;
}

img[data-loaded="false"] {
  filter: blur(12px);
  transform: scale(1.05);
  opacity: 0;
}
img[data-loaded="true"] {
  filter: none;
  transform: none;
  opacity: 1;
}
</style>
