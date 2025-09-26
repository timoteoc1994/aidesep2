<template>
    <section id="mision" v-if="mostrarSeccion" :style="{ backgroundColor: emprendimiento.color_secundario_2 }"
        class="pt-20 text-center mb-20">
        <div class="max-w-6xl mx-auto">
            <!-- Título principal -->
            <h2 v-if="valido(emprendimiento.titulo_mision)" class="text-4xl md:text-5xl font-extrabold mb-3"
                :style="{ color: emprendimiento.color_principal_1 }">
                {{ emprendimiento.titulo_mision }}
            </h2>
            <div v-if="valido(emprendimiento.titulo_mision)" class="h-1 w-24 rounded-full mx-auto"
                :style="{ backgroundColor: emprendimiento.color_secundario_1 }"></div>

            <!-- Subtítulo -->
<div v-if="valido(emprendimiento.texto_mision)" class="prose prose-lg mx-auto mb-4 text-black">
    <div v-html="emprendimiento.texto_mision" class="custom-texto text-center mx-4 sm:mx-6 md:mx-8"></div>
</div>

        </div>

        <!-- Mapa de ubicación -->
        <div v-if="valido(emprendimiento.titulo_mapa) || valido(emprendimiento.texto_mapa) || valido(emprendimiento.ubicacion_google_maps)"
            class="mt-20 text-center w-full">
            <div class="max-w-6xl mx-auto mb-10">
                <h2 v-if="valido(emprendimiento.titulo_mapa)"
                    class="text-3xl md:text-4xl font-extrabold mb-3 leading-tight"
                    :style="{ color: emprendimiento.color_principal_1 }">
                    {{ emprendimiento.titulo_mapa }}
                </h2>
                <div v-if="valido(emprendimiento.titulo_mapa)" class="h-1 w-24 rounded-full mx-auto"
                    :style="{ backgroundColor: emprendimiento.color_secundario_1 }"></div>
                <p v-if="valido(emprendimiento.texto_mapa)" class="mt-4 max-w-2xl mx-auto text-black">
                    {{ emprendimiento.texto_mapa }}
                </p>
            </div>

            <!-- Redes sociales debajo del subtítulo -->
            <div v-if="hasSocialLinks" class="flex justify-center gap-6 mb-10">
                <a v-for="(link, index) in socialLinks" :key="index" :href="link.url" target="_blank"
                    rel="noopener noreferrer" class="transition-transform hover:-translate-y-1"
                    @mouseenter="hoveringSocial = index" @mouseleave="hoveringSocial = null">
                    <component :is="link.icon" class="w-7 h-7 text-black"
                         />
                </a>
            </div>

            <!-- Grid con contacto y mapa -->
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                <!-- Contacto -->
                <div v-if="mostrarContacto" class="px-6 py-6 backdrop-blur-sm transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-6 tracking-tight ml-12"
                        :style="{ color: emprendimiento.color_secundario_1 }">
                        Contáctanos
                    </h3>

                    <ul class="space-y-5">
                        <li v-if="valido(emprendimiento.direccion)" class="flex items-start gap-4 group">
                            <div class="p-2 rounded-full"
                                :style="{ backgroundColor: `${emprendimiento.color_principal_1}20` }">
                                <MapPin class="w-5 h-5" :style="{ color: emprendimiento.color_principal_1 }" />
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold block text-sm uppercase tracking-wider mb-1"
                                    :style="{ color: emprendimiento.color_principal_1 }">
                                    Dirección
                                </span>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    {{ emprendimiento.direccion }}
                                </span>
                            </div>
                        </li>

                        <li v-if="valido(emprendimiento.ubicacion)" class="flex items-start gap-4 group">
                            <div class="p-2 rounded-full"
                                :style="{ backgroundColor: `${emprendimiento.color_principal_1}20` }">
                                <Globe class="w-5 h-5" :style="{ color: emprendimiento.color_principal_1 }" />
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold block text-sm uppercase tracking-wider mb-1"
                                    :style="{ color: emprendimiento.color_principal_1 }">
                                    Ubicación
                                </span>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    {{ emprendimiento.ubicacion }}
                                </span>
                            </div>
                        </li>

                        <li v-if="valido(emprendimiento.telefono)" class="flex items-start gap-4 group">
                            <div class="p-2 rounded-full"
                                :style="{ backgroundColor: `${emprendimiento.color_principal_1}20` }">
                                <Phone class="w-5 h-5" :style="{ color: emprendimiento.color_principal_1 }" />
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold block text-sm uppercase tracking-wider mb-1"
                                    :style="{ color: emprendimiento.color_principal_1 }">
                                    Teléfono
                                </span>
                                <a :href="`tel:${emprendimiento.telefono}`"
                                    class="text-gray-700 hover:text-gray-900 transition-colors hover:underline">
                                    {{ emprendimiento.telefono }}
                                </a>
                            </div>
                        </li>

                        <li v-if="valido(emprendimiento.celular)" class="flex items-start gap-4 group">
                            <div class="p-2 rounded-full"
                                :style="{ backgroundColor: `${emprendimiento.color_principal_1}20` }">
                                <Smartphone class="w-5 h-5" :style="{ color: emprendimiento.color_principal_1 }" />
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold block text-sm uppercase tracking-wider mb-1"
                                    :style="{ color: emprendimiento.color_principal_1 }">
                                    Celular
                                </span>
                                <a :href="`tel:${emprendimiento.celular}`"
                                    class="text-gray-700 hover:text-gray-900 transition-colors hover:underline">
                                    {{ emprendimiento.celular }}
                                </a>
                            </div>
                        </li>

                        <li v-if="valido(emprendimiento.correo_electronico)" class="flex items-start gap-4 group">
                            <div class="p-2 rounded-full"
                                :style="{ backgroundColor: `${emprendimiento.color_principal_1}20` }">
                                <Mail class="w-5 h-5" :style="{ color: emprendimiento.color_principal_1 }" />
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold block text-sm uppercase tracking-wider mb-1"
                                    :style="{ color: emprendimiento.color_principal_1 }">
                                    Correo
                                </span>
                                <a :href="`mailto:${emprendimiento.correo_electronico}`"
                                    class="text-gray-700 hover:text-gray-900 transition-colors hover:underline">
                                    {{ emprendimiento.correo_electronico }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>


                <!-- Mapa -->
                <div v-if="valido(emprendimiento.ubicacion_google_maps)"
                    class="h-96 rounded-lg overflow-hidden shadow-md">
                    <iframe
                        :src="`https://www.google.com/maps?q=${emprendimiento.ubicacion_google_maps}&z=15&output=embed`"
                        width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Building, Facebook, Globe, Instagram, MapPin, Phone, Send, Linkedin, Smartphone, Mail, Youtube, YoutubeIcon, Music } from 'lucide-vue-next';
import { h } from 'vue';


const props = defineProps({
    emprendimiento: { type: Object, required: true },
    sections: { type: Array, required: true },
    smoothScrollTo: { type: Function, required: true }
});

const valido = (val) =>
    val !== null && val !== undefined && val !== 'undefined' && val !== '';

const mostrarSeccion = computed(() => {
    const e = props.emprendimiento;
    return (
        valido(e.titulo_mision) ||
        valido(e.texto_mision) ||
        valido(e.ubicacion_google_maps) ||
        mostrarContacto.value
    );
});

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

const socialLinks = computed(() => {
    const links = [];
    if (props.emprendimiento.linkedin_url) links.push({ icon: Linkedin, url: props.emprendimiento.linkedin_url });
    if (props.emprendimiento.facebook_url) links.push({ icon: Facebook, url: props.emprendimiento.facebook_url });
    if (props.emprendimiento.instagram_url) links.push({ icon: Instagram, url: props.emprendimiento.instagram_url });
    if (props.emprendimiento.web_url) links.push({ icon: Globe, url: props.emprendimiento.web_url });
    if (props.emprendimiento.youtube_url) links.push({ icon: YoutubeIcon, url: props.emprendimiento.youtube_url });  // Añadido YouTube
     if (props.emprendimiento.tiktok_url) {
    links.push({
        icon: () => h('svg', {
            xmlns: 'http://www.w3.org/2000/svg',
            viewBox: '0 0 448 512',
            fill: 'none',
            stroke: 'currentColor',
            'stroke-width': '40'
        }, [
            h('path', {
                d: "M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"
            })
        ]),
        url: props.emprendimiento.tiktok_url
    });
}
// Añadido TikTok
    return links;
});

const hasSocialLinks = computed(() => socialLinks.value.length > 0);
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
