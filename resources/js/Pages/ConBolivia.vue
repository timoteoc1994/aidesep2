<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Header from '../Components/HeaderConBolivia.vue'
import Inicio from '../Components/InicioConBolivia.vue'
// use public URL for image placed in `public/images/...`
const logo = '/images/amazonFairTrade/Amazon-Logo-blanco.png'
import Categorias from '../Components/CategoriasConBolivia.vue'
import Vision from '@/Components/VisionConBolivia.vue'
import Patrocinadores from '@/Components/PatrocinadoresConBolivia.vue'
import Footer from '@/Components/FooterConBolivia.vue'
import MapaBolivia from '@/Components/MapaBolivia.vue'
import Noticias from '@/Pages/NoticiasConBolivia.vue'
import NuevaInfo from '@/Components/NuevaInfoBolivia.vue'
import { Head } from '@inertiajs/vue3'

const scrolled = ref(false)
const menuOpen = ref(false)
const activeSection = ref('#inicio')
const showSideNav = ref(true)

const sections = [
  { id: 'inicio', label: 'Inicio' },
  { id: 'categorias', label: 'Categorías' },
  { id: 'mapa', label: 'Mapa' },
  { id: 'nosotros', label: 'Nosotros' },
  { id: 'noticias', label: 'Noticias' },
  { id: 'aliados', label: 'Aliados' }
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
  <title>Amazon Fair Trade Bolivia | Conecta con la Sabiduría Amazónica</title>
  <meta
    name="description"
    content="Descubre Amazon Fair Trade Bolivia: una plataforma que promueve emprendimientos sostenibles, economía indígena y conservación de la Amazonía boliviana."
  />
  <meta
    name="keywords"
    content="Amazon Fair Trade, Bolivia, Amazonía boliviana, emprendimientos sostenibles, economía indígena, conservación ambiental"
  />

  <!-- Open Graph -->
  <meta
    property="og:title"
    content="Amazon Fair Trade Bolivia | Conecta con la Sabiduría Amazónica"
  />
  <meta
    property="og:description"
    content="Explora iniciativas amazónicas en Bolivia que combinan tradición, innovación y conservación. Únete a la red de Amazon Fair Trade Bolivia."
  />
  <meta property="og:type" content="website" />
  <meta
    property="og:url"
    content="https://amazonfairtrade.org/conBolivia"
  />
  <meta
    property="og:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta
    name="twitter:title"
    content="Amazon Fair Trade Bolivia | Conecta con la Sabiduría Amazónica"
  />
  <meta
    name="twitter:description"
    content="Descubre cómo los emprendimientos amazónicos en Bolivia están promoviendo un futuro sostenible y justo."
  />
  <meta
    name="twitter:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <link
    rel="canonical"
    href="https://amazonfairtrade.org/conBolivia"
  />
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
  <Categorias />
  <MapaBolivia />
  <Vision />
  <NuevaInfo />
  <Noticias />
  <Patrocinadores />
  <Footer />
</template>
