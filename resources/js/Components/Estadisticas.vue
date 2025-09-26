<template>
    <section
        id="estadisticas"
        class="py-20 bg-gradient-to-b from-[#f7f8e5] to-[#f7f8e5] "
    >
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
            <!-- Título principal -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h2
                    class="text-3xl md:text-6xl sm:text-xl font-bold text-[#00512e] mb-6"
                >
                    Número que reflejan nuestro trabajo
                </h2>
            </div>

            <!-- Grid de estadísticas -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16"
            >
                <!-- Fortalecimiento a emprendimientos -->
                <div
                    class="text-center"
                    data-aos="fade-up"
                    data-aos-delay="100"
                >
                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2"
                    >
                        <div
                            class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-10 h-10 text-green-600"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                                />
                            </svg>
                        </div>
                        <div
                            class="text-7xl md:text-7xl font-black text-[#00512e] mb-2 bold-boost"
                        >
                            +<span ref="counter1">0</span>
                        </div>
                        <p class="text-gray-600 font-medium">
                            Fortalecimiento a emprendimientos.
                        </p>
                    </div>
                </div>

                <!-- Base de datos iniciativas -->
                <div
                    class="text-center"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2"
                    >
                        <div
                            class="w-20 h-20 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-10 h-10 text-blue-600"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"
                                />
                            </svg>
                        </div>
                        <div
                            class="text-7xl md:text-7xl font-black text-[#00512e] mb-2 bold-boost"
                        >
                            +<span ref="counter2">0</span>
                        </div>
                        <p class="text-[#00512e] font-medium">
                            1era base de datos iniciativas y emprendimientos.
                        </p>
                    </div>
                </div>

                <!-- Encubadora de negocios -->
                <div
                    class="text-center"
                    data-aos="fade-up"
                    data-aos-delay="300"
                >
                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2"
                    >
                        <div
                            class="w-20 h-20 mx-auto mb-6 bg-yellow-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-10 h-10 text-yellow-600"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"
                                />
                            </svg>
                        </div>
                        <div
                            class="text-7xl md:text-7xl font-black text-[#00512e] mb-2 bold-boost"
                        >
                            +<span ref="counter3">0</span>
                        </div>
                        <p class="text-[#00512e] font-medium">
                            1era encubadora de negocios indígenas de AIDESEP.
                        </p>
                    </div>
                </div>

                <!-- Viajes de supervisión -->
                <div
                    class="text-center"
                    data-aos="fade-up"
                    data-aos-delay="400"
                >
                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2"
                    >
                        <div
                            class="w-20 h-20 mx-auto mb-6 bg-orange-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-10 h-10 text-orange-600"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"
                                />
                            </svg>
                        </div>
                        <div
                            class="text-7xl md:text-7xl font-black text-[#00512e] mb-2 bold-boost"
                        >
                            +<span ref="counter4">0</span>
                        </div>
                        <p class="text-[#00512e] font-medium">
                            Viajes de supervisión para la gestión de cadenas de
                            valor.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sección Nuestra voz indígena -->
            <div
                class=" rounded-3xl p-8 md:p-12"
                data-aos="fade-up"
                data-aos-delay="500"
            >
                <div class="text-center">
                    <h3
                        class="text-2xl md:text-3xl font-black text-[#00512e] mb-6 bold-boost2"
                    >
                        Nuestra voz indígena
                    </h3>
                    <p
                        class="text-lg md:text-xl text-[#00512e] max-w-4xl mx-auto leading-relaxed"
                    >
                        Nuestro trabajo en medio de vida "Recoger el legado de
                        nuestros antecesores y enrumbar en la dirección
                        histórica que nos hemos propuesto"
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AOS from "aos";

// Referencias para los contadores
const counter1 = ref(null);
const counter2 = ref(null);
const counter3 = ref(null);
const counter4 = ref(null);

// Función para animar el conteo
const animateCounter = (element, finalValue, duration = 2000) => {
    if (!element) return;

    let startValue = 0;
    const increment = finalValue / (duration / 16); // 60fps

    const timer = setInterval(() => {
        startValue += increment;
        if (startValue >= finalValue) {
            element.textContent = finalValue;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(startValue);
        }
    }, 16);
};

// Intersection Observer para activar animaciones cuando sean visibles
const observeCounters = () => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Iniciar animaciones de conteo
                    setTimeout(
                        () => animateCounter(counter1.value, 10, 2000),
                        200
                    );
                    setTimeout(
                        () => animateCounter(counter2.value, 200, 2500),
                        400
                    );
                    setTimeout(
                        () => animateCounter(counter3.value, 1, 1500),
                        600
                    );
                    setTimeout(
                        () => animateCounter(counter4.value, 36, 2200),
                        800
                    );

                    // Dejar de observar una vez que se activó
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.3 }
    );

    // Observar la sección
    const section = document.getElementById("estadisticas");
    if (section) {
        observer.observe(section);
    }
};

onMounted(() => {
    AOS.refresh();
    // Pequeño delay para asegurar que los elementos estén renderizados
    setTimeout(observeCounters, 100);
});
</script>

<style scoped>
/* Añadir en el <style scoped> de Estadisticas.vue */
.bold-boost {
    /* trazo fino para “engruesar” sin cambiar color principal */
    -webkit-text-stroke: 5px;
    /* sombra suave para más presencia */
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.02),
        0 3px 6px rgba(0, 0, 0, 0.06);
    /* ligera escala si quieres aún más grosor (opcional) */
    transform: scaleY(1.02);
    display: inline-block; /* necesario si usas transform */
}
.bold-boost2 {
    /* trazo fino para “engruesar” sin cambiar color principal */
    -webkit-text-stroke: 1px;
    /* sombra suave para más presencia */
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.02),
        0 3px 6px rgba(0, 0, 0, 0.06);
    /* ligera escala si quieres aún más grosor (opcional) */
    transform: scaleY(1.02);
    display: inline-block; /* necesario si usas transform */
}
</style>
