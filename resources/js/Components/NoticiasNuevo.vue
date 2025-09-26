<template>
    <section id="noticias" class="bg-white py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-16 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#124228] relative inline-block">
                    <span class="relative z-10">Noticias</span>
                    <span
                        class="absolute left-1/2 bottom-0 w-32 h-1 bg-[#73A847] transform -translate-x-1/2 translate-y-3 rounded-full"></span>
                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-3xl mx-auto">
                    Mantente informado con las últimas actualizaciones, eventos y logros relacionados con la
                    conservación y las comunidades de la Amazonía.
                </p>
            </div>

            <!-- Noticia Principal -->
            <div v-if="noticiaActiva" class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-20">
                <!-- Texto -->
                <div>
                    <h2 class="text-3xl font-semibold text-[#124228] mb-4">{{ noticiaActiva.titulo }}</h2>
                    <p class="text-gray-700 text-justify">{{ noticiaActiva.descripcion }}</p>
                </div>
                <!-- Tarjeta -->
                <div
                    class="bg-[#124228] rounded-xl shadow-lg overflow-hidden w-full max-w-md mx-auto hover:-translate-y-2 duration-300 transition-all">
                    <img :src="noticiaActiva.imagen" :alt="noticiaActiva.titulo" class="w-full h-56 object-cover" />
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-[#FFF8EA] mb-2">{{ noticiaActiva.titulo }}</h4>
                        <div class="flex items-center text-sm text-[#FFF8EA] mb-1">
                            <Calendar class="w-4 h-4 mr-2" />
                            {{ noticiaActiva.fecha }} &nbsp; | &nbsp; {{ noticiaActiva.autor }}
                        </div>
                        <div class="flex items-center text-sm text-[#FFF8EA]">
                            <MapPin class="w-4 h-4 mr-2" />
                            {{ noticiaActiva.ubicacion }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Otras noticias como tarjetas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(noticia, index) in noticiasFiltradas" :key="index"
                    class="bg-[#124228] rounded-xl shadow-lg overflow-hidden hover:-translate-y-1 duration-300 transition-all cursor-pointer"
                    @click="cambiarNoticia(noticia)">
                    <img :src="noticia.imagen" :alt="noticia.titulo" class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-[#FFF8EA] mb-2">{{ noticia.titulo }}</h4>
                        <div class="flex items-center text-sm text-[#FFF8EA] mb-1">
                            <Calendar class="w-4 h-4 mr-2" />
                            {{ noticia.fecha }} &nbsp; | &nbsp; {{ noticia.autor }}
                        </div>
                        <div class="flex items-center text-sm text-[#FFF8EA]">
                            <MapPin class="w-4 h-4 mr-2" />
                            {{ noticia.ubicacion }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Calendar, MapPin } from "lucide-vue-next"

const noticias = ref([
    {
        titulo: 'Expedición al Yasuní',
        imagen: '/images/conAmazonia/Fondo.png',
        descripcion: 'Sumérgete en una experiencia única e inolvidable con nuestra expedición al Parque Nacional Yasuní, una joya natural ubicada en el corazón de la Amazonía ecuatoriana...',
        fecha: '14–29 Junio',
        autor: 'Robbin Joseph',
        ubicacion: 'Ambato, Ecuador'
    },
    {
        titulo: 'Festival de Sabores Amazónicos',
        imagen: '/images/conAmazonia/Fondo.png',
        descripcion: 'Vive una experiencia sensorial inolvidable en el Festival de Sabores Amazónicos, donde se fusionan tradiciones culinarias ancestrales con ingredientes autóctonos...',
        fecha: '12 Julio 2025',
        autor: 'Nelly Gualinga',
        ubicacion: 'Puyo, Ecuador'
    },
    {
        titulo: 'Minga de Reforestación',
        imagen: '/images/conAmazonia/Fondo.png',
        descripcion: 'Cientos de voluntarios se unieron para plantar más de 3,000 árboles nativos en zonas degradadas de la Amazonía. La actividad fue liderada por comunidades indígenas...',
        fecha: '28 Julio 2025',
        autor: 'Luis Shiguango',
        ubicacion: 'Tena, Ecuador'
    }
])

const noticiaActiva = ref(noticias.value[0])

const noticiasFiltradas = computed(() =>
    noticias.value.filter(noticia => noticia !== noticiaActiva.value)
)

const cambiarNoticia = (noticia) => {
    noticiaActiva.value = noticia
}
</script>
