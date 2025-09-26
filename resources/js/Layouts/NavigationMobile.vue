<template>
    <transition enter-active-class="transition ease-in-out duration-150" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition ease-in-out duration-150"
        leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-show="$page.props.showingMobileMenu"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
    </transition>
    <transition enter-active-class="transition ease-in-out duration-150"
        enter-from-class="opacity-0 transform -translate-x-20" enter-to-class="opacity-100"
        leave-active-class="transition ease-in-out duration-150" leave-from-class="opacity-100"
        leave-to-class="opacity-0 transform -translate-x-20">
        <aside v-show="$page.props.showingMobileMenu"
            class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden">
            <div class="py-4 text-gray-500">
                <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
                Windmill
                </Link>
                <ul class="mt-6">
  <li v-if="isSuperAdmin" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
      <template #icon>
        <!-- Dashboard -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
        </svg>
      </template>
      Dashboard
    </ResponsiveNavLink>
  </li>

  <li v-if="isSuperAdmin" class="relative px-6 py-3">
  <ResponsiveNavLink :href="route('emprendimientos.listado')" :active="route().current('emprendimientos.listado')">
    <template #icon>
      <!-- Icono de edificio o comunidad para representar emprendimientos -->
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 17l6-6 4 4 8-8M13 7h8v8" />
      </svg>
    </template>
    Emprendimientos
  </ResponsiveNavLink>
</li>

  <li v-if="isSuperAdmin" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('noticias.listado')" :active="route().current('noticias.listado')">
      <template #icon>
        <!-- Noticias -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h11l5 5v9a2 2 0 01-2 2z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 13h-6m6 4h-6m-2-4H7m0 4h2"/>
        </svg>
      </template>
      Noticias
    </ResponsiveNavLink>
  </li>

  <li v-if="isAdminEmprendedor" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('mis-productos')" :active="route().current('mis-productos')">
      <template #icon>
        <!-- Mis productos -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 13 4 7" />
      </svg>
      </template>
      Mis Productos
    </ResponsiveNavLink>
  </li>

  <li v-if="isAdminEmprendedor" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('emprendimiento.edit')" :active="route().current('emprendimiento.edit')">
      <template #icon>
        <!-- Editar emprendimiento -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-10-2l4 4 4-4m-4 4V4"/>
        </svg>
      </template>
      Editar Emprendimiento
    </ResponsiveNavLink>
  </li>

  <li v-if="isSuperAdmin" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('create-product')" :active="route().current('create-product')">
      <template #icon>
        <!-- Crear producto -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 13 4 7"/>
        </svg>
      </template>
      Crear Producto
    </ResponsiveNavLink>
  </li>

  <li v-if="isSuperAdmin" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('users.index')" :active="route().current('users.index')">
      <template #icon>
        <!-- Usuarios -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM15 21H3v-1a6 6 0 0112 0v1zM15 21h6v-1a6 6 0 00-9-5.197"/>
        </svg>
      </template>
      Users
    </ResponsiveNavLink>
  </li>

  <li v-if="isSuperAdmin" class="relative px-6 py-3">
    <ResponsiveNavLink :href="route('about')" :active="route().current('about')">
      <template #icon>
        <!-- Acerca de -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 5h16M4 13h6v6H4v-6zm12 0h4v6h-4v-6z"/>
        </svg>
      </template>
      About us
    </ResponsiveNavLink>
  </li>
</ul>

            </div>
        </aside>
    </transition>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

let showingTwoLevelMenu = ref(false)

const page = usePage()
const auth = computed(() => page.props.auth)

const isSuperAdmin = computed(() => auth.value?.user?.role?.name === 'SuperAdmin')
const isAdminEmprendedor = computed(() => auth.value?.user?.role?.name === 'AdminEmprendimientos')

</script>
