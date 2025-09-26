<template>
  <section id="categorias" class="bg-[#124228] py-20 px-6 md:px-12 lg:px-20">
    <div class="max-w-6xl mx-auto">
      <div class="inline-block mb-12 text-center w-full" data-aos="fade-up" data-aos-duration="1000">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-3 leading-tight text-[#FFF8EA]" data-aos="fade-up" data-aos-duration="1200">
          Impulsando el Valor de los Emprendimientos Indígenas Amazónicos
        </h2>
        <div class="h-1 w-24 bg-[#73A847] rounded-full mx-auto" data-aos="fade-up" data-aos-duration="1400"></div>
        <p class="text-[#FFF8EA] mt-4 max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="1600">
          El proceso comenzó con el mapeo de 81 emprendimientos, clasificándolos en cuatro niveles de
          desarrollo. Esta categorización se inspira en el ciclo de vida de una planta, representando el
          crecimiento y la maduración de los emprendimientos dentro del sistema chakra.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-duration="1800">
        <div v-for="(categoria, index) in categoriasFiltradas" :key="categoria.nombre"
          @click="toggleFlip(index)" :class="[
            'flip-card group relative rounded-xl transition-all duration-300 border border-[#124228b9]',
            index === 0 || index === 3 ? 'lg:col-span-1' : 'lg:col-span-2'
          ]">
          <div class="flip-card-inner" :class="{ flipped: flippedCards[index] }">
            <!-- Cara frontal -->
            <div class="flip-card-front rounded-xl overflow-hidden">
              <div v-if="!loadedImages[index]" class="absolute inset-0 shimmer z-10"></div>
              <img :src="categoria.imagen" :alt="categoria.nombre" loading="lazy"
                :data-loaded="loadedImages[index] ? 'true' : 'false'" @load="onImageLoad(index)"
                class="w-full h-60 object-cover transition-all duration-500 group-hover:scale-105 rounded-xl" />
              <div
                class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-t from-emerald-900/90 via-emerald-800/50 to-transparent rounded-xl">
              </div>
              <div class="absolute inset-x-0 bottom-0 z-20 p-5">
                <h3 class="text-white font-bold text-xl drop-shadow-lg">{{ categoria.nombre }}</h3>
                <div class="h-0.5 w-12 bg-white/70 rounded mb-2 transition-all duration-300 group-hover:w-20"></div>
              </div>
            </div>

            <!-- Cara trasera -->
            <div class="flip-card-back bg-cover bg-center text-white p-6 rounded-xl flex flex-col items-center justify-center text-center relative"
              :style="`background-image: url('${categoria.imagen}')`">
              <div class="absolute inset-0 bg-[#124228]/80 rounded-xl z-0"></div>
              <div class="relative z-10">
                <h3 class="text-white font-bold text-xl drop-shadow-lg mb-3">
                  {{ categoria.nombre }}
                </h3>
                <p class="text-sm leading-relaxed">
                  {{ categoria.descripcion }}
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const categoriasFiltradas = [
  {
    nombre: 'Siembra',
    imagen: '/images/conAmazonia/semilla1.png',
    descripcion:
      'Como una semilla que inicia su camino, esta etapa representa emprendimientos en sus primeras fases. Son iniciativas emergentes, muchas aún no formalizadas, que funcionan como medios de subsistencia. Aunque están en construcción, tienen el potencial de crecer y consolidarse con el tiempo.'
  },
  {
    nombre: 'Hecha raíces',
    imagen: '/images/conAmazonia/raices2.jpg',
    descripcion:
      'Aquí el emprendimiento comienza a fortalecerse, como una planta que afirma sus raíces. Ya están legalmente constituidos, cumplen con requisitos básicos y generan ingresos. Comienzan a organizar su contabilidad y se conectan más con la comunidad y la naturaleza, preparando el terreno para un crecimiento sostenible.'
  },
  {
    nombre: 'Cosecha',
    imagen: '/images/conAmazonia/cosecha.jpg',
    descripcion:
      'El emprendimiento ha madurado. Cuenta con todos los permisos y formalidades, y su administración está organizada. Genera ingresos justos para toda la cadena de valor y se articula con las estructuras de gobernanza indígena, aportando al bienestar colectivo y a la protección del medioambiente.'
  },
  {
    nombre: 'Multiplica',
    imagen: '/images/conAmazonia/semilla1.png',
    descripcion:
      'Ya consolidado, el emprendimiento empieza a expandirse, como una planta que da nuevas semillas. Aumenta su impacto social y económico, accede a mercados regionales y establece relaciones sólidas de redistribución. Su acción va más allá del negocio: revitaliza economías locales y protege la Amazonía.'
  }
]

const loadedImages = ref(Array(categoriasFiltradas.length).fill(false))
const flippedCards = ref(Array(categoriasFiltradas.length).fill(false))

const onImageLoad = (index) => {
  loadedImages.value[index] = true
}

const toggleFlip = (index) => {
  flippedCards.value[index] = !flippedCards.value[index]
}
</script>

<style scoped>
.flip-card {
  perspective: 1000px;
  height: 240px;
  position: relative;
}

.flip-card-inner {
  width: 100%;
  height: 100%;
  position: relative;
  transform-style: preserve-3d;
  transition: transform 0.8s;
}

.flip-card:hover .flip-card-inner,
.flip-card-inner.flipped {
  transform: rotateY(180deg);
}

.flip-card-front,
.flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 0.75rem;
}

.flip-card-front {
  z-index: 2;
}

.flip-card-back {
  transform: rotateY(180deg);
}

@keyframes shimmer {
  0% {
    background-position: -500px 0;
  }
  100% {
    background-position: 500px 0;
  }
}

.shimmer {
  background: linear-gradient(100deg, #d1fae5 30%, #ecfdf5 45%, #d1fae5 60%);
  background-size: 1000px 100%;
  animation: shimmer 1.8s infinite linear;
  transition: opacity 0.4s ease;
}

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
