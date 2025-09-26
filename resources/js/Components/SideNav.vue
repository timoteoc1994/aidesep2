<template>
  <div v-show="visible" class="absolute right-4 md:right-8 top-[110px] bottom-10 flex flex-col justify-center items-center z-10">
    <div class="w-[3px] bg-white/50 grow-[3]"></div>

    <div class="flex flex-col items-center space-y-6 py-6">
      <div class="relative">
        <button class="group p-2 rounded-full bg-white/10 hover:bg-white/20 z-10 relative">
          <User class="w-6 h-6 text-white" />
          <div class="absolute right-12 top-1/2 transform -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-green-900/80 text-white text-xs px-4 py-2 rounded-lg w-64 shadow-lg pointer-events-none">
            Conoce más sobre los líderes indígenas detrás del proyecto.
          </div>
        </button>
      </div>

      <div class="relative">
        <button class="group p-2 rounded-full bg-white/10 hover:bg-white/20 z-10 relative">
          <MoreVertical class="w-6 h-6 text-white" />
          <div class="absolute right-12 top-1/2 transform -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-green-900/80 text-white text-xs px-4 py-2 rounded-lg w-64 shadow-lg pointer-events-none">
            Explora más opciones sobre nuestra iniciativa y colaboración global.
          </div>
        </button>
      </div>
    </div>

    <div class="w-[3px] bg-white/50 grow"></div>
  </div>
</template>

<script setup>
import { User, MoreVertical } from 'lucide-vue-next'
defineProps(['visible'])
</script>
