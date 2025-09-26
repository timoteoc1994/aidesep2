<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const codigo = page.props.codigo
</script>

<template>
  <div class="p-8 text-white bg-emerald-800 min-h-screen">
    <h1 class="text-4xl font-bold mb-4">País seleccionado: {{ codigo }}</h1>
    <p class="text-lg">Aquí podrías mostrar más datos de {{ codigo }} según tu base de datos o config local.</p>
  </div>
</template>
