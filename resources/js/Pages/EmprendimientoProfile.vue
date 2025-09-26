<template>
    <Head>
      <!-- Título y descripción dinámicos -->
      <title>{{ pageTitle }}</title>
      <meta name="description" :content="pageDescription" />
      <meta name="keywords" :content="emprendimiento.titulo + ', emprendimiento Amazonía, ' + emprendimiento.pais.nombre" />

      <!-- Open Graph -->
      <meta property="og:title" :content="pageTitle" />
      <meta property="og:description" :content="pageDescription" />
      <meta property="og:type" content="website" />
      <meta property="og:url" :content="pageUrl" />
      <meta property="og:image" :content="pageImage" />

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" :content="pageTitle" />
      <meta name="twitter:description" :content="pageDescription" />
      <meta name="twitter:image" :content="pageImage" />

      <!-- URL canónica -->
      <link rel="canonical" :href="pageUrl" />
    </Head>

    <Header
      :sections="sections"
      :activeSection="activeSection"
      :scrolled="scrolled"
      :smoothScrollTo="smoothScrollTo"
      :menuOpen="menuOpen"
      :toggleMenu="toggleMenu"
      :emprendimiento="emprendimiento"
      :logo="logo"
    />

    <Inicio :emprendimiento="emprendimiento" :smoothScrollTo="smoothScrollTo" />
    <MaduruNosotros :emprendimiento="emprendimiento" />
    <Nosotros2Manduru :emprendimiento="emprendimiento" />
    <ProductosProfile :emprendimiento="emprendimiento" />
    <MisionMandura :emprendimiento="emprendimiento" />
    <Patrocinadores />
    <Footer />
  </template>

  <script setup>
  import { ref, onMounted, onUnmounted, computed } from 'vue'
  import { defineProps } from 'vue'

  import Header from '../Components/HeaderPaises.vue'
  import Inicio from '../Components/IniciProfile.vue'

  import logoEcuador from '../../../public/images/conAmazonia/LogoConAmazonia.png'
  const logoBolivia = '/images/amazonFairTrade/Amazon-Logo-blanco.png'

  import MaduruNosotros from '@/Components/MaduruNosotros.vue'
  import Nosotros2Manduru from '@/Components/Nosotros2Manduru.vue'
  import ProductosProfile from '@/Components/ProductosProfile.vue'
  import MisionMandura from '@/Components/MisionMandura.vue'
  import Patrocinadores from '@/Components/PatrocinadoresProfile.vue'
  import Footer from '@/Components/FooterMandura.vue'
import { Head } from '@inertiajs/vue3'

  // Props
  const props = defineProps({
    emprendimiento: {
      type: Object,
      required: true
    }
  })

  // Extraer emprendimiento
  const emprendimiento = props.emprendimiento

  // Logo dinámico según el país
  const logo = ref(logoEcuador)
  if (
    emprendimiento.pais_id === 4 ||
    emprendimiento.pais?.codigo === 'BO'
  ) {
    logo.value = logoBolivia
  }

  // Datos meta dinámicos
  const pageTitle = computed(() => `${emprendimiento.titulo} | ${emprendimiento.pais.nombre}`)
  const pageDescription = computed(() => {
    return emprendimiento.descripcion
      ? emprendimiento.descripcion.slice(0, 160)
      : `Conoce ${emprendimiento.titulo}, emprendimiento de la Amazonía en ${emprendimiento.pais.nombre}.`
  })

  const pageUrl = computed(
  () => `https://amazonfairtrade.org/emprendimiento/${emprendimiento.slug}`
)

const pageImage = computed(() => {
  return emprendimiento.imagen_principal
    ? `https://amazonfairtrade.orghttps://amazonfairtrade.org/storage/${emprendimiento.imagen_principal}`
    : 'https://amazonfairtrade.org/images/default-emprendimiento.png'
})
  // Scroll y navegación
  const scrolled = ref(false)
  const menuOpen = ref(false)
  const activeSection = ref('#inicio')
  const showSideNav = ref(true)

  const sections = [
    { id: 'inicio', label: 'Inicio' },
    { id: 'nosotros', label: 'Nosotros' },
    { id: 'productos', label: 'Productos' },
    { id: 'mision', label: 'Misión' }
  ]

  const getHeaderOffset = () => {
    if (window.innerWidth < 640) return 60
    if (window.innerWidth < 1024) return 70
    return 80
  }

  const smoothScrollTo = (id) => {
    const element = document.getElementById(id)
    if (element) {
      window.scrollTo({
        behavior: 'smooth',
        top: element.offsetTop - getHeaderOffset()
      })
      menuOpen.value = false
    }
  }

  const toggleMenu = () => {
    menuOpen.value = !menuOpen.value
  }

  const handleScroll = () => {
    const inicioEl = document.getElementById('inicio')
    const rect = inicioEl?.getBoundingClientRect()
    if (rect) {
      showSideNav.value = rect.bottom > window.innerHeight / 2
    }

    const scrollPos = window.scrollY + getHeaderOffset() + 1
    for (let i = sections.length - 1; i >= 0; i--) {
      const section = sections[i]
      const el = document.getElementById(section.id)
      if (
        el &&
        scrollPos >= el.offsetTop &&
        scrollPos < el.offsetTop + el.offsetHeight
      ) {
        activeSection.value = `#${section.id}`
        break
      }
    }

    scrolled.value = window.scrollY > 50
  }

  onMounted(() => window.addEventListener('scroll', handleScroll))
  onUnmounted(() => window.removeEventListener('scroll', handleScroll))
  </script>

  <style scoped>
  /* No cambios en el estilo específico para este componente */
  </style>
