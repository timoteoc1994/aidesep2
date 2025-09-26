<template>
  <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
    <div class="py-4 text-gray-500">
      <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
        AIDESEP
      </Link>

      <ul class="mt-6">
        <li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                   stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
            </template>
            Dashboard
          </NavLink>
        </li>

<li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
  <NavLink :href="route('noticias.listado')" :active="route().current('noticias.listado')">
    <template #icon>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h11l5 5v9a2 2 0 01-2 2z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 13h-6m6 4h-6m-2-4H7m0 4h2" />
      </svg>
    </template>
    Noticias
  </NavLink>
</li>

        <li v-if="auth?.user?.role?.name === 'AdminEmprendimientos'" class="relative px-6 py-3">
          <NavLink :href="route('mis-productos')" :active="route().current('mis-productos')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                   stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
            </template>
            Mis Productos
          </NavLink>
        </li>


          <li v-if="auth?.user?.role?.name === 'AdminEmprendimientos'" class="relative px-6 py-3">
    <NavLink :href="route('emprendimiento.edit')" :active="route().current('emprendimiento.edit')">
      <template #icon>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-10-2l4 4m0 0l4-4m-4 4V4"></path>
        </svg>
      </template>
      Editar Emprendimiento
    </NavLink>
  </li>


<li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
  <NavLink :href="route('emprendimientos.listado')" :active="route().current('emprendimientos.listado')">
    <template #icon>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 17l6-6 4 4 8-8M13 7h8v8" />
      </svg>
    </template>
    Emprendimientos
  </NavLink>
</li>


<!-- Comentado el crear emprendimiento
        <li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
          <NavLink :href="route('create')" :active="route().current('create')">
            <template #icon>
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                   stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
            </template>
            Crear Emprendimiento
          </NavLink>
        </li>
-->

<li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
  <NavLink :href="route('create-product')" :active="route().current('create-product')">
    <template #icon>
      <!-- Ícono de caja para representar producto -->
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m16 0L12 13 4 7" />
      </svg>
    </template>
    Crear Producto
  </NavLink>
</li>



        <li v-if="auth?.user?.role?.name === 'SuperAdmin'" class="relative px-6 py-3">
          <NavLink :href="route('users.index')" :active="route().current('users.index')">
            <template #icon>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                   xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
            </template>
            Users
          </NavLink>
        </li>

       

        
      </ul>
    </div>
  </aside>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

// ✅ Obtener auth desde la página compartida globalmente
const page = usePage()
const auth = computed(() => page.props.auth)

console.log('🔍 Usuario autenticado:', auth.value?.user)
console.log('🔍 Rol del usuario:', auth.value?.user?.role)

const showingTwoLevelMenu = ref(false)
</script>


