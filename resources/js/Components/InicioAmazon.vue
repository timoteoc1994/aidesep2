<template>
    <Head>
  <title>Amazon Fair Trade | Bioemprendimientos de la Economía Indígena Amazónica</title>
  <meta
    name="description"
    content="Amazon Fair Trade es una plataforma digital que promueve y comercializa bioemprendimientos inspirados en la Economía Indígena, destacando la riqueza natural y cultural de la Amazonía."
  />
  <meta
    name="keywords"
    content="Amazon Fair Trade, bioemprendimientos, economía indígena, Amazonía, comercio justo, bioemprendedores, cultura amazónica"
  />

  <!-- Open Graph -->
  <meta
    property="og:title"
    content="Amazon Fair Trade | Bioemprendimientos de la Economía Indígena Amazónica"
  />
  <meta
    property="og:description"
    content="Descubre y apoya bioemprendimientos amazónicos que conjugan innovación y saberes ancestrales de la Economía Indígena."
  />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://amazonfairtrade.org/" />
  <meta
    property="og:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta
    name="twitter:title"
    content="Amazon Fair Trade | Bioemprendimientos de la Economía Indígena Amazónica"
  />
  <meta
    name="twitter:description"
    content="Apoya y conoce bioemprendimientos inspirados en los saberes de la Economía Indígena de la Amazonía."
  />
  <meta
    name="twitter:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <link rel="canonical" href="https://amazonfairtrade.org/" />
</Head>

    <section
      id="inicio"
      class="relative flex items-center justify-center min-h-screen bg-[#FBF8F3] px-4 pt-18 overflow-hidden"
    >
      <!-- Patrón decorativo (solo visible en lg+) -->
      <img
        v-for="pattern in patterns"
        :key="pattern.name"
        :src="pattern.src"
        :alt="pattern.alt"
        class="hidden lg:block absolute z-10"
        :class="pattern.position"
        loading="lazy"
        decoding="async"
        :data-aos="pattern.aos"
        :data-aos-duration="pattern.duration"
      />

      <!-- Contenido central -->
      <div class="relative z-20 max-w-2xl text-center">
        <img
          src="/images/amazonFairTrade/Amazon-logo-color.webp"
          alt="Amazon Fair Trade Logo"
          class="mx-auto mb-6 w-60 sm:w-72 md:w-80"
          width="320" height="80"
          loading="lazy"
          decoding="async"
          @load="refreshAOS"
          data-aos="fade-up"
          data-aos-duration="1400"
        />

        <p
          class="mt-4 text-[#0E6736] text-sm sm:text-base md:text-lg font-light leading-relaxed"
          data-aos="fade-up"
          data-aos-duration="1400"
        >
          Una plataforma digital dedicada a promover y comercializar bioemprendimientos
          inspirados en la Economía Indígena, resaltando la riqueza natural y cultural de la Amazonía.
        </p>
      </div>
    </section>
  </template>

  <script setup>
  import { onMounted } from 'vue'
  import AOS from 'aos'
  import 'aos/dist/aos.css'
import { Head } from '@inertiajs/vue3'

  // Patrón decorativo ahora como <img> para permitir lazy loading nativo
  const patterns = [
    {
      name: 'izquierdo',
      src: '/images/amazonFairTrade/lateral-izquierdo.webp',
      alt: '',
      position: 'left-0 mt-24 h-full w-36 object-contain',
      aos: 'fade-right',
      duration: 1200,
    },
    {
      name: 'derecho',
      src: '/images/amazonFairTrade/lateral-derecho.webp',
      alt: '',
      position: 'right-0 mt-24 h-full w-36 object-contain',
      aos: 'fade-left',
      duration: 1200,
    },
  ]

  function refreshAOS() {
    AOS.refresh()
  }

  onMounted(() => {
    AOS.init({
      once: true,
      duration: 1400,
      easing: 'ease-in-out',
    })
  })
  </script>

  <style scoped>
  /* Si necesitas afinar algo más, por ejemplo:
  #inicio { padding-top: 4.5rem; } */
  </style>
