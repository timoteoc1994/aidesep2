<template>
    <section class="relative w-full bg-[#FBF8F3] py-16 px-6 md:px-12 lg:px-20">
      <h3 data-aos="zoom-in" data-aos-delay="400" class="text-3xl md:text-4xl font-extrabold text-center mt-16 mb-12 text-[#ab821a]">
        ¿Qué podemos encontrar?
      </h3>

      <div class="max-w-6xl mx-auto grid gap-8 md:grid-cols-3">
        <!-- Tarjeta 1 -->
        <div data-aos="fade-up"
        data-aos-duration="1400"class="group rounded-2xl p-4 overflow-hidden shadow-md transition-all duration-300 bg-[#E5EEEB] hover:-translate-y-2 hover:bg-[#244041] ">
          <img data-aos="zoom-in" data-aos-delay="100" src="/images/amazonFairTrade/productos-sostenibles.jpg" alt="Productos sostenibles"
            class="w-full h-56 object-cover rounded-xl" />
          <div class="mt-4 text-center">
            <h4 class="font-bold text-lg mb-3 text-[#AB8219] group-hover:text-[#AB8219]">
              Productos sostenibles y éticos
            </h4>
            <p class="text-[#244041] leading-relaxed group-hover:text-[#FBF8F3]">
              Gastronomía, artesanía, cosmética natural y más, elaborados con técnicas ancestrales y respetando el equilibrio ecológico.
            </p>
          </div>
        </div>

        <!-- Tarjeta 2 -->
        <div data-aos="fade-up"
        data-aos-duration="1400" class="group rounded-2xl p-4 overflow-hidden shadow-md transition-all duration-300 bg-[#E5EEEB] hover:-translate-y-2 hover:bg-[#244041]">
          <img data-aos="zoom-in" data-aos-delay="100" src="/images/amazonFairTrade/impacto-ambiental.png" alt="Impacto ambiental positivo"
            class="w-full h-56 object-cover rounded-xl" />
          <div class="mt-4 text-center">
            <h4 class="font-bold text-lg mb-3 text-[#AB8219] group-hover:text-[#AB8219]">
              Impacto ambiental positivo
            </h4>
            <p class="text-[#244041] leading-relaxed group-hover:text-[#FBF8F3]">
              Cada compra apoya la conservación de la Amazonía y el empoderamiento de sus comunidades guardianas.
            </p>
          </div>
        </div>

        <!-- Tarjeta 3 -->
        <div data-aos="fade-up"
        data-aos-duration="1400"class="group rounded-2xl p-4 overflow-hidden shadow-md transition-all duration-300 bg-[#E5EEEB] hover:-translate-y-2 hover:bg-[#244041]">
          <img data-aos="zoom-in" data-aos-delay="100" src="/images/amazonFairTrade/comercio-justo.jpg" alt="Comercio Justo"
            class="w-full h-56 object-cover rounded-xl" />
          <div class="mt-4 text-center">
            <h4 class="font-bold text-lg mb-3 text-[#AB8219] group-hover:text-[#AB8219]">
              Comercio Justo
            </h4>
            <p class="text-[#244041] leading-relaxed group-hover:text-[#FBF8F3]">
              Garantizamos que los productores indígenas reciban un pago justo por su trabajo, impulsando el desarrollo local y la preservación de sus tradiciones.
            </p>
          </div>
        </div>
      </div>
    </section>
  </template>

  <script setup>
  // Ya no necesitas los iconos de lucide
  import AOS from 'aos'
  import 'aos/dist/aos.css'
  </script>
