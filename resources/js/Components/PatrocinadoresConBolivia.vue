<template>
    <section id="aliados" class="bg-[#FBF8F3] py-12 px-6 text-center text-[#124228]">
        <div class="max-w-6xl mx-auto">
            <div data-aos="zoom-in" data-aos-delay="100"
                class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 justify-items-center">
                <div v-for="(partner, index) in mainPartners" :key="index"
                    class="bg-[#FBF8F3] rounded-2xl p-8 w-full max-w-sm transition-transform duration-300 hover:-translate-y-2">
                    <a :href="partner.link" target="_blank" class="block">
                        <img :src="partner.logo" :alt="partner.name" class="mx-auto mb-6 h-44 max-w-full object-contain"
                            loading="lazy" /> <!-- Usamos object-contain para evitar que se estire -->
                    </a>
                </div>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="mb-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#AB8219] relative inline-block">
                    <span class="relative z-10">Con el apoyo de</span>
                    <span
                        class="absolute left-1/2 bottom-0 w-32 h-1 bg-[#0D6734] transform -translate-x-1/2 translate-y-3 rounded-full"></span>
                </h2>
                <p class="text-lg text-[#0D6734] mt-6 max-w-3xl mx-auto">
                    Colaboramos con organizaciones comprometidas con el impacto social, ambiental y cultural en la
                    Amazonía
                </p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="300"
                class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 justify-items-center">
                <div v-for="(partner, index) in secondaryPartners" :key="index"
                    class="bg-[#FBF8F3] rounded-2xl p-8 w-full max-w-sm transition-transform duration-300 hover:-translate-y-2">
                    <a :href="partner.link" target="_blank" class="block">
                        <img :src="partner.logo" :alt="partner.name"
                            :class="[index % 2 === 0 ? 'h-24' : 'h-24', 'mx-auto mb-6']" loading="lazy" />
                    </a>
                </div>
            </div>


            <div data-aos="zoom-in" data-aos-delay="400" class="mt-12 max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold text-[#0D6734] mb-4">¿Deseas unirte a nuestra red de aliados?</h3>
                <p class="text-[#0D6734] mb-6">
                    Colabora con nuestra causa y contribuye a la transformación sostenible de los territorios
                    amazónicos.
                </p>
                <button @click="openWhatsApp" type="button"
                    class="relative inline-flex items-center justify-center gap-2 px-8 py-3 text-[#0D6734] font-medium rounded-full bg-[#FBF8F3] border-2 border-[#0D6734] shadow-md transition-all duration-300 overflow-hidden group focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-400">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-[#FBF8F3]">
                        Conversemos sobre alianzas
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 relative z-10 transition-colors duration-300 group-hover:text-[#FBF8F3]"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span
                        class="absolute left-0 top-0 h-full w-0 bg-[#0D6734] transition-all duration-300 ease-out group-hover:w-full"></span>
                </button>

            </div>
        </div>

    </section>
</template>

<script setup>

const mainPartners = [

    {
        name: 'Patrocinador Coica',
        logo: '/images/amazonFairTrade/Coica.png',
        role: 'Aliado estratégico',
        description: 'Nuestro colaborador principal, comprometido con la sostenibilidad y el bienestar de las comunidades indígenas de la Amazonía.',
        link: 'https://coicamazonia.org/',
    },

    {
        name: 'Confeniae',
        logo: '/images/conAmazonia/ConfenaieNuevo.png',
        role: 'Aliado cultural',
        description: 'Promueven la identidad y el patrimonio cultural de los pueblos indígenas a través de acciones artísticas y educativas.',
        link: 'https://confeniae.net/',
    },


];

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
        description: 'Promueven la identidad y el patrimonio cultural de los pueblos indígenas a través de acciones artísticas y educativas.',
        link: 'https://www-conservation-org.translate.goog/home?_x_tr_sl=en&_x_tr_tl=es&_x_tr_hl=es&_x_tr_pto=tc'
    },
];

const openWhatsApp = () => {
    const phone = '593980405446';
    const message = encodeURIComponent(
        'Hola, deseo unirme a la red de aliados y colaborar con la transformación sostenible de los territorios amazónicos.'
    );
    const url = `https://wa.me/${phone}?text=${message}`;
    window.open(url, '_blank');
}
</script>
