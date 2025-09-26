<template>
    <section class="relative w-full bg-cover bg-center py-24 md:py-32"
        style="background-image: url('/images/amazonFairTrade/jungle.jpg')">
        <div class="absolute inset-0 bg-black opacity-70"></div>

        <div
            class="max-w-6xl mx-auto h-full flex flex-col lg:flex-row items-center gap-8 lg:gap-20 px-4 md:px-6 lg:px-0">
            <!-- Imagen con bordes redondeados -->
            <div class="w-full lg:flex-shrink-0 lg:w-auto border-2 border-[#C6D7DE] rounded-2xl overflow-hidden shadow-xl"
                data-aos="fade-right" data-aos-duration="1400">
                <img src="/images/amazonFairTrade/forestNew.jpg" alt="Río amazónico" data-aos="fade-right"
                    data-aos-duration="1400"
                    class="rounded-2xl shadow-xl w-full h-[250px] sm:h-[300px] lg:h-[370px] lg:max-h-[370px] object-cover" />
            </div>

            <!-- Texto con fondo semitransparente -->
            <div class="w-full lg:max-w-2xl bg-[#23413F] bg-opacity-85 p-6 md:p-8 rounded-xl text-[#FFF8F6]"
                data-aos="fade-left" data-aos-duration="1400">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold mb-4 text-[#FFF8F6] leading-tight">
                    Conectando al mundo con la sabiduría de la Amazonía
                </h2>
                <p class="mb-6 text-sm sm:text-base leading-relaxed text-[#FFF8F6]">
                    Amazon Fair Trade busca ser un puente entre las comunidades indígenas y el mundo,
                    ofreciendo una plataforma de comercio justo que respeta los principios de la economía indígena.
                </p>

                <!-- Línea divisora -->
                <div class="w-full h-[3px] bg-[#F2FCF1] mb-4 rounded-full"></div>

                <ul class="list-disc list-inside text-sm sm:text-base text-[#FFF8F6] space-y-1">
                    <li>Fortalecer la autonomía de las comunidades</li>
                    <li>Proteger el ecosistema amazónico</li>
                    <li>Preservar el conocimiento ancestral</li>
                    <li>Impulsar un modelo económico más justo y sostenible</li>
                </ul>
            </div>
        </div>
    </section>
</template>
