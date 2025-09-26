<template>
  <Head>
    <title>Con Amazonia | Conexión, Cultura y Sostenibilidad</title>
    <meta
      name="description"
      content="Desde el corazón de la selva, los pueblos indígenas protegen la vida, impulsan economías sostenibles y comparten su sabiduría ancestral en Con Amazonia."
    />
    <meta
      name="keywords"
      content="Con Amazonia, Amazonía, pueblos indígenas, cultura, sostenibilidad, economía ancestral, conexión, biodiversidad"
    />

    <!-- Open Graph -->
    <meta property="og:title" content="Con Amazonia | Conexión, Cultura y Sostenibilidad" />
    <meta
      property="og:description"
      content="Explora iniciativas indígenas que protegen la Amazonía, fomentan economías sostenibles y preservan la cultura ancestral."
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://conamazonia.com/" />
    <meta
      property="og:image"
      content="https://conamazonia.com/images/conAmazonia/Patrones.webp"
    />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Con Amazonia | Conexión, Cultura y Sostenibilidad" />
    <meta
      name="twitter:description"
      content="Con Amazonia une a pueblos indígenas, cultura y sostenibilidad para proteger la Amazonía."
    />
    <meta
      name="twitter:image"
      content="https://conamazonia.com/images/conAmazonia/Patrones.webp"
    />

    <link rel="canonical" href="https://conamazonia.com/" />
  </Head>

  <div id="inicio" class="relative w-full h-screen overflow-hidden">
    <!-- Slides Container -->
    <div class="relative w-full h-full">
      <div
        v-for="(slide, i) in slides"
        :key="i"
        class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
        :class="currentIndex === i ? 'opacity-100 z-20' : 'opacity-0 z-10'"
      >
        <div class="w-full h-full bg-center bg-cover" :style="{ backgroundImage: `url(${slide.src})` }">
          <div class="absolute inset-0 bg-gradient-to-b from-[#124228]/60 via-[#124228]/30 to-[#124228]/90"></div>
          <div class="relative z-30 max-w-3xl mx-6 lg:mx-20 text-left h-full flex flex-col justify-end pb-20">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-lg">{{ slide.title }}</h2>
            <p class="mt-4 text-base md:text-lg text-[#FFF8EA]/90 max-w-xl">{{ slide.description }}</p>
          </div>
        </div>
      </div>

      <!-- Prev / Next -->
      <button @click="prev" class="absolute left-6 top-1/2 transform -translate-y-1/2 z-40 p-3 rounded-full bg-black/40 hover:bg-black/60 text-white" aria-label="Anterior">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
      </button>
      <button @click="next" class="absolute right-6 top-1/2 transform -translate-y-1/2 z-40 p-3 rounded-full bg-black/40 hover:bg-black/60 text-white" aria-label="Siguiente">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
      </button>

      <!-- Indicators -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-40 flex items-center gap-3">
        <button v-for="(s, idx) in slides" :key="idx" @click="goTo(idx)" :class="currentIndex === idx ? 'w-4 h-4 rounded-full bg-white' : 'w-3 h-3 rounded-full bg-white/60'" class="transition-all duration-300" aria-label="Ir a slide"></button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import AOS from 'aos';
import 'aos/dist/aos.css';
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  smoothScrollTo: Function
})

// Variables para el slider
const slides = [
  { src: '/storage/amazonFairTrade/Bienvenida.webp', title: 'Economía indígena', description: 'Tejiendo e innovando un proceso económico autónomo con identidad.' },
  { src: '/storage/amazonFairTrade/Bienvenida.webp', title: 'Protegiendo la Amazonía', description: 'Iniciativas locales que conservan la biodiversidad y la cultura.' },
  { src: '/storage/amazonFairTrade/Bienvenida.webp', title: 'Cultura y Sostenibilidad', description: 'Artesanías y conocimientos ancestrales para las futuras generaciones.' }
]

const currentIndex = ref(0)
const interval = ref(null)
const delay = 4000

// Variables necesarias para compatibilidad (aunque no se usen visiblemente)
const scrollY = ref(0)
const scaleFactor = ref(0.0005)
const opacityFactor = ref(0.002)
const cardFactor1 = ref(0.02)
const cardFactor2 = ref(0.03)
const cardFactor3 = ref(0.04)
const cardFactor4 = ref(0.05)

// Funciones del slider
const start = () => { stop(); interval.value = setInterval(() => { currentIndex.value = (currentIndex.value + 1) % slides.length }, delay) }
const stop = () => { if (interval.value) { clearInterval(interval.value); interval.value = null } }
const prev = () => { currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length; start() }
const next = () => { currentIndex.value = (currentIndex.value + 1) % slides.length; start() }
const goTo = (i) => { currentIndex.value = i; start() }

const handleVisibility = () => { if (document.hidden) stop(); else start() }

// Funciones necesarias para compatibilidad
const handleScroll = () => {
    scrollY.value = window.scrollY
}

const handleResize = () => {
    const width = window.innerWidth
    if (width < 768) {
        scaleFactor.value = 0.0003
        opacityFactor.value = 0.001
        cardFactor1.value = 0.01
        cardFactor2.value = 0.015
        cardFactor3.value = 0.02
        cardFactor4.value = 0.025
    } else {
        scaleFactor.value = 0.0005
        opacityFactor.value = 0.002
        cardFactor1.value = 0.02
        cardFactor2.value = 0.03
        cardFactor3.value = 0.04
        cardFactor4.value = 0.05
    }
}

const parallaxStyle = computed(() => ({
    transform: `scale(${1 + scrollY.value * scaleFactor.value})`
}))

onMounted(() => {
    // Inicializar slider
    start()
    window.addEventListener('visibilitychange', handleVisibility)
    
    // Inicializar dependencias necesarias para compatibilidad
    handleResize()
    window.addEventListener('scroll', handleScroll)
    window.addEventListener('resize', handleResize)
    AOS.init({
        once: true,
        duration: 1000,
        easing: 'ease-in-out',
    });
})

onUnmounted(() => {
    // Limpiar slider
    stop()
    window.removeEventListener('visibilitychange', handleVisibility)
    
    // Limpiar dependencias
    window.removeEventListener('scroll', handleScroll)
    window.removeEventListener('resize', handleResize)
})
</script>

<style scoped>
.bg-cover { background-size: cover; background-position: center; }

/* Estilos necesarios para compatibilidad */
@keyframes subtleBounce {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
  100% {
    transform: translateY(0);
  }
}

.arrow-bounce {
  animation: subtleBounce 2s ease-in-out infinite;
}

@keyframes bounce-smooth {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-3px);
  }
}

.animate-bounce-custom {
  animation: bounce-smooth 1.5s ease-in-out infinite;
}

@media (max-width: 768px) { 
  h2 { font-size: 1.6rem; } 
}
</style>

<style scoped>
.bg-cover { background-size: cover; background-position: center; }
@media (max-width: 768px) { h2 { font-size: 1.6rem; } }
</style>
