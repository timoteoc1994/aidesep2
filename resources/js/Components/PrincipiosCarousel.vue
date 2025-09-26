<template>
    <section id="principios" class="bg-[#FBF8F3] pt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="zoom-in" data-aos-delay="100" class="mb-12 items-center text-center">
                <h2 class="relative inline-block">
                    <img src="/images/amazonFairTrade/base-linea-dorada.png" alt="Productos sostenibles"
                        class="w-1/2 object-cover rounded-xl mx-auto mb-4" />
                    <span class="text-2xl md:text-3xl font-bold text-center text-[#AB8219]">Nuestros Principios</span>
                    <span
                        class="absolute left-1/2 bottom-0 w-32 h-1 bg-[#0D6734] transform -translate-x-1/2 translate-y-3 rounded-full"></span>
                </h2>
            </div>
            <div data-aos="zoom-in" data-aos-delay="200" class="relative">
                <Swiper :modules="modules" :slides-per-view="1" :space-between="30" :breakpoints="{
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }" :navigation="{
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }" :loop="true" class="principles-swiper">
                    <SwiperSlide v-for="(item, index) in principles" :key="index" class="pb-12">
                        <div class="bg-cover bg-center rounded-xl overflow-hidden shadow-md w-full h-[320px] relative transform transition-transform duration-300 hover:-translate-y-2 mt-2 text-white"
                            :style="{ backgroundImage: `url(${item.image})` }">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-50 hover:bg-opacity-30 hover:brightness-110 transition-all duration-300 flex flex-col items-center justify-center p-6 text-center">
                                <div
                                    class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-md">
                                    <component :is="getIconComponent(item.icon)" class="w-8 h-8 text-[#022601]" />
                                </div>
                                <h3 class="text-xl font-bold mb-3">{{ item.title }}</h3>
                                <p class="text-sm leading-relaxed">{{ item.description }}</p>
                            </div>
                        </div>
                    </SwiperSlide>

                </Swiper>

                <!-- Navigation buttons con mejor posicionamiento -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/navigation'
import { Navigation } from 'swiper/modules'
import { defineAsyncComponent, computed } from 'vue'

const modules = [Navigation]

function getIconComponent(iconName) {
    return defineAsyncComponent(() =>
        import(`lucide-vue-next`).then(module => module[iconName])
    )
}


const principles = [
    {
        title: 'Autonomía',
        description: 'Trabajamos de acuerdo con nuestros valores culturales, fortaleciendo la toma de decisiones propia dentro del marco de la gobernanza indígena.',
        image: '/images/amazonFairTrade/Chat2.png',
        icon: 'Crown'
    },
    {
        title: 'Autosuficiencia',
        description: 'Desarrollamos nuestras actividades desde la acción colectiva, pensando en el conjunto familiar y comunitario, en el marco de la gobernanza indígena.',
        image: '/images/amazonFairTrade/Chat.png',
        icon: 'Users'
    },
    {
        title: 'Solidaridad',
        description: 'Practicamos el apoyo mutuo como base de nuestra organización comunitaria y desarrollo sostenible.',
        image: '/images/amazonFairTrade/Chat3.png',
        icon: 'Handshake'
    },
    {
        title: 'Respeto',
        description: 'Valoramos y protegemos nuestras tradiciones, conocimientos ancestrales y relación con la naturaleza.',
        image: '/images/amazonFairTrade/Chat4.png',
        icon: 'Leaf'
    },
    {
        title: 'Sostenibilidad',
        description: 'Implementamos prácticas que aseguran el equilibrio entre el desarrollo comunitario y la conservación ambiental.',
        image: '/images/amazonFairTrade/Chat5.png',
        icon: 'Recycle'
    }
]
</script>

<style>
/* Añadir posición relativa al contenedor */
.principles-swiper {
    position: relative;
    z-index: 1;
}

.swiper-button-next,
.swiper-button-prev {
    background-color: rgba(255, 255, 255, 0.2);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
    z-index: 50;
    /* Valor más alto para asegurarnos que esté por encima */
    top: 50%;
    transform: translateY(-50%);
}

/* Mejorando el posicionamiento horizontal */
.swiper-button-prev {
    left: 5px;
    position: absolute;
}

.swiper-button-next {
    right: 5px;
    position: absolute;
}

/* Hover efecto */
.swiper-button-next:hover,
.swiper-button-prev:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

/* Tamaño del ícono dentro */
.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 16px;
    font-weight: bold;
    color: white;
}

/* Asegurar que las cards tengan un z-index correcto */
.swiper-slide {
    z-index: 1;
}
</style>
