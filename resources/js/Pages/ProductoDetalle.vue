<template>
    <Head>
  <title>{{ producto.nombre }} | Amazon Fair Trade</title>
  <meta name="description" :content="producto.descripcion || 'Descubre productos únicos de la Economía Indígena amazónica en Amazon Fair Trade.'" />

  <!-- Open Graph -->
  <meta property="og:title" :content="producto.nombre + ' | Amazon Fair Trade'" />
  <meta property="og:description" :content="producto.descripcion || 'Apoya bioemprendimientos amazónicos y su cultura ancestral.'" />
  <meta property="og:type" content="product" />
  <meta property="og:url" :content="`https://amazonfairtrade.org/producto/${producto.slug || producto.id}`" />
  <meta property="og:image" :content="`https://amazonfairtrade.org/storage/${producto.imagen}`" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" :content="producto.nombre + ' | Amazon Fair Trade'" />
  <meta name="twitter:description" :content="producto.descripcion || 'Descubre productos amazónicos con valor cultural y natural.'" />
  <meta name="twitter:image" :content="`https://amazonfairtrade.org/storage/${producto.imagen}`" />

  <link rel="canonical" :href="`https://amazonfairtrade.org/producto/${producto.slug || producto.id}`" />
</Head>

    <section class="py-16 px-6 md:px-12 lg:px-20 border-t-2" :style="{
        backgroundColor: producto.emprendimiento?.color_secundario_2 || '#fff',
        borderColor: producto.emprendimiento?.color_principal_1 || '#000'
    }">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Columna 1: Imágenes -->
            <div class="relative">
                <!-- Botón volver -->
                <div class="mb-8">
                    <button @click="volverAtras" class="inline-flex items-center transition-colors"
                        @mouseover="hoverColor = producto.emprendimiento?.color_principal_1 || '#000'"
                        @mouseleave="hoverColor = producto.emprendimiento?.color_secundario_1 || '#000'"
                        :style="{ color: hoverColor }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver al catálogo
                    </button>
                </div>

                <!-- Imagen principal -->
                <div class="mb-6 flex justify-center">
                    <img :src="`https://amazonfairtrade.org/storage/${imagenPrincipal}`" :alt="producto.nombre"
                        class="w-full h-96 object-cover object-center cursor-pointer shadow-md rounded-lg"
                        @click="cambiarImagen(imagenPrincipal, true)" />
                </div>

                <!-- Imágenes secundarias -->
                <div class="grid grid-cols-3 gap-4 justify-items-center">
                    <img v-for="(imagen, index) in imagenesSecundarias" :key="index"
                        :src="`https://amazonfairtrade.org/storage/${imagen}`" :alt="`Imagen ${index + 1}`"
                        @click="cambiarImagen(imagen)"
                        class="w-full h-28 object-cover rounded-lg cursor-pointer shadow-md hover:-translate-y-2 duration-300 transition-all" />
                </div>
            </div>

            <!-- Columna 2: Información del producto -->
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold pt-10 "
                    :style="{ color: producto.emprendimiento?.color_secundario_1 || '#000' }">
                    {{ producto.nombre }}
                </h1>
                <div class="h-1 w-24 rounded-full mt-1"
                    :style="{ backgroundColor: producto.emprendimiento?.color_principal_1 || '#000' }"></div>

                <!-- Presentaciones -->
                <div v-if="parseEtiquetas(producto.etiquetas_presentacion).length > 0" class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Presentaciones disponibles:</h3>
                    <div class="flex flex-wrap gap-2">
                        <span v-for="(presentacion, index) in parseEtiquetas(producto.etiquetas_presentacion)"
                            :key="index"
                            class="text-sm font-medium px-3 py-1 rounded-full border-2 text-justify"
                            :style="{
                                borderColor: producto.emprendimiento?.color_secundario_1 || '#000',
                                color: producto.emprendimiento?.color_secundario_1 || '#000'
                            }">
                            {{ presentacion }}
                        </span>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Descripción:</h3>
                    <p class="text-gray-600 text-justify">{{ producto.descripcion }}</p>
                </div>

                <!-- Modo de uso -->
                <div v-if="producto.modo_uso" class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Modo de uso:</h3>
                    <p class="text-gray-600 text-justify">{{ producto.modo_uso }}</p>
                </div>

                <!-- Beneficios -->
                <div v-if="producto.beneficios" class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Beneficios:</h3>
                    <p class="text-gray-600 text-justify">{{ producto.beneficios }}</p>
                </div>
            </div>
        </div>

        <!-- Productos restantes del emprendimiento -->
        <div v-if="productosRestantes.length > 0" class="mt-12 max-w-6xl mx-auto">
            <h2 class="text-3xl font-extrabold mb-8" :style="{ color: producto.emprendimiento?.color_principal_1 || '#000' }">
                Más Productos relacionados
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <Link v-for="producto in productosRestantes" :key="producto.id"
                    :href="`/producto/${producto.slug ?? producto.id}`" class="decoration-transparent">
                    <div class="rounded-xl shadow-md overflow-hidden flex flex-col h-full transition-all duration-300 hover:-translate-y-2 group cursor-pointer"
                        :style="{
                            border: `2px solid ${producto.emprendimiento?.color_secundario_1 || '#000'}30`,
                            backgroundColor: producto.emprendimiento?.color_secundario_2 || '#fff'
                        }">
                        <div class="relative h-52 overflow-hidden">
                            <img :src="`https://amazonfairtrade.org/storage/${producto.imagen}`" :alt="producto.nombre"
                                class="w-full h-full object-cover" />
                            <div class="absolute inset-0 group-hover:opacity-100 opacity-0 transition-opacity duration-300"
                                :style="{
                                    backgroundImage: `linear-gradient(to top, ${producto.emprendimiento?.color_secundario_1 || '#000'}70, transparent)`
                                }">

                            </div>
                            <div v-if="getFirstEtiquetaCalidad(producto.etiquetas_calidad)"
                                class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold z-10"
                                :style="{
                                    backgroundColor: producto.emprendimiento?.color_secundario_1 || '#000',
                                    color: producto.emprendimiento?.color_secundario_2 || '#fff'
                                }">
                                {{ getFirstEtiquetaCalidad(producto.etiquetas_calidad) }}
                            </div>
                        </div>
                        <div class="p-6 space-y-3 flex-grow">
                            <h3 class="text-xl font-bold text-black">{{ producto.nombre }}</h3>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="(etiqueta, index) in parseEtiquetas(producto.etiquetas_presentacion)"
                                    :key="index"
                                    class="text-xs font-medium px-2 py-1 rounded-full border border-black text-black">
                                    {{ etiqueta }}
                                </span>
                            </div>
                            <p class="text-sm line-clamp-3 text-black">
                                {{ producto.descripcion }}
                            </p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>

        <div v-else class="text-center mt-8" :style="{ color: producto.emprendimiento?.color_secundario_1 || '#000' }">
            No hay más productos disponibles.
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'

const props = defineProps({
    producto: Object
})

const producto = props.producto

const hoverColor = ref(props.producto.emprendimiento?.color_secundario_1 || '#000')
const imagenPrincipal = ref(props.producto.imagen)
const imagenesSecundarias = ref([])
const productosRestantes = ref([])

onMounted(() => {
    console.log('Producto recibido:', props.producto);

    const todasLasImagenes = [
        props.producto.imagen_2,
        props.producto.imagen_3,
        props.producto.imagen_4
    ].filter(img => img && img !== imagenPrincipal.value);

    imagenesSecundarias.value = todasLasImagenes;

    console.log('Imágenes secundarias:', imagenesSecundarias.value);

    initProductosRestantes();
});

const initProductosRestantes = () => {
    console.log('Iniciando carga de productos restantes...');

    if (props.producto.emprendimiento && props.producto.emprendimiento.productos) {
        const otrosProductos = props.producto.emprendimiento.productos.filter(p => p.id !== props.producto.id);

        // Mezclar aleatoriamente los productos
        const productosAleatorios = otrosProductos.sort(() => 0.5 - Math.random()).slice(0, 3);

        productosRestantes.value = productosAleatorios;
        console.log('Productos restantes aleatorios:', productosRestantes.value);
    } else {
        productosRestantes.value = [];
        console.log('No se encontraron productos en el emprendimiento.');
    }
};

const cambiarImagen = (nuevaImagenPrincipal) => {
    if (nuevaImagenPrincipal === imagenPrincipal.value) return;

    const anterior = imagenPrincipal.value;
    const index = imagenesSecundarias.value.findIndex(img => img === nuevaImagenPrincipal);
    imagenPrincipal.value = nuevaImagenPrincipal;

    if (index !== -1) {
        const nuevas = [...imagenesSecundarias.value];
        nuevas[index] = anterior;
        imagenesSecundarias.value = nuevas;
    }
}

const parseEtiquetas = (etiquetas) => {
    try {
        return etiquetas ? JSON.parse(etiquetas) : []
    } catch (error) {
        console.error('Error al parsear etiquetas:', error)
        return []
    }
}

const getFirstEtiquetaCalidad = (etiquetasCalidad) => {
    const etiquetas = parseEtiquetas(etiquetasCalidad);
    return etiquetas.length > 0 ? etiquetas[0] : ''
}

const volverAtras = () => {
  if (producto.emprendimiento?.slug) {
    router.visit(`/emprendimiento/${producto.emprendimiento.slug}`)
  } else {
    router.visit('/')
  }
}
</script>
