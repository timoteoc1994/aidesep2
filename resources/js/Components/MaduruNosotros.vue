<template>
  <section
    v-if="mostrarSeccion"
    id="nosotros"
    class="w-full px-6 md:px-12 lg:px-20 py-16"
    :style="{ backgroundColor: emprendimiento.color_secundario_2 }"
  >
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">

      <!-- Columna Izquierda: Imagen de fondo (1/4) -->
      <div
        v-if="valido(emprendimiento.imagen_1_nosotros)"
        class="relative col-span-1 mt-2 rounded-lg shadow-md overflow-hidden"
      >
        <img
          :src="`https://amazonfairtrade.org/storage/${emprendimiento.imagen_1_nosotros}`"
          alt="Imagen de Nosotros"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black bg-opacity-15"></div>
      </div>

      <!-- Columna Derecha: Textos informativos (3/4) -->
      <div class="col-span-3">
        <h2
          v-if="valido(emprendimiento.titulo_1_nosotros)"
          class="text-3xl font-extrabold mb-1"
          :style="{ color: emprendimiento.color_principal_1 }"
        >
          {{ emprendimiento.titulo_1_nosotros }}
        </h2>
        <div
          v-if="valido(emprendimiento.titulo_1_nosotros)"
          class="h-1 w-48 rounded-full mb-8"
          :style="{ backgroundColor: emprendimiento.color_secundario_1 }"
        ></div>

         <div
          v-if="valido(emprendimiento.texto_1_nosotros)"
          class="prose prose-sm md:prose-base max-w-none mb-6 text-black"
        >
          <div v-html="emprendimiento.texto_1_nosotros" class="custom-texto"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  emprendimiento: {
    type: Object,
    required: true
  }
});

const valido = (val) =>
  val !== null && val !== undefined && val !== 'undefined' && val !== '';

const mostrarSeccion = computed(() => {
  const e = props.emprendimiento;
  return (
    valido(e.imagen_1_nosotros) ||
    valido(e.titulo_1_nosotros) ||
    valido(e.texto_1_nosotros)
  );
});
</script>

<style>
.custom-texto,
.custom-texto * {
  font-family: 'Roboto', sans-serif !important;
  color: inherit;
}

.custom-texto strong,
.custom-texto b {
  font-weight: 800;
}
</style>
