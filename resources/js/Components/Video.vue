<template>
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <!-- Título de la sección -->
      <div class="text-center mb-12">
        <h2  class="text-3xl md:text-6xl sm:text-xl font-bold text-[#00512e] mb-6">
          Conoce Más Sobre la Amazonía
        </h2>
        <p class="text-lg md:text-xl text-[#00512e] max-w-4xl mx-auto leading-relaxed">
          Descubre la riqueza cultural y natural de los pueblos indígenas amazónicos
        </p>
      </div>

      <!-- Video de YouTube -->
      <div class="max-w-4xl mx-auto">
        <div class="relative w-full h-0 pb-[56.25%] rounded-lg overflow-hidden shadow-2xl">
          <iframe
            class="absolute top-0 left-0 w-full h-full"
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            title="Video sobre la Amazonía"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        </div>
        
        <!-- Botón Ver más videos -->
        <div class="mt-8 text-center">
          <button 
            @click="verMasVideos"
            class="bg-[#00512e] hover:bg-[#00512e] text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
          >
            Ver más videos
          </button>
        </div>
        
      </div>
    </div>
  </section>
</template>

<script setup>
// Función para manejar el clic en "Ver más videos"
const verMasVideos = () => {
  // Puedes cambiar esta URL por la de tu canal de YouTube o página de videos
  window.open('https://www.youtube.com/@aidesep', '_blank')
}
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
.container {
  max-width: 1200px;
}

/* Animación suave para el hover del iframe */
iframe {
  transition: transform 0.3s ease;
}

iframe:hover {
  transform: scale(1.02);
}
</style>