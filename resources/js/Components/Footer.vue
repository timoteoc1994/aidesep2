<template>
    <footer class="relative text-gray-800 text-sm">
        <!-- Fondo con imagen -->
        <div class="absolute inset-0" style="background-image: url('/images/amazonFairTrade/FondoFooter.webp');"></div>

        <!-- Contenido -->
        <div
            class="relative z-10 w-full mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-4 gap-10 border-t border-gray-200 text-center">
            <!-- Acerca de nosotros -->
            <div
                class="flex flex-col items-center text-center border-b md:border-b-0 md:border-r border-gray-300 pb-6 md:pb-0 md:pr-6">
                <h3 class="font-bold mb-3 text-[#AB8219]">Acerca de nosotros</h3>
                <p class="mb-6 text-[#AB8219]/90">Redes sociales</p>
                <div class="flex justify-center gap-8 text-[#0D6734]">
                    <Twitter
                        class="w-8 h-8 hover:-translate-y-1 transition-all cursor-pointer hover:text-[#244041] duration-300" />
                    <Facebook
                        class="w-8 h-8 hover:-translate-y-1 transition-all cursor-pointer hover:text-[#244041] duration-300" />
                    <Instagram
                        class="w-8 h-8 hover:-translate-y-1 transition-all cursor-pointer hover:text-[#244041] duration-300" />
                </div>

            </div>

            <!-- Información -->
            <div
                class="flex flex-col items-center text-center border-b md:border-b-0 md:border-r border-gray-300 pb-6 md:pb-0 md:pr-6">
                <h3 class="font-bold mb-3 text-[#AB8219]">Categorías</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/emprendimientos/bisuteria"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Bisutería
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/moda-sostenible"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Moda Sostenible
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/artesaria"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Artesanía
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/turismo"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Turismo
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/gastronomia"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Gastronomía
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/medicina-natural"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Medicina Natural
                        </a>
                    </li>
                    <li>
                        <a href="/emprendimientos/cosmetica"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Cosmética
                        </a>
                    </li>
                </ul>

            </div>

            <!-- Países -->
            <div
                class="flex flex-col items-center text-center border-b md:border-b-0 md:border-r border-gray-300 pb-6 md:pb-0 md:pr-6">
                <h3 class="font-bold mb-3 text-[#AB8219]">Países</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="https://conamazonia.com/"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Ecuador
                        </a>
                    </li>
                    <li>
                        <a href="#Peru"
                            class="inline-block relative tracking-wide  after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Perú
                        </a>
                    </li>
                    <li>
                        <a href="/conBolivia"
                            class="inline-block relative tracking-wide  after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Bolivia
                        </a>
                    </li>
                    <li>
                        <a href="#Venezuela"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Venezuela
                        </a>
                    </li>
                    <li>
                        <a href="#Colombia"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Colombia
                        </a>
                    </li>
                    <li>
                        <a href="#Brasil"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Brasil
                        </a>
                    </li>
                    <li>
                        <a href="#Surinam"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Surinam
                        </a>
                    </li>
                    <li>
                        <a href="#Guayana"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Guayana
                        </a>
                    </li>
                    <li>
                        <a href="#GuayanaFrancesa"
                            class="inline-block relative tracking-wide after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:bg-[#0D6734] hover:after:w-full hover:text-[#0D6734]">
                            Guayana Francesa
                        </a>
                    </li>
                </ul>

            </div>

            <!-- Contacto -->
            <div class="flex flex-col items-center text-center">
                <h3 class="font-bold mb-3 text-[#AB8219]">¿Tienes preguntas?</h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-2 justify-center text-center">
                        <Globe class="w-5 h-5 text-[#0D6734] self-center" />
                        <span class="leading-snug" v-html="direccionDividida"></span>
                    </li>

                    <li class="flex items-center gap-2 justify-center">
                        <MapPin class="w-5 h-5 text-[#0D6734]" />
                        <span>Quito - Ecuador</span>
                    </li>
                    <li class="flex items-center gap-2 justify-center">
                        <Phone class="w-5 h-5 text-[#0D6734]" />
                        <span>+593 98 040 5446</span>
                    </li>
                    <li class="flex items-center gap-2 justify-center">
                        <Building class="w-5 h-5 text-[#0D6734]" />
                        <span>023 226 744</span>
                    </li>
                    <li class="flex items-center gap-2 justify-center">
                        <Send class="w-5 h-5 text-[#0D6734]" />
                        <span>coica@coicamazonia.org</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="relative z-10 text-center py-6 text-gray-600 border-t border-gray-200 text-sm">
            Copyright © 2025 Todos los derechos reservados
        </div>
    </footer>
</template>

<script setup>
import { Twitter, Facebook, Instagram, MapPin, Phone, Send, Globe, Building } from 'lucide-vue-next'
import { computed } from 'vue';
const direccionCompleta = 'Calle Sevilla N24-358 y Guipuzcoa, La Floresta';

const direccionDividida = computed(() => {
    const palabras = direccionCompleta.split(' ');
    const mitad = Math.floor(palabras.length / 2);
    const primeraLinea = palabras.slice(0, mitad).join(' ');
    const segundaLinea = palabras.slice(mitad).join(' ');
    return `${primeraLinea}<br>${segundaLinea}`;
});
</script>
