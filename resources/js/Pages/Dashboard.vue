<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

/**
 * Componente Dashboard Principal
 *
 * Este componente muestra un resumen estadístico general del sistema
 * con métricas clave para la gestión administrativa.
 */

// Props recibidos desde el controlador
const props = defineProps({
    dashboardStats: {
        type: Object,
        required: true,
    },
});

// Acceso optimizado a los datos estadísticos
const stats = computed(() => props.dashboardStats);

// Estado para animaciones de contador
const animate = ref(false);

// Iniciar animaciones cuando el componente se monta
onMounted(() => {
    setTimeout(() => {
        animate.value = true;
    }, 100);
});
</script>

<template>
    <Head title="Panel de Control" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <span class="text-xl font-semibold text-gray-800">Panel de Control</span>
            </div>
        </template>

        <div class="p-6">
            <!-- Tarjeta principal del dashboard -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-lg font-medium text-gray-800">Resumen Estadístico</h2>
                    <p class="text-sm text-gray-500 mt-1">Vista general de métricas principales del sistema</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Emprendimientos -->
                        <div class="bg-gradient-to-br from-blue-50 to-white rounded-lg border border-blue-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-blue-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Emprendimientos</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_emprendimientos }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Productos -->
                        <div class="bg-gradient-to-br from-green-50 to-white rounded-lg border border-green-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-green-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Productos</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_productos }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Noticias -->
                        <div class="bg-gradient-to-br from-amber-50 to-white rounded-lg border border-amber-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-amber-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Noticias</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_noticias }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Usuarios -->
                        <div class="bg-gradient-to-br from-red-50 to-white rounded-lg border border-red-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-red-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Usuarios</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_usuarios }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Países -->
                        <div class="bg-gradient-to-br from-purple-50 to-white rounded-lg border border-purple-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-purple-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Países</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_paises }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categorías -->
                        <div class="bg-gradient-to-br from-indigo-50 to-white rounded-lg border border-indigo-100 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-center p-5">
                                <div class="bg-indigo-100 rounded-lg p-3 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Categorías</div>
                                    <div class="text-2xl font-bold text-gray-800 mt-1"
                                         :class="{ 'transition-all duration-1000': animate }">
                                        {{ stats.total_categorias }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Espacio para más componentes del dashboard -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Última actualización: {{ new Date().toLocaleDateString() }}</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
