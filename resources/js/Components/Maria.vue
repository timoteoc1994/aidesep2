<template>
    <section id="nosotros" class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 bg-[#124228] text-[#FFF8EA]">
        <!-- Columna izquierda: Imágenes -->
        <div class="relative flex flex-col items-center justify-center p-4 h-full">
            <!-- Imagen superior -->
            <img src="/images/conAmazonia/Andrea.png" alt="Maria Image 1"
                class="w-full max-w-md h-auto object-cover z-10 relative" />
            <!-- Imagen inferior -->
            <img src="/images/conAmazonia/Adorno-1.png" alt="Maria Image 2"
                class="w-full max-w-md h-auto object-cover absolute z-0" />
        </div>
        <!-- Columna derecha: Texto -->
        <div class="flex flex-col justify-start max-w-lg mt-10">
            <!-- Título principal -->
            <!-- Nombre -->
            <p class="font-medium text-2xl ">María José Andrade Cerda</p>

            <!-- Cargo -->
            <p class="text-lg text-[#FFF8EA] mb-16">Dirigente de economía y desarrollo comunitario CONFEINAE</p>
            <div class="h-1 w-48 bg-[#72A846] rounded-full mb-8"></div>

            <h2 class="text-4xl font-bold mb-4 text-[#FFF8EA]">Vivir sosteniblemente en el corazón de la Amazonía</h2>

            <!-- Párrafo con scroll si es muy largo -->
            <div class="text-lg text-[#FFF8EA] leading-relaxed mb-8 max-h-64 overflow-y-auto pr-5 custom-scroll">
                CON AMAZONIA nace como una solución a los grandes desafíos que enfrentan los emprendimientos indígenas
                amazónicos para acceder a mercados y destacar su valor único. A lo largo del tiempo, estos proyectos han
                recibido apoyo en producción, transformación y gestión, pero han crecido de estrategias comerciales
                sólidas que les permiten crecer y ser sostenibles.CON AMAZONIA nace como una solución a los grandes
                desafíos que enfrentan los emprendimientos indígenas
                amazónicos para acceder a mercados y destacar su valor único. A lo largo del tiempo, estos proyectos han
                recibido apoyo en producción, transformación y gestión, pero han crecido de estrategias comerciales
                sólidas que les permiten crecer y ser sostenibles.
            </div>

        </div>
    </section>
</template>

<script>
export default {
    name: 'Maria',
}
</script>
