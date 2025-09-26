<template>
    <div id="inicio"
        class="relative w-full min-h-screen lg:h-screen flex flex-col md:flex-row items-center justify-center px-6 lg:px-16 pt-20 gap-10 border-b-2 "
        :style="{ backgroundColor: emprendimiento.color_secundario_2, color: emprendimiento.color_secundario_1, borderColor: emprendimiento.color_principal_1 }">
        <!-- Columna izquierda -->
        <div class="max-w-lg text-center md:text-left space-y-6 md:mr-10">  <!-- Añadido margin-right -->
            <!-- Logo -->
            <!-- Logo -->
<!-- Logo -->
<div class="w-full flex justify-center">
  <div class="text-2xl font-bold text-center w-full max-w-xs flex items-center justify-center">
    <img
      v-if="emprendimiento.imagen_logo"
      class="h-52 w-full object-contain mt-16"
      :src="`https://amazonfairtrade.org/storage/${emprendimiento.imagen_logo}`"
      alt="Logo Emprendimiento"
    />
    <span v-else class="text-3xl md:text-4xl font-extrabold mt-16">
      {{ emprendimiento.titulo }}
    </span>
  </div>
</div>
            <!-- Descripción -->
            <p class="text-lg md:text-xl leading-relaxed text-justify text-gray-800">
                {{ emprendimiento.descripcion }}
            </p>

            <!-- Botón -->
            <div class="flex transform transition-transform duration-300 justify-center">
                <button @click="props.smoothScrollTo('productos')"
                    class="relative flex items-center gap-2 px-6 py-2 border-2 rounded-full overflow-hidden group transition"
                    :style="{
                        borderColor: emprendimiento.color_principal_1,
                        color: emprendimiento.color_principal_1
                    }">
                    <!-- Fondo animado -->
                    <span
                        class="absolute left-0 top-0 h-full w-0 group-hover:w-full transition-all duration-500 ease-out"
                        :style="{ backgroundColor: emprendimiento.color_principal_1 }"></span>

                    <!-- Contenido -->
                    <span
                        class="relative z-10 transition-colors duration-500 flex items-center gap-2 group-hover:text-[color:var(--hover-color)]"
                        :style="{ '--hover-color': emprendimiento.color_secundario_2 }">


                        Catálogo
                        <svg class="w-4 h-4 animate-bounce-custom" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <!-- Imagen -->
<!-- Imagen -->
<!-- Imagen -->
<div class="w-full md:w-1/2 flex items-center justify-center">
  <div class="rounded-xl shadow-md overflow-hidden max-h-[60vh] w-full flex items-center justify-center">
    <img
      :src="`https://amazonfairtrade.org/storage/${emprendimiento.imagen_secundaria}`"
      alt="Imagen emprendimiento"
      class="object-contain w-full h-full"
    />
  </div>
</div>


    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    emprendimiento: {
        type: Object,
        required: true
    },
    smoothScrollTo: {
        type: Function,
        required: true
    }
});
const hoveringButton = ref(false);
const valido = (val) =>
  val !== null && val !== undefined && val !== 'undefined' && val !== '';

</script>

<style scoped>
@keyframes bounce-smooth {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-3px);
    }
}

.animate-bounce-custom {
    animation: bounce-smooth 1.5s ease-in-out infinite;
}
</style>
