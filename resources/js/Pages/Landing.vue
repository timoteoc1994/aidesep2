<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import Header from '../Components/Header.vue'
import HeaderAmazon from '../Components/HeaderAmazon.vue'
import Inicio from '../Components/Inicio.vue'
import InicioAmazon from '../Components/InicioAmazon.vue'
import Sabiduria from '../Components/Sabiduria.vue'
import SabiduriaAmazon from '../Components/SabiduriaAmazon.vue'
const logoNuevo = '/images/amazonFairTrade/Amazon-Logo-blanco.png'
const logoBlanco = '/images/amazonFairTrade/Amazon-icono.png'
import AmazoniaMapa from '../Components/AmazoniaMapa.vue'
import Categorias from '../Components/Categorias.vue'
import VisionAmazonia from '@/Components/VisionAmazonia.vue'
import Bienvenida from '@/Components/Bienvenida.vue'
import PrincipiosCarousel from '@/Components/PrincipiosCarousel.vue'
import ProcesoTerritorial from '@/Components/ProcesoTerritorial.vue'
import Patrocinadores from '@/Components/Patrocinadores.vue'
import Footer from '@/Components/Footer.vue'
import Noticias from '@/Pages/Noticias.vue'
import NuevoAmazon from '@/Components/NuevoAmazon.vue'
import { Head } from '@inertiajs/vue3'

const scrolled = ref(false)
const menuOpen = ref(false)
const activeSection = ref('#inicio')
const showSideNav = ref(true)

const logoActual = computed(() =>
  activeSection.value === '#inicio' ? logoBlanco : logoNuevo
)
const sections = [
  { id: 'inicio', label: 'Inicio' },
  { id: 'sabiduria', label: 'Sabiduría' },
  { id: 'categorias', label: 'Categorías' },
  { id: 'mapa', label: 'Mapa' },
  { id: 'nosotros', label: 'Nosotros' },
  { id: 'principios', label: 'Principios' },
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
  <title>Amazon Fair Trade – Conecta con Sabiduría y Bioemprendimientos de la Amazonía</title>
  <meta
    name="description"
    content="Amazon Fair Trade es una plataforma digital que promueve bioemprendimientos indígenas de la Amazonía, impulsando comercio justo, conservación y valorización cultural."
  />
  <meta
    name="keywords"
    content="Amazon Fair Trade, bioemprendimientos, economía indígena, sabiduría ancestral, comercio justo, conservación, Amazonía"
  />

  <!-- Open Graph -->
  <meta
    property="og:title"
    content="Amazon Fair Trade – Conecta con Sabiduría y Bioemprendimientos de la Amazonía"
  />
  <meta
    property="og:description"
    content="Descubre cómo Amazon Fair Trade impulsa bioemprendimientos indígenas, comercio justo y el cuidado de la Amazonía a través de la sabiduría ancestral."
  />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://amazonfairtrade.org" />
  <meta
    property="og:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta
    name="twitter:title"
    content="Amazon Fair Trade – Sabiduría y Bioemprendimientos de la Amazonía"
  />
  <meta
    name="twitter:description"
    content="Conoce cómo Amazon Fair Trade promueve la conservación, el comercio justo y los saberes ancestrales de la Amazonía."
  />
  <meta
    name="twitter:image"
    content="https://amazonfairtrade.org/images/amazonFairTrade/Amazon-logo-color.webp"
  />

  <link rel="canonical" href="https://amazonfairtrade.org" />
</Head>

  <HeaderAmazon
    :sections="sections"
    :activeSection="activeSection"
    :scrolled="scrolled"
    :smoothScrollTo="smoothScrollTo"
    :menuOpen="menuOpen"
    :toggleMenu="toggleMenu"
    :logo="logoActual"
  />
  <InicioAmazon :smoothScrollTo="smoothScrollTo" />
  <NuevoAmazon />
  <SabiduriaAmazon />
  <Sabiduria />
  <Categorias />
  <AmazoniaMapa />
  <VisionAmazonia />
  <Bienvenida />
  <PrincipiosCarousel />
  <Noticias />
  <ProcesoTerritorial />
  <Patrocinadores />
  <Footer />
</template>
