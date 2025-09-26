<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Header from '../Components/HeaderConAmazonia.vue'
import Inicio from '../Components/InicioConAmazonia.vue'
import Informacion from '../Components/Informacion.vue'
import Estadisticas from '../Components/Estadisticas.vue'
import Video from '../Components/Video.vue'
import Sabiduria from '../Components/SabiduriaConAmazonia.vue'
import logo from '../../../public/aidesep/aidesep_logo.png'
import AmazoniaMapa from '../Components/AmazoniaMapa.vue'
import Categorias from '../Components/CategoriasConAmazonia.vue'
import VisionAmazonia from '@/Components/VisionConAmazonia.vue'
import Bienvenida from '@/Components/Bienvenida.vue'
import PrincipiosCarousel from '@/Components/PrincipiosCarousel.vue'
import ProcesoTerritorial from '@/Components/ProcesoTerritorialConAmazonia.vue'
import Patrocinadores from '@/Components/PatrocinadoresConAmazonia.vue'
import Footer from '@/Components/FooterConAmazonia.vue'
import MapaEcuador from '@/Components/MapaEcuador.vue'
import Maria from '@/Components/Maria.vue'
import Infografia from '@/Components/Infografia.vue'
import InfografiaCurva from '@/Components/InfografiaCurva.vue'
import Noticias from '@/Pages/NoticiasConAmazonia.vue'
import NoticiasNuevo from '@/Components/NoticiasNuevo.vue'

import NuevaInfo from '@/Components/NuevaInfo.vue'
import { Head } from '@inertiajs/vue3'

const scrolled = ref(false)
const menuOpen = ref(false)
const activeSection = ref('#inicio')
const showSideNav = ref(true)

const sections = [
  { id: 'inicio', label: 'INICIO' },
  { id: 'categorias', label: 'CATEGORÍAS' },
  { id: 'mapa', label: 'MAPA' },
  { id: 'nosotros', label: 'NOSOTROS' },
  { id: 'noticias', label: 'NOTICIAS' },
  { id: 'aliados', label: 'ALIADOS' }
]

const getHeaderOffset = () => {
  if (window.innerWidth < 640) return 60    // móvil
  if (window.innerWidth < 1024) return 70   // tablet
  return 80                                 // desktop
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
  const inicio = document.getElementById('inicio')
  const rect = inicio?.getBoundingClientRect()
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

<template>
      <Head>
    <!-- Título y descripción -->
    <title>Con Amazonía | Conexión, Cultura y Sostenibilidad</title>
    <meta
      name="description"
      content="Desde el corazón de la selva, los pueblos indígenas protegen la Amazonía, impulsan economías sostenibles y comparten sabiduría ancestral. Con Amazonía es tu conexión con la cultura y la sostenibilidad de la región."
    />
    <meta
      name="keywords"
      content="Con Amazonía, Amazonía sostenible, cultura indígena, emprendimientos amazónicos, sabiduría ancestral, Conexión Cultural"
    />

    <!-- Open Graph -->
    <meta property="og:title" content="Con Amazonía | Conexión, Cultura y Sostenibilidad" />
    <meta
      property="og:description"
      content="Descubre cómo los pueblos indígenas de la Amazonía protegen el bioma, fomentan economías sostenibles y comparten sus saberes ancestrales. Con Amazonía es tu puente hacia la cultura y la sostenibilidad de la región."
    />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://conamazonia.com/" />
    <meta
      property="og:image"
      content="https://conamazonia.com/images/conAmazonia/Patrones.webp"
    />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Con Amazonía | Conexión, Cultura y Sostenibilidad" />
    <meta
      name="twitter:description"
      content="Conoce cómo la Amazonía cobra vida a través de la sabiduría ancestral indígena, la cultura y la sostenibilidad."
    />
    <meta name="twitter:image" content="https://conamazonia.com/images/conAmazonia/Patrones.webp" />

    <!-- URL canónica -->
    <link rel="canonical" href="https://conamazonia.com/" />
  </Head>

  <Header
    :sections="sections"
    :activeSection="activeSection"
    :scrolled="scrolled"
    :smoothScrollTo="smoothScrollTo"
    :menuOpen="menuOpen"
    :toggleMenu="toggleMenu"
    :logo="logo"
  />
  <Inicio :smoothScrollTo="smoothScrollTo" />
  <Informacion />
  <Estadisticas />
  <Video />
  
  <MapaEcuador />
<!--   <VisionAmazonia />
  <NuevaInfo />
  <Noticias />
  <Patrocinadores /> -->
  <Noticias />
  <Footer />
</template>
