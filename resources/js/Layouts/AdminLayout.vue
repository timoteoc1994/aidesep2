<script setup>
import { ref, computed } from 'vue'
import { router, usePage, Link, useRemember } from '@inertiajs/vue3'
import { Menu, X, User, LogOut, Settings, Home, BarChart2, FileText } from 'lucide-vue-next'

const page = usePage()
const user = page.props.auth.user
const sidebarOpen = useRemember(true)

function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value
}

function logout() {
    router.post('/logout', {}, {
        onFinish: () => router.visit('/login')
    })
}

const currentRoute = computed(() => page.url)
</script>

<template>
    <div class="flex min-h-screen bg-gray-100 text-gray-900">
        <!-- Sidebar -->
        <aside :class="[sidebarOpen ? 'w-64' : 'w-20', 'transition-all duration-300 bg-white shadow-xl flex flex-col']">
            <!-- Header Sidebar -->
            <div class="flex items-center justify-between p-4 border-b">
                <span v-if="sidebarOpen" class="text-xl font-bold text-emerald-600">Coica Admin</span>
                <button @click="toggleSidebar" class="text-gray-500 hover:text-emerald-600 transition">
                    <component :is="sidebarOpen ? X : Menu" class="w-5 h-5" />
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto p-2 space-y-1">
                <Link href="/dashboard" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded transition-all',
                    currentRoute.includes('/dashboard') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50 text-gray-700'
                ]">
                <Home class="w-5 h-5" />
                <span v-if="sidebarOpen">Inicio</span>
                </Link>

                <Link href="/profile" :class="[
                    'flex items-center gap-3 px-3 py-2 rounded transition-all',
                    currentRoute.includes('/profile') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50 text-gray-700'
                ]">
                <User class="w-5 h-5" />
                <span v-if="sidebarOpen">Perfil</span>
                </Link>

                <template v-if="user.role?.name === 'SuperAdmin'">
                    <Link href="/crear-admin" :class="[
                        'flex items-center gap-3 px-3 py-2 rounded transition-all',
                        currentRoute.includes('/crear-admin') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-green-50 text-gray-700'
                    ]">
                    <FileText class="w-5 h-5" />
                    <span v-if="sidebarOpen">Crear Admin</span>
                    </Link>
                    <Link href="/crear-producto" :class="[
                        'flex items-center gap-3 px-3 py-2 rounded transition-all',
                        currentRoute.includes('/crear-producto') ? 'bg-purple-100 text-purple-700 font-semibold' : 'hover:bg-purple-50 text-gray-700'
                    ]">
                    <FileText class="w-5 h-5" />
                    <span v-if="sidebarOpen">Crear Producto</span>
                    </Link>
                </template>

                <template v-else-if="user.role?.name === 'AdminEmprendimientos'">
                    <Link href="/crear-emprendimiento" :class="[
                        'flex items-center gap-3 px-3 py-2 rounded transition-all',
                        currentRoute.includes('/crear-emprendimiento') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50 text-gray-700'
                    ]">
                    <FileText class="w-5 h-5" />
                    <span v-if="sidebarOpen">Crear Emprendimiento</span>
                    </Link>
                </template>

                <div class="flex items-center gap-3 px-3 py-2 text-gray-400 cursor-not-allowed">
                    <BarChart2 class="w-5 h-5" />
                    <span v-if="sidebarOpen">Estadísticas</span>
                </div>
            </nav>


            <!-- Footer logout siempre abajo -->
            <div :class="[sidebarOpen ? 'w-64' : 'w-20', 'p-4 border-t absolute bottom-0 ']">
                <button @click="logout"
                    class="flex items-center gap-2 w-full bg-red-600 text-white py-2 px-3 rounded hover:bg-red-700 transition">
                    <LogOut class="w-4 h-4" />
                    <span v-if="sidebarOpen">Cerrar sesión</span>
                </button>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
                <div>
                    <h1 class="text-xl font-bold text-emerald-800">Panel de</h1>
                    <h2 class="text-2xl font-extrabold">{{ user.name.toUpperCase() }}</h2>
                    <p class="text-gray-600">Este es tu panel personalizado.</p>
                </div>

                <Link href="/profile" class="flex items-center gap-2 text-sm text-gray-600 hover:text-emerald-600">
                <Settings class="w-4 h-4" /> Configuración de perfil
                </Link>
            </header>

            <slot />
        </main>
    </div>
</template>
