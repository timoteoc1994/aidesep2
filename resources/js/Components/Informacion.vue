<template>
  <section id="informacion" class="bg-gradient-to-b from-white to-gray-50 py-20 px-6 md:px-12 lg:px-20">
    <div class="max-w-7xl mx-auto">
      <!-- Título principal -->
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
          Programas y Gobernanza Indígena
        </h2>
        <div class="h-1 w-24 bg-emerald-600 rounded-full mx-auto mb-4"></div>
        <p class="text-gray-600 max-w-3xl mx-auto text-lg">
          Conoce los pilares fundamentales de nuestro trabajo en economía indígena, 
          programación territorial y gobernanza comunitaria.
        </p>
      </div>

      <!-- Grid de tres columnas -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Economía Indígena -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
          <div class="relative h-64">
            <img 
              src="/storage/amazonFairTrade/Chat3.png" 
              alt="Economía Indígena" 
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white mb-2">ECONOMÍA INDÍGENA</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 text-sm leading-relaxed">
              Bajo los principios de la gobernanza indígena, el desarrollo con identidad y la 
              transparencia, los pueblos indígenas amazónicos deciden de manera autónoma el 
              manejo de su territorio amparados en el derecho a la libre determinación y asumen 
              la tarea de impulsar la economía indígena articulados con el mercado, reduciendo 
              la inequidad, y potenciando las capacidades frente a los desafíos de la globalización.
            </p>
          </div>
        </div>

        <!-- Programación de Economía Indígena (PEI) -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
          <div class="relative h-64">
            <img 
               src="/storage/amazonFairTrade/Chat3.png" 
              alt="Programación de Economía Indígena" 
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-lg font-bold text-white mb-2">PROGRAMACIÓN DE ECONOMÍ INDÍGENA (PEI)</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 text-sm leading-relaxed mb-4">
              Dentro de los objetivos del PEI es afrontar y superar la depredación de la economía 
              extractivista, generar valor agregado mediante el diálogo de saberes y la selva 
              en pie, contribuyendo así a la "Vida Plena" de los pueblos indígenas amazónicos.
            </p>
            <p class="text-gray-700 text-sm leading-relaxed">
              Es así que se ha tenido más de 200 iniciativas autónomas económicas propias 
              para afrontar y superar la depredación en la Amazonía.
            </p>
          </div>
        </div>

        <!-- Gobernanza Participación Comunitaria -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
          <div class="relative h-64">
            <img 
              src="/storage/amazonFairTrade/Chat3.png" 
              alt="Gobernanza Participación Comunitaria" 
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-lg font-bold text-white mb-2">GOBERNANZA PARTICIPACIÓN COMUNITARIA</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-700 text-sm leading-relaxed">
              El Programa de Economía indígena de AIDESEP viene de un proceso de consolidación 
              que remonta desde las primeras experiencias de las organizaciones federativas 
              comunitarias, hace más de 40 años atrás donde se impulsó distintas formas de 
              estructuras económicas desde las propias comunidades nativas, además de ello 
              dichas experiencias fueron trasladados y reafirmados como propuesta en el "I 
              Encuentro Nacional sobre Economía Indígena" realizado el 24 y 25 de octubre 
              en el auditorio de la sede nacional AIDESEP en el año 2012, donde se priorizó 
              gran parte de la línea base de trabajo para su viabilización e implementación.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted } from 'vue'
import AOS from 'aos'

onMounted(() => {
  AOS.refresh()
})
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
</style>