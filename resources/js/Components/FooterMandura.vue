<template>
  <footer v-if="emprendimiento" :style="{ color: emprendimiento.color_secundario_1 }" class="relative text-sm">
    <!-- Fondo -->
    <div class="absolute inset-0" :style="{ backgroundColor: emprendimiento.color_secundario_2 }"></div>

    <!-- Contenido -->
    <div
      class="relative z-10 w-full mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-10 text-center"
      :style="{ borderTop: `1px solid ${emprendimiento.color_secundario_1}66` }"
    >
      <!-- Acerca de nosotros -->
      <div
        class="flex flex-col items-center text-center border-b md:border-b-0 md:border-r pb-6 md:pb-0 md:pr-6"
        :style="{ borderColor: `${emprendimiento.color_secundario_1}66` }"
      >
        <h3 class="font-bold mb-3" :style="{ color: emprendimiento.color_secundario_1 }">Acerca de nosotros</h3>
        <p class="mb-6" :style="{ color: emprendimiento.color_secundario_1 }">Redes sociales</p>

        <div v-if="hasSocialLinks" class="flex justify-center gap-8">
          <a
            v-for="(link, index) in socialLinks"
            :key="index"
            :href="link.url"
            target="_blank"
            rel="noopener noreferrer"
            class="transition duration-300 transform hover:-translate-y-1"
            @mouseenter="hoveringSocial = index"
            @mouseleave="hoveringSocial = null"
          >
            <component
              :is="link.icon"
              class="w-8 h-8 transition-colors duration-300"
              :style="{ color: hoveringSocial === index ? emprendimiento.color_secundario_1 : emprendimiento.color_principal_1 }"
            />
          </a>
        </div>

        <div v-else :style="{ color: emprendimiento.color_secundario_1 }">
          El emprendimiento no cuenta con redes sociales por el momento
        </div>
      </div>

      <!-- Menú de navegación -->
      <div
        class="flex flex-col items-center text-center border-b md:border-b-0 md:border-r pb-6 md:pb-0 md:pr-6"
        :style="{ borderColor: `${emprendimiento.color_secundario_1}66` }"
      >
        <h3 class="font-bold mb-3" :style="{ color: emprendimiento.color_secundario_1 }">Navegación</h3>
        <ul class="space-y-4">
          <li v-for="section in sections" :key="section.id">
            <a
              href="javascript:void(0)"
              @click="smoothScrollTo(section.id)"
              class="relative tracking-wide transition-all duration-300 after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 hover:after:w-full"
              @mouseenter="hoveringLink = section.id"
              @mouseleave="hoveringLink = null"
              :style="{
                color: hoveringLink === section.id ? emprendimiento.color_principal_1 : emprendimiento.color_secundario_1,
                '--after-bg': emprendimiento.color_principal_1
              }"
              :class="'after:bg-[var(--after-bg)]'"
            >
              {{ section.label }}
            </a>
          </li>
        </ul>
      </div>

  <div
    v-if="mostrarContacto"
    class="flex flex-col items-center text-center"
  >
    <h3 class="font-bold mb-3" :style="{ color: emprendimiento.color_secundario_1 }">
      Contáctanos
    </h3>
    <ul class="space-y-4">
      <li
        v-if="valido(emprendimiento.direccion)"
        class="flex items-center gap-2 justify-center"
      >
        <MapPin class="w-5 h-5 transition-colors duration-300" :style="{ color: emprendimiento.color_principal_1 }" />
        <span>{{ emprendimiento.direccion }}</span>
      </li>
      <li
        v-if="valido(emprendimiento.ubicacion)"
        class="flex items-center gap-2 justify-center"
      >
        <Globe class="w-5 h-5 transition-colors duration-300" :style="{ color: emprendimiento.color_principal_1 }" />
        <span>{{ emprendimiento.ubicacion }}</span>
      </li>
      <li
        v-if="valido(emprendimiento.telefono)"
        class="flex items-center gap-2 justify-center"
      >
        <Phone class="w-5 h-5 transition-colors duration-300" :style="{ color: emprendimiento.color_principal_1 }" />
        <span>{{ emprendimiento.telefono }}</span>
      </li>
      <li
        v-if="valido(emprendimiento.celular)"
        class="flex items-center gap-2 justify-center"
      >
        <Building class="w-5 h-5 transition-colors duration-300" :style="{ color: emprendimiento.color_principal_1 }" />
        <span>{{ emprendimiento.celular }}</span>
      </li>
      <li
        v-if="valido(emprendimiento.correo_electronico)"
        class="flex items-center gap-2 justify-center"
      >
        <Send class="w-5 h-5 transition-colors duration-300" :style="{ color: emprendimiento.color_principal_1 }" />
        <span>{{ emprendimiento.correo_electronico }}</span>
      </li>
    </ul>
  </div>

    </div>

    <!-- Copyright -->
    <div
      class="relative z-10 text-center py-6 text-sm"
      :style="{
        color: emprendimiento.color_secundario_1,
        borderTop: `1px solid ${emprendimiento.color_secundario_1}66`
      }"
    >
      Copyright © 2025 Todos los derechos reservados
    </div>
  </footer>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Building, Facebook, Globe, Instagram, MapPin, Phone, Send, Linkedin } from 'lucide-vue-next'

const props = defineProps({
  emprendimiento: { type: Object, required: true },
  sections: { type: Array, required: true },
  smoothScrollTo: { type: Function, required: true }
});

const valido = (val) =>
  val !== null && val !== undefined && val !== 'undefined' && val !== '';

const mostrarContacto = computed(() => {
  const e = props.emprendimiento;
  return (
    valido(e.direccion) ||
    valido(e.ubicacion) ||
    valido(e.telefono) ||
    valido(e.celular) ||
    valido(e.correo_electronico)
  );
});

const hoveringSocial = ref(null);
const hoveringLink = ref(null);

const socialLinks = computed(() => {
  const links = [];
  if (props.emprendimiento.linkedin_url) links.push({ icon: Linkedin, url: props.emprendimiento.linkedin_url });
  if (props.emprendimiento.facebook_url) links.push({ icon: Facebook, url: props.emprendimiento.facebook_url });
  if (props.emprendimiento.instagram_url) links.push({ icon: Instagram, url: props.emprendimiento.instagram_url });
  if (props.emprendimiento.web_url) links.push({ icon: Globe, url: props.emprendimiento.web_url });
  return links;
});

const hasSocialLinks = computed(() => socialLinks.value.length > 0);
</script>
