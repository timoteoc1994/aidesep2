<template>
    <div id="inicio" class="relative w-full min-h-screen overflow-visible">

        <!-- Fondo con efecto parallax (ahora también en móvil pero más suave) -->
        <div class="absolute inset-0 bg-cover bg-center z-0 transition-transform duration-1000 ease-out"
            style="background-image:url('/images/amazonFairTrade/Fondo.webp')" :style="parallaxStyle">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-emerald-900/30 to-black/70"></div>
        </div>

        <!-- Contenido principal -->
        <div class="relative h-full w-full flex flex-col justify-between z-10 px-6 lg:px-16 py-12">
            <!-- Contenido central -->
            <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mt-0 lg:mt-28">

                <!-- Columna izquierda - Texto principal (sin movimiento) -->
                <div class="max-w-2xl">
                    <!-- Título fijo -->
                    <h1
                        class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight tracking-tight mb-8 mt-10 sm:mt-16 lg:mt-0">
                        <span class="text-white">Amazon</span>
                        <span class="text-emerald-400"> Fair Trade</span>
                    </h1>
                    <!-- Descripción fija -->
                    <p class="text-xl md:text-2xl text-white/90 font-medium leading-relaxed mb-1">
                        Plataforma digital que conecta la sabiduría ancestral amazónica con mercados globales a través
                        de bioemprendimientos sostenibles.
                    </p>

                    <!-- Frase secundaria justo debajo -->
                    <div class="text-white/60 text-md md:text-lg mb-8">
                        Conectando el mundo con la sabiduría de la Amazonía
                    </div>

                    <!-- Botón con efecto sutil
                    <div class="transform transition-transform duration-300 ">
                        <button @click="props.smoothScrollTo('sabiduria')"
                            class="relative flex items-center gap-2 px-6 py-2 border-2 border-[#FFF8EA] text-[#FFF8EA] rounded-full overflow-hidden group transition">
                             Fondo animado de izquierda a derecha -->
                            <span
                                class="absolute left-0 top-0 h-full w-0 bg-[#FFF8EA] group-hover:w-full transition-all duration-500 ease-out"></span>
                            <!-- Contenido del botón
                            <span
                                class="relative z-10 group-hover:text-black transition-colors duration-500 flex items-center gap-2">
                                Leer más
                                <svg class="w-4 h-4 animate-bounce-custom" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    -->
                </div>

                <!-- Columna derecha - Tarjetas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative">
                    <!-- Tarjeta 1 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-emerald-400/30 hover:-translate-y-1"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor1}px)`
                        }">
                        <div class="text-emerald-400 mb-3 text-2xl">🌿</div>
                        <h3 class="text-xl font-bold text-white mb-2">Economía Indígena</h3>
                        <p class="text-white/80 text-sm leading-relaxed">
                            Valorización de los saberes tradicionales en un modelo de producción sostenible que
                            beneficia directamente a las comunidades.
                        </p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-emerald-400/30 hover:-translate-y-1 delay-75"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor2}px)`
                        }">
                        <div class="text-emerald-400 mb-3 text-2xl">🛡️</div>
                        <h3 class="text-xl font-bold text-white mb-2">Conservación</h3>
                        <p class="text-white/80 text-sm leading-relaxed">
                            Los pueblos indígenas como guardianes esenciales del bioma amazónico, asegurando su
                            conservación para el futuro.
                        </p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-emerald-400/30 hover:-translate-y-1 delay-100"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor3}px)`
                        }">
                        <div class="text-emerald-400 mb-3 text-2xl">⚖️</div>
                        <h3 class="text-xl font-bold text-white mb-2">Comercio Justo</h3>
                        <p class="text-white/80 text-sm leading-relaxed">
                            Relaciones comerciales equitativas que generan impacto positivo en las comunidades locales y
                            el ecosistema.
                        </p>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-emerald-400/30 hover:-translate-y-1 delay-150"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor4}px)`
                        }">
                        <div class="text-emerald-400 mb-3 text-2xl">♻️</div>
                        <h3 class="text-xl font-bold text-white mb-2">Sostenibilidad</h3>
                        <p class="text-white/80 text-sm leading-relaxed">
                            Nuevo paradigma de desarrollo basado en la valorización de los servicios ecosistémicos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'

const props = defineProps({
    smoothScrollTo: Function
})

const scrollY = ref(0)
const scaleFactor = ref(0.0005)
const opacityFactor = ref(0.002)
const cardFactor1 = ref(0.02)
const cardFactor2 = ref(0.03)
const cardFactor3 = ref(0.04)
const cardFactor4 = ref(0.05)

const handleScroll = () => {
    scrollY.value = window.scrollY
}

const handleResize = () => {
    const width = window.innerWidth
    if (width < 768) {
        // En móviles: reducir los efectos
        scaleFactor.value = 0.0003
        opacityFactor.value = 0.001
        cardFactor1.value = 0.01
        cardFactor2.value = 0.015
        cardFactor3.value = 0.02
        cardFactor4.value = 0.025
    } else {
        // En pantallas grandes: aplicar efectos completos
        scaleFactor.value = 0.0005
        opacityFactor.value = 0.002
        cardFactor1.value = 0.02
        cardFactor2.value = 0.03
        cardFactor3.value = 0.04
        cardFactor4.value = 0.05
    }
}

onMounted(() => {
    handleResize()
    window.addEventListener('scroll', handleScroll)
    window.addEventListener('resize', handleResize)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
    window.removeEventListener('resize', handleResize)
})

const parallaxStyle = computed(() => ({
    transform: `scale(${1 + scrollY.value * scaleFactor.value})`
}))
</script>


<style scoped>
/* ───────── Flecha animada ───────── */
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

/* ───────── Animación de flecha con más suavidad ───────── */
@keyframes bounce-smooth {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-3px);
        /* Reducir la distancia del rebote */
    }
}

.animate-bounce-custom {
    animation: bounce-smooth 1.5s ease-in-out infinite;
}
</style>
