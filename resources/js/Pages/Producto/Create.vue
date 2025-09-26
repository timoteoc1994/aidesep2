<template>
  <AdminLayout>
    <CrearProducto :emprendimientos="emprendimientos" />
  </AdminLayout>
</template>

<script setup>
import CrearProducto from '@/Components/CrearProducto.vue'
import { defineProps } from 'vue'

const props = defineProps({
  emprendimientos: Array,
})
</script>
