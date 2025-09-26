<template>
  <section
    v-if="mostrarSeccion"
    class="w-full px-6 md:px-12 lg:px-20 py-16"
    :style="{ backgroundColor: emprendimiento.color_principal_1 }"
  >
    <div class="max-w-6xl mx-auto">
      <div :class="{'grid grid-cols-1 md:grid-cols-4 gap-10': hayImagen, 'text-right': !hayImagen}">
        <!-- Columna Izquierda: Textos informativos (3/4) -->
        <div :class="hayImagen ? 'col-span-3' : ''">
          <h2
            v-if="valido(emprendimiento.titulo_2_nosotros)"
            class="text-3xl font-extrabold mb-1"
            :style="{ color: emprendimiento.color_secundario_2 }"
          >
            {{ emprendimiento.titulo_2_nosotros }}
          </h2>
          <div
            v-if="valido(emprendimiento.titulo_2_nosotros)"
            :class="['h-1 w-48 rounded-full mb-8', !hayImagen ? 'ml-auto' : '']"
            :style="{ backgroundColor: emprendimiento.color_secundario_2 }"
          ></div>

          <div
            v-if="valido(emprendimiento.texto_2_nosotros)"
            class="prose prose-sm md:prose-base max-w-none"
            :style="{ color: emprendimiento.color_secundario_2 }"
          >
            <div v-html="emprendimiento.texto_2_nosotros" class="custom-texto"></div>
          </div>
        </div>

        <!-- Columna Derecha: Imagen (1/4) -->
        <div
          v-if="hayImagen"
          class="relative col-span-1 mt-2 rounded-lg shadow-md overflow-hidden"
        >
          <img
            :src="`https://amazonfairtrade.org/storage/${emprendimiento.imagen_2_nosotros}`"
            alt="Imagen emprendimiento - Nosotros 2"
            class="w-full h-full object-cover"
          />
          <div class="absolute inset-0 bg-black bg-opacity-15"></div>
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

const hayImagen = computed(() => {
  return valido(props.emprendimiento.imagen_2_nosotros);
});

const mostrarSeccion = computed(() => {
  const e = props.emprendimiento;
  return (
    valido(e.titulo_2_nosotros) ||
    valido(e.texto_2_nosotros) ||
    valido(e.imagen_2_nosotros)
  );
});
</script>

<style>
.custom-texto, .custom-texto * {
  font-family: 'Roboto', sans-serif !important;
  color: inherit;
}

.custom-texto strong, .custom-texto b {
  font-weight: 800;
}
</style>
