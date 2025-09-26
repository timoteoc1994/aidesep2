<template>
  <section id="principios" class="bg-[#FFF8EA] py-16 px-4 text-[#124228]">
    <div class="max-w-6xl mx-auto relative">

      <!-- Paso 1 -->
      <div class="grid md:grid-cols-2 gap-8 items-center" data-aos="fade-right">
        <div class="order-2 md:order-1 space-y-4">
          <h3 class="text-3xl font-bold">1. Siembra</h3>
          <p class="text-gray-600 text-lg">
            Al igual que una semilla plantada con la intención de crecer, este nivel representa a los emprendimientos en sus primeras fases. En esta etapa, los proyectos están dando sus primeros pasos y aún no han superado las fases de formalización. Son iniciativas emergentes que funcionan como medios de subsistencia, con el potencial de evolucionar y consolidarse en el tiempo.
          </p>
        </div>
        <div class="order-1 md:order-2 flex justify-center">
          <img src="/images/conAmazonia/Andrea.png" alt="Step 1" class="max-w-sm w-full" />
        </div>
      </div>

      <!-- Paso 2 -->
      <div class="grid md:grid-cols-2 gap-8 items-center" data-aos="fade-left">
        <div class="flex justify-center">
          <img src="/images/conAmazonia/Andrea.png" alt="Step 2" class="max-w-sm w-full" />
        </div>
        <div class="space-y-4">
          <h3 class="text-3xl font-bold">2. Hecha raíces</h3>
          <p class="text-gray-600 text-lg">
            Como una planta que fortalece sus raíces, este nivel representa el momento en que el emprendimiento comienza a consolidarse. Estos proyectos ya están legalmente constituidos y cumplen con los requisitos básicos de funcionamiento. Generan ingresos para sus socios y están en proceso de formalizar su contabilidad. Además, muestran una conexión cada vez más fuerte con la comunidad y la naturaleza, sentando las bases para un crecimiento sostenible.
          </p>
        </div>
      </div>

      <!-- Paso 3 -->
      <div class="grid md:grid-cols-2 gap-8 items-center" data-aos="fade-right">
        <div class="order-2 md:order-1 space-y-4">
          <h3 class="text-3xl font-bold">3. Cosecha</h3>
          <p class="text-gray-600 text-lg">
            Como una planta que ha crecido y da frutos, estos emprendimientos han alcanzado un nivel de madurez y estabilidad. Ya cuentan con todos los permisos y formalidades necesarias para operar. En esta etapa, no solo han formalizado su administración y contabilidad, sino que también generan ingresos justos para toda la cadena de valor. Además, están estrechamente vinculados con las estructuras de gobernanza indígena, contribuyendo activamente al bienestar de la comunidad y a la protección del medioambiente.
          </p>
        </div>
        <div class="order-1 md:order-2 flex justify-center">
          <img src="/images/conAmazonia/Andrea.png" alt="Step 3" class="max-w-sm w-full" />
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-8 items-center" data-aos="fade-left">
        <div class="flex justify-center">
          <img src="/images/conAmazonia/Andrea.png" alt="Step 2" class="max-w-sm w-full" />
        </div>
        <div class="space-y-4">
          <h3 class="text-3xl font-bold">4. Multiplica</h3>
          <p class="text-gray-600 text-lg">
            Como una planta que se expande y da nuevas semillas, estos emprendimientos han alcanzado la consolidación y están en proceso de crecimiento. Su impacto social y su volumen de ventas aumentan, fortaleciendo su presencia en el mercado. En esta etapa, establecen relaciones sólidas de redistribución y acceden a mercados nacionales y regionales. Más que negocios, son motores de cambio que no solo protegen la Amazonía, sino que también revitalizan las economías locales y promueven un desarrollo sostenible.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'

export default {
  name: 'Infografia',
  mounted() {
    AOS.init({
      once: true,
      duration: 1000,
      easing: 'ease-in-out',
    })
  },
}
</script>

<style scoped>
/* Puedes personalizar más si lo necesitas */
</style>
