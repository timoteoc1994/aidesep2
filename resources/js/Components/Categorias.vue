<template>
    <section id="categorias" class="bg-[#FBF8F3] py-20 px-6 md:px-12 lg:px-20 text-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="inline-block mb-12 text-center w-full">
                <h2 data-aos="zoom-in" data-aos-delay="100" class="text-3xl md:text-4xl font-extrabold mb-3 leading-tight text-[#0D6734]">
                    Categorías de productos
                </h2>
                <div data-aos="zoom-in" data-aos-delay="200" class="h-1 w-24 bg-[#244041] rounded-full mx-auto"></div>
                <p data-aos="zoom-in" data-aos-delay="300" class="text-gray-700 mt-4 max-w-2xl mx-auto">
                    Descubre nuestra amplia selección de productos artesanales elaborados con técnicas ancestrales y
                    materiales sostenibles
                </p>
            </div>

            <!-- La grilla es de 1 columna en md (tablet) y 3 en lg -->
            <div data-aos="zoom-in" data-aos-delay="400" class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6">
                <div v-for="(categoria, index) in categorias" :key="categoria.nombre"
                    @click="navegarACategoria(categoria)" :class="[
                        'cursor-pointer group relative rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl border border-emerald-50 hover:-translate-y-1',
                        // Aquí se asignan las clases de responsividad directamente
                        index === 1 ? 'sm:col-span-2 md:col-span-1 lg:col-span-2' : '',
                        index === 5 ? 'sm:col-span-2 md:col-span-1 lg:col-span-2' : ''
                    ]">
                    <!-- Shimmer loading effect -->
                    <div v-if="!loadedImages[index]" class="absolute inset-0 shimmer z-10"></div>

                    <!-- Imagen de la categoría -->
                    <img :src="categoria.imagen" :alt="categoria.nombre" loading="lazy"
                        :data-loaded="loadedImages[index] ? 'true' : 'false'" @load="onImageLoad(index)"
                        class="w-full h-60 object-cover transition-all duration-500 group-hover:scale-105" />

                    <!-- Gradiente superpuesto -->
                    <div class="absolute inset-0 z-10 pointer-events-none bg-gradient-to-t from-emerald-900/90 via-emerald-800/50 to-transparent"></div>

                    <!-- Información de la categoría -->
                    <div class="absolute inset-x-0 bottom-0 z-20 p-5">
                        <h3 class="text-white font-bold text-xl drop-shadow-lg mb-1">{{ categoria.nombre }}</h3>
                        <p class="text-white/90 text-sm font-medium drop-shadow-lg max-w-xs opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                            {{ categoria.titulo }}
                        </p>
                        <div class="h-0.5 w-12 bg-white/70 rounded mb-2 transition-all duration-300 group-hover:w-20"></div>
                        <p class="text-white/90 text-sm font-medium drop-shadow-lg max-w-xs opacity-0 translate-y-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                            {{ categoria.descripcion }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { router as inertiaRouter } from '@inertiajs/vue3';

const categorias = ref([]); // Esta variable guardará las categorías
const loadedImages = ref([]); // Esta variable controlará el estado de carga de las imágenes

// Función para obtener categorías de la API
const obtenerCategorias = async () => {
    try {
        const response = await axios.get('/api/categorias');
        categorias.value = response.data;
        console.log(categorias.value);  // Verifica los datos recibidos

        loadedImages.value = new Array(categorias.value.length).fill(false);
    } catch (error) {
        console.error('Error al obtener las categorías:', error);
    }
};

// Llamar la función cuando el componente se monte
onMounted(() => {
    obtenerCategorias();
});

// Función para navegar a la categoría seleccionada
const navegarACategoria = (categoria) => {
    console.log('Categoría seleccionada:', categoria);

    if (categoria && typeof categoria === 'object' && categoria.slug) {
        const slug = categoria.slug.trim().toLowerCase();
        console.log('Slug para navegación:', slug);
        inertiaRouter.visit(`/emprendimientos/${slug}`);
    } else {
        console.error('Categoría inválida o sin slug:', categoria);
    }
};


// Función para manejar la carga de la imagen
const onImageLoad = (index) => {
    loadedImages.value[index] = true;  // Marcar la imagen como cargada
};
</script>

<style scoped>
/* ───────── Shimmer ───────── */
@keyframes shimmer {
    0% {
        background-position: -500px 0;
    }

    100% {
        background-position: 500px 0;
    }
}

.shimmer {
    background: linear-gradient(100deg,
            #d1fae5 30%,
            /* verde claro */
            #ecfdf5 45%,
            /* blanco verdoso */
            #d1fae5 60%);
    /* verde claro */
    background-size: 1000px 100%;
    animation: shimmer 1.8s infinite linear;
    transition: opacity 0.4s ease;
}


img {
    transition: filter 0.4s ease, transform 0.4s ease, opacity 0.4s ease;
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
