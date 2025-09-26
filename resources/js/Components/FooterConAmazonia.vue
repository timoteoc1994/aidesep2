<template>
  <footer class="bg-[#005120] text-white py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        
        <!-- Sección izquierda: Logo y descripción -->
        <div class="space-y-6">
          <!-- Logo AIDESEP -->
          <div class="flex items-center space-x-4 mb-6">
            <img 
              :src="logo" 
              alt="AIDESEP Logo" 
              class="h-20 w-20 bg-white rounded-lg p-2"
            >
            <div>
              <h3 class="text-2xl font-bold">AIDESEP</h3>
              <p class="text-sm opacity-90">ASOCIACIÓN INTERÉTNICA DE DESARROLLO</p>
              <p class="text-sm opacity-90">DE LA SELVA PERUANA</p>
            </div>
          </div>

          <!-- Descripción -->
          <div class="text-sm leading-relaxed opacity-90 max-w-lg">
            <p>
              Somos la organización vocera de los pueblos indígenas de la Amazonía peruana, 
              cuya misión es la de trabajar en la defensa y respeto de los derechos colectivos, 
              exponer su problemática y presentar las propuestas alternativas de desarrollo 
              que plantean según su cosmovisión y estilo de vida.
            </p>
          </div>

          <!-- Redes sociales -->
          <div class="flex space-x-4 pt-4">
            <a 
              href="https://www.facebook.com/aidesep/" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="Facebook"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
            
                        <a 
              href="https://www.instagram.com/aidesepperu/" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="Instagram"
              target="_blank"
              rel="noopener noreferrer"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
              </svg>
            </a>
            
            <a 
              href="https://x.com/aidesep_org" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="Twitter"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
              </svg>
            </a>
            
            <a 
              href="https://www.youtube.com/c/AIDESEPAIDESEPCOMUNIDADESINDIGENAS" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="YouTube"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
              </svg>
            </a>
            
            <a 
              href="https://www.flickr.com/people/aidesepueblosindigenas/" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="Flickr"
              target="_blank"
              rel="noopener noreferrer"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M0 12c0-3.74 4.05-6.67 6.67-6.67S13.33 8.26 13.33 12s-4.05 6.67-6.66 6.67S0 15.74 0 12zm10.67 0c0-3.74 4.05-6.67 6.66-6.67S24 8.26 24 12s-4.05 6.67-6.67 6.67-6.66-2.93-6.66-6.67z"/>
              </svg>
            </a>
            
            <a 
              href="https://soundcloud.com/aidesep" 
              class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-all duration-300"
              aria-label="SoundCloud"
              target="_blank"
              rel="noopener noreferrer"
            >
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M1.175 13.37c-.094 0-.175-.081-.175-.175v-2.39c0-.094.081-.175.175-.175s.175.081.175.175v2.39c0 .094-.081.175-.175.175zm.525-.35c-.094 0-.175-.081-.175-.175v-1.69c0-.094.081-.175.175-.175s.175.081.175.175v1.69c0 .094-.081.175-.175.175zm.525-.35c-.094 0-.175-.081-.175-.175v-1.01c0-.094.081-.175.175-.175s.175.081.175.175v1.01c0 .094-.081.175-.175.175zm.525-.18c-.094 0-.175-.081-.175-.175v-.65c0-.094.081-.175.175-.175s.175.081.175.175v.65c0 .094-.081.175-.175.175zm.525-.11c-.094 0-.175-.081-.175-.175v-.43c0-.094.081-.175.175-.175s.175.081.175.175v.43c0 .094-.081.175-.175.175zm12.1-.175c0 .91-.74 1.65-1.65 1.65H8.4c-.19 0-.35-.16-.35-.35V8.5c0-.19.16-.35.35-.35.09 0 .16-.07.17-.16.32-1.6 1.77-2.8 3.48-2.8 1.94 0 3.52 1.58 3.52 3.52 0 .26-.03.51-.09.75-.01.03.01.06.04.07.28.05.56.08.84.08 1.41-.01 2.61 1.13 2.61 2.54z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Sección derecha: Información de contacto -->
        <div class="space-y-6">
          <h3 class="text-2xl font-bold mb-6">Contacto</h3>
          
          <div class="space-y-4">
            <!-- Dirección -->
            <div class="flex items-start space-x-3">
              <svg class="w-5 h-5 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
              </svg>
              <div>
                <p class="font-medium">Av. San Eugenio 981, Urb. Santa</p>
                <p class="font-medium">Catalina, La Victoria, Lima, Perú</p>
              </div>
            </div>

            <!-- Email -->
            <div class="flex items-center space-x-3">
              <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
              </svg>
              <a 
                href="mailto:aidesep@aidesep.net.pe" 
                class="hover:underline font-medium"
              >
                aidesep@aidesep.net.pe
              </a>
            </div>

            <!-- Teléfonos -->
            <div class="space-y-2">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
                <span class="font-medium">+51 01 4724605</span>
              </div>
              
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
                <span class="font-medium">+51 01 4717118</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Línea divisoria -->
      <div class="border-t border-white border-opacity-20 mt-12 pt-8">
        <div class="text-center text-sm opacity-75">
          <p>&copy; {{ new Date().getFullYear() }} AIDESEP - Asociación Interétnica de Desarrollo de la Selva Peruana. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import logo from '../../../public/aidesep/aidesep_logo.png'
</script>

<style scoped>
.container {
  max-width: 1200px;
}

/* Animaciones suaves para las redes sociales */
a {
  transition: all 0.3s ease;
}

/* Hover effects para iconos de redes sociales */
.hover\:bg-opacity-30:hover {
  transform: translateY(-2px);
}
</style>