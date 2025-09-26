<template>
    <section id="noticias" class="bg-white py-16 px-4 overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-16 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#124228] relative inline-block" data-aos="fade-up"
                    data-aos-duration="1200">
                    <span class="relative z-10">Noticias</span>
                    <div class="h-1 w-24 bg-[#73A847] rounded-full mx-auto mb-6" data-aos="fade-up"
                        data-aos-duration="1400"></div>

                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="1600">
                    Mantente informado con las últimas actualizaciones, eventos y logros relacionados con la
                    conservación y las
                    comunidades de la Amazonía.
                </p>
            </div>

            <!-- Contenido de Noticias -->
            <div class="space-y-20 max-h-[800px] overflow-y-auto pr-2 custom-scrollbar" data-aos="fade-up"
                data-aos-duration="1000">
                <!-- NOTICIA -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start" data-aos="fade-up"
                    data-aos-duration="1200">
                    <!-- Texto -->
                    <div>
                        <h2 class="text-3xl font-semibold text-[#124228] mb-4" data-aos="fade-up"
                            data-aos-duration="1400">
                            Expedición al Yasuní
                        </h2>
                        <p class="text-gray-700 mb-3 text-justify" data-aos="fade-up" data-aos-duration="1600">
                            Sumérgete en una experiencia única e inolvidable con nuestra expedición al Parque Nacional
                            Yasuní, una joya natural ubicada en el corazón de la Amazonía ecuatoriana, considerada uno
                            de los lugares con mayor biodiversidad del planeta. Durante este viaje, te adentrarás en
                            selvas vírgenes donde cada paso revela una nueva forma de vida: coloridas aves, monos
                            juguetones, reptiles exóticos y plantas milenarias que conviven en perfecto equilibrio.
                            Tendrás la oportunidad de interactuar con comunidades indígenas como los Waorani, guardianes
                            ancestrales de este territorio, quienes te compartirán sus conocimientos, costumbres y su
                            profunda conexión espiritual con la selva. Caminarás por senderos ocultos bajo la sombra de
                            gigantescos árboles, navegarás por ríos serpenteantes rodeado de una sinfonía de sonidos
                            naturales y experimentarás puestas de sol que transforman el cielo en un lienzo de colores
                            vibrantes. </p>
                    </div>
                    <!-- Tarjeta -->
                    <div
                        class="bg-[#124228] rounded-xl shadow-lg overflow-hidden w-full max-w-md mx-auto hover:-translate-y-2 duration-300 transition-all mt-2">
                        <img src="/images/conAmazonia/Fondo.png" alt="Expedición al Yasuní"
                            class="w-full h-56 object-cover" />
                        <div class="p-4">
                            <h4 class="text-lg font-semibold text-[#FFF8EA] mb-2">Expedición al Yasuní</h4>
                            <div class="flex items-center text-sm text-[#FFF8EA] mb-1">
                                <Calendar class="w-4 h-4 mr-2" />
                                14–29 Junio &nbsp; | &nbsp; Robbin Joseph
                            </div>
                            <div class="flex items-center text-sm text-[#FFF8EA]">
                                <MapPin class="w-4 h-4 mr-2" />
                                Ambato, Ecuador
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NOTICIA -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start" data-aos="fade-up"
                    data-aos-duration="1000">

                    <!-- Tarjeta -->
                    <div class="bg-[#124228] rounded-xl shadow-lg overflow-hidden w-full max-w-md mx-auto hover:-translate-y-2 duration-300 transition-all"
                        data-aos="fade-up" data-aos-duration="1600">
                        <img src="/images/conAmazonia/Fondo.png" alt="Festival de Sabores Amazónicos"
                            class="w-full h-56 object-cover" />
                        <div class="p-4" data-aos="fade-up" data-aos-duration="1800">
                            <h4 class="text-lg font-semibold text-[#FFF8EA] mb-2" data-aos="fade-up"
                                data-aos-duration="2000">Festival de Sabores Amazónicos</h4>
                            <div class="flex items-center text-sm text-[#FFF8EA] mb-1">
                                <Calendar class="w-4 h-4 mr-2" />
                                12 Julio 2025 &nbsp; | &nbsp; Nelly Gualinga
                            </div>
                            <div class="flex items-center text-sm text-[#FFF8EA]" data-aos="fade-up"
                                data-aos-duration="2200">
                                <MapPin class="w-4 h-4 mr-2" />
                                Puyo, Ecuador
                            </div>
                        </div>
                    </div>

                    <!-- Texto -->
                    <div>
                        <h2 class="text-3xl font-semibold text-[#124228] mb-4" data-aos="fade-up"
                            data-aos-duration="1200">
                            Festival de Sabores Amazónicos
                        </h2>
                        <p class="text-gray-700 mb-3 text-justify" data-aos="fade-up" data-aos-duration="1400">
                            Vive una experiencia sensorial inolvidable en el Festival de Sabores Amazónicos, donde se
                            fusionan tradiciones culinarias ancestrales con ingredientes autóctonos como la yuca, el
                            guayusa y el pescado de río.

                            Durante este evento, cocineras y cocineros de distintas nacionalidades indígenas comparten
                            sus conocimientos y técnicas heredadas por generaciones, promoviendo una cocina consciente,
                            sostenible y profundamente conectada con la selva. Además de degustar una amplia variedad de
                            platillos típicos, los asistentes podrán participar en talleres gastronómicos, rituales de
                            agradecimiento a la tierra, y charlas sobre soberanía alimentaria y biodiversidad.

                        </p>
                    </div>

                </div>


                <!-- Puedes repetir más bloques así -->
            </div>
        </div>
    </section>
</template>

<script setup>
import { Calendar, MapPin } from "lucide-vue-next";
</script>

<style scoped>
/* Scrollbar personalizada */
.custom-scrollbar::-webkit-scrollbar {
    width: 10px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgb(249, 236, 191);
    border-radius: 9999px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: hsl(88, 50%, 53%);
    border-radius: 9999px;
    border: 2px solid rgb(249, 236, 191);
}

/* Prevenir scroll horizontal */
section#noticias {
    overflow-x: hidden;
}
</style>
