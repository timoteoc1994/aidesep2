<template>
    <section id="aliados" class="bg-[#FBF8F3] py-12 px-6 text-center text-gray-800">
        <div class="max-w-6xl mx-auto">
            <!-- Patrocinador principal -->
            <div data-aos="zoom-in" data-aos-delay="100" class="flex justify-center">
                <div class="bg-[#FBF8F3] rounded-3xl p-10 w-full max-w-xl transition-all duration-300 hover:-translate-y-2">
                    <a :href="mainPartner.link" target="_blank" class="block">
                    <img :src="mainPartner.logo" :alt="mainPartner.name" class="h-28 mx-auto mb-6" loading="lazy" />
                    <!--<h3 class="text-2xl font-bold text-gray-800">{{ mainPartner.name }}</h3>
                    <p class="text-green-600 font-semibold mt-1">{{ mainPartner.role }}</p>
                    <p class="text-sm text-gray-500 mt-4 leading-relaxed">
                        {{ mainPartner.description }}
                    </p>-->
                    </a>
                </div>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="mb-10">
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#0D6734] relative inline-block">
                    <span class="relative z-10">Nuestros Aliados Estratégicos</span>
                    <span
                        class="absolute left-1/2 bottom-0 w-32 h-1 bg-[#244041] transform -translate-x-1/2 translate-y-3 rounded-full"></span>
                </h2>
                <p class="text-lg text-gray-600 mt-6 max-w-3xl mx-auto">
                    Colaboramos con organizaciones comprometidas con el impacto social, ambiental y cultural en la
                    Amazonía.
                </p>
            </div>

            <!-- Aliados secundarios -->
            <div data-aos="zoom-in" data-aos-delay="300" class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 justify-items-center">
                <div v-for="(partner, index) in secondaryPartners" :key="index"
                    class="bg-[#FBF8F3] rounded-2xl p-8 w-full max-w-sm transition-transform duration-300 hover:-translate-y-2">
                    <a :href="partner.link" target="_blank" class="block">
                        <img :src="partner.logo" :alt="partner.name" class="h-20 mx-auto mb-6" loading="lazy" />
                        <!-- <h4 class="text-xl font-semibold text-gray-800">{{ partner.name }}</h4>
                    <p class="text-green-500 font-medium">{{ partner.role }}</p>
                    <p class="text-sm text-gray-500 mt-3 leading-relaxed">{{ partner.description }}</p>-->
                    </a>
                </div>
            </div>

            <!-- CTA
            <div class="mt-12 max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">¿Deseas unirte a nuestra red de aliados?</h3>
                <p class="text-gray-600 mb-6">
                    Colabora con nuestra causa y contribuye a la transformación sostenible de los territorios
                    amazónicos.
                </p>
                <button
                    class="relative inline-flex items-center justify-center gap-2 px-8 py-3 text-emerald-400 font-medium rounded-full bg-white border-2 border-emerald-400 shadow-md transition-all duration-300 overflow-hidden group focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-400">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-white">
                        Conversemos sobre alianzas
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 relative z-10 transition-colors duration-300 group-hover:text-white"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>

                    <span
                        class="absolute left-0 top-0 h-full w-0 bg-emerald-400 transition-all duration-300 ease-out group-hover:w-full"></span>
                </button>-->
        </div>
    </section>
</template>

<script setup>
const mainPartner = {
    name: 'Patrocinador Coica',
    logo: '/images/amazonFairTrade/Coica.png',
    role: 'Aliado estratégico',
    description: 'Nuestro colaborador principal, comprometido con la sostenibilidad y el bienestar de las comunidades indígenas de la Amazonía.',
    link: 'https://coicamazonia.org/'
}

const secondaryPartners = [
    {
        name: 'Conservación Amazónica',
        logo: '/images/amazonFairTrade/Francia.png',
        role: 'Aliado ambiental',
        description: 'Impulsan la conservación de la biodiversidad y el desarrollo de bioemprendimientos sostenibles en territorios ancestrales.',
        link: 'https://www.info.gouv.fr/'
    },
    {
        name: 'Cultura Viva',
        logo: '/images/amazonFairTrade/logoNuevoInter.png',
        role: 'Aliado cultural',
        description:'Promueven la identidad y el patrimonio cultural de los pueblos indígenas a través de acciones artísticas y educativas.',
        link: 'https://www-conservation-org.translate.goog/home?_x_tr_sl=en&_x_tr_tl=es&_x_tr_hl=es&_x_tr_pto=tc'
    },
]
</script>
