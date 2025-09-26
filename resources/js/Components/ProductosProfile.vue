<template>
    <section id="productos" class="py-16 px-6 md:px-12 lg:px-20 border-b-2"
    :style="{ backgroundColor: emprendimiento.color_secundario_2, borderColor: emprendimiento.color_principal_1 }">
        <div class="max-w-6xl mx-auto">
            <div class="inline-block mb-12 text-center w-full">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-3 leading-tight"
                    :style="{ color: emprendimiento.color_principal_1 }">
                    Catálogo de productos
                </h2>
                <div class="h-1 w-24 rounded-full mx-auto"
                    :style="{ backgroundColor: emprendimiento.color_secundario_1 }"></div>
                <p class="mt-4 max-w-2xl mx-auto text-black" >
                    Descubre nuestra amplia selección de productos artesanales elaborados con técnicas ancestrales y
                    materiales sostenibles
                </p>
            </div>

            <div v-if="productos.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <Link v-for="producto in productos" :key="producto.id"
                    :href="`/producto/${producto.slug ?? producto.id}`" class="decoration-transparent">
                <div class="rounded-xl shadow-md overflow-hidden flex flex-col h-full transition-all duration-300 hover:-translate-y-2 group cursor-pointer"
                    :style="{
                        border: `2px solid ${emprendimiento.color_secundario_1}30`,
                        backgroundColor: emprendimiento.color_secundario_2
                    }">
                    <div class="relative h-52 overflow-hidden">
                        <img :src="`https://amazonfairtrade.org/storage/${producto.imagen}`" :alt="producto.nombre"
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 group-hover:opacity-100 opacity-0 transition-opacity duration-300"
                            :style="{
                                backgroundImage: `linear-gradient(to top, ${emprendimiento.color_secundario_1}70, transparent)`
                            }">

                            <div class="absolute bottom-4 left-4">
                                <span class="font-medium" :style="{ color: emprendimiento.color_secundario_2 }">
                                    Ver más detalles
                                </span>
                            </div>
                        </div>
                        <!-- Aquí se reemplaza 'NATURAL' por la primera etiqueta de 'etiquetas_calidad' -->
                        <div
  v-if="getFirstEtiquetaCalidad(producto.etiquetas_calidad)"
  class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-semibold z-10"
  :style="{
    backgroundColor: emprendimiento.color_secundario_1,
    color: emprendimiento.color_secundario_2,
  }"
>
  {{ getFirstEtiquetaCalidad(producto.etiquetas_calidad) }}
</div>

                    </div>

                    <div class="p-6 space-y-3 flex-grow">
                        <h3 class="text-xl font-bold text-black" >
                            {{ producto.nombre }}
                        </h3>

                        <div class="flex flex-wrap gap-2">
                            <span v-for="(etiqueta, index) in parseEtiquetas(producto.etiquetas_presentacion)"
                                :key="index" class="text-xs font-medium px-2 py-1 rounded-full border border-black text-black">
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

            <div v-else class="text-center mt-8" :style="{ color: emprendimiento.color_secundario_1 }">
                No hay productos disponibles aún.
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
    emprendimiento: {
        type: Object,
        required: true,
    },
})

const productos = props.emprendimiento.productos || []

const getFirstEtiquetaCalidad = (etiquetasCalidad) => {
    const etiquetas = parseEtiquetas(etiquetasCalidad);
    return etiquetas.length > 0 ? etiquetas[0] : ''; // Si no hay etiquetas, devuelve 'NATURAL'
}

const parseEtiquetas = (etiquetas) => {
    try {
        return etiquetas ? JSON.parse(etiquetas) : []
    } catch (error) {
        console.error('Error al parsear etiquetas:', error)
        return []
    }
}
</script>
