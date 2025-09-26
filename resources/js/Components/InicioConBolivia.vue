<template>
    <Head>
  <title>La Amazonía de Bolivia | Amazon Fair Trade</title>
  <meta
    name="description"
    content="Descubre el territorio, la cultura y el futuro de la Amazonía boliviana: biodiversidad, saberes ancestrales y economía indígena en Amazon Fair Trade."
  />
  <meta
    name="keywords"
    content="Amazonía, Bolivia, Amazon Fair Trade, territorio, cultura, biodiversidad, economía indígena, saberes ancestrales"
  />

  <!-- Open Graph -->
  <meta
    property="og:title"
    content="La Amazonía de Bolivia | Amazon Fair Trade"
  />
  <meta
    property="og:description"
    content="Adéntrate en la Amazonía boliviana: un territorio vivo de biodiversidad y tradición que impulsa una economía sostenible."
  />
  <meta property="og:type" content="website" />
  <meta
    property="og:url"
    content="https://amazonfairtrade.org/conBolivia"
  />
  <meta
    property="og:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/FondoIA.webp"
  />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta
    name="twitter:title"
    content="La Amazonía de Bolivia | Amazon Fair Trade"
  />
  <meta
    name="twitter:description"
    content="Explora la riqueza natural y cultural de la Amazonía boliviana: territorio, cultura y futuro con Amazon Fair Trade."
  />
  <meta
    name="twitter:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/FondoIA.webp"
  />

  <link
    rel="canonical"
    href="https://amazonfairtrade.org/conBolivia"
  />
</Head>

    <div id="inicio" class="relative w-full min-h-screen overflow-visible">
        <!-- Fondo con efecto parallax (ahora también en móvil pero más suave) -->
        <div class="absolute inset-0 bg-cover bg-center z-0 transition-transform duration-1000 ease-out"
            style="background-image:url('/images/amazonFairTrade/FondoIA.webp')" :style="parallaxStyle">
            <div class="absolute inset-0 bg-gradient-to-b from-[#124228]/80 via-[#124228]/50 to-[#124228]/90"></div>
        </div>

        <!-- Contenido principal -->
        <div class="relative h-full w-full flex flex-col justify-between z-10 px-6 lg:px-16 py-12">
            <!-- Contenido central -->
            <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mt-0 lg:mt-14">
                <!-- Columna izquierda - Texto principal (sin movimiento) -->
                <div class="max-w-xl mt-16" data-aos="fade-up" data-aos-duration="1000">
                    <!-- Título fijo -->

                    <img src="/images/amazonFairTrade/Bolivia-iconos.png" alt="Vue Logo" class="w-full h-auto mb-6"
                        data-aos="fade-up" data-aos-delay="100" />

                    <h1 class="font-bold leading-tight tracking-tight mb-8 mt-10 sm:mt-16 lg:mt-0 flex flex-col"
                        data-aos="fade-up" data-aos-delay="200">
                        <span class="text-[#FFF8EA] text-xl md:text-2xl lg:text-3xl">La Amazonía de Bolivia</span>
                        <span class="text-[#FFF8EA] text-lg md:text-xl lg:text-2xl">Territorio, Cultura y Futuro</span>
                    </h1>
                    <!-- Descripción fija -->
                    <p class="text-lg md:text-xl text-[#FFF8EA]/90 font-medium leading-relaxed mb-8" data-aos="fade-up"
                        data-aos-delay="400">
                        La Amazonía boliviana, hogar de 29 pueblos indígenas, es un tesoro vivo de biodiversidad y
                        tradición. Desde las comunidades cuidamos el bosque con respeto y sabiduría ancestral,
                        construyendo una economía sostenible que protege la vida y el futuro de la región.
<br><br>
                        Al elegir nuestros productos, eliges proteger la Amazonía, eliges un futuros para todos.
                    </p>
                    <!-- Botón con efecto sutil
                    <div class="transform transition-transform duration-300" data-aos="fade-up" data-aos-delay="500" >
                        <button @click="props.smoothScrollTo('categorias')"
                            class="relative flex items-center gap-2 px-6 py-2 border-2 border-[#FFF8EA] text-[#FFF8EA] rounded-full overflow-hidden group transition">
                             Fondo animado de izquierda a derecha -->
                    <span
                        class="absolute left-0 top-0 h-full w-0 bg-[#FFF8EA] group-hover:w-full transition-all duration-500 ease-out"></span>
                    <!-- Contenido del botón
                            <span class="relative z-10 group-hover:text-black transition-colors duration-500 flex items-center gap-2">
                                Leer más
                                <svg class="w-4 h-4 animate-bounce-custom" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                    </div>
                    -->
                </div>

                <!-- Columna derecha - Tarjetas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative mt-16">
                    <!-- Tarjeta 1 -->
                    <div class="bg-[#071D11]/60 backdrop-blur-md border border-[#071D11]/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-[#238473]/30 hover:-translate-y-1"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor1}px)`
                        }">
                        <!-- Imagen en lugar del icono -->
                        <img src="/images/amazonFairTrade/icono-1.png" alt="Icono Nuestra Esencia"
                            class="h-6 w-11 mb-3" />
                        <h3 class="text-lg font-bold text-[#FFF8EA] mb-2">Nuestro Origen</h3>
                        <p class="text-[#FFF8EA] text-sm leading-relaxed">
                            Los pueblos han crecido con el bosque. No viven en la Amazonía, son la Amazonía. Su
                            identidad florece entre lenguas, tradiciones y el respeto a la tierra.
                        </p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-[#071D11]/60 backdrop-blur-md border border-[#071D11]/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-[#238473]/30 hover:-translate-y-1 delay-75"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor2}px)`
                        }">
                        <img src="/images/amazonFairTrade/icono-2.png" alt="Icono Nuestra Esencia"
                            class="h-6 w-5  mb-3" />
                        <h3 class="text-lg font-bold text-[#FFF8EA] mb-2">Legado Vivo</h3>
                        <p class="text-[#FFF8EA] text-sm leading-relaxed">
                            Los saberes ancestrales siguen vivos y en constante transformación. La tradición se mantiene
                            activa en cada comunidad, guiando el presente y futuro.
                        </p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-[#071D11]/60 backdrop-blur-md border border-[#071D11]/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-[#238473]/30 hover:-translate-y-1 delay-100"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor3}px)`
                        }">
                        <img src="/images/amazonFairTrade/icono-3.png" alt="Icono Nuestra Esencia"
                            class="h-7 w-7  mb-3" />
                        <h3 class="text-lg font-bold text-[#FFF8EA] mb-2">Economía Indígena</h3>
                        <p class="text-[#FFF8EA] text-sm leading-relaxed">
                            Esta forma de economía nace del respeto por la naturaleza y la vida comunitaria. Producen
                            con identidad, cuidando el bosque y fortaleciendo su autonomía.
                        </p>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="bg-[#071D11]/60 backdrop-blur-md border border-[#071D11]/10 rounded-xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:border-[#238473]/30 hover:-translate-y-1 delay-150"
                        :style="{
                            opacity: 1 - scrollY * opacityFactor,
                            transform: `translateY(${scrollY * cardFactor4}px)`
                        }">
                        <img src="/images/amazonFairTrade/icono-4.png" alt="Icono Nuestra Esencia"
                            class="h-6 w-11  mb-3" />
                        <h3 class="text-lg font-bold text-[#FFF8EA] mb-2">Futuro Seguro</h3>
                        <p class="text-[#FFF8EA] text-sm leading-relaxed">
                            Proteger este territorio es garantizar la vida para las próximas generaciones. Trabajemos
                            por un futuro justo, sostenible y construido desde las raíces ancestrales.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import AOS from 'aos';
import 'aos/dist/aos.css';
import { Head } from '@inertiajs/vue3';

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
    AOS.init({
        once: true,
        duration: 1000,
        easing: 'ease-in-out',
    });
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
