<template>
  <Head title="Editar Producto" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Producto</h2>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
              <!-- Emprendimiento -->
              <div class="form-group">
                <label class="block text-sm font-medium text-gray-700 mb-1">Emprendimiento</label>
                <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-200">
                  <div class="flex items-center">
                    <img v-if="producto.emprendimiento.imagen"
                         :src="`https://amazonfairtrade.org/storage/${producto.emprendimiento.imagen}`"
                         class="h-10 w-10 rounded-full object-cover mr-3"
                         :alt="producto.emprendimiento.titulo">
                    <div>
                      <p class="font-medium text-gray-900">{{ producto.emprendimiento.titulo }}</p>
                      <p class="text-sm text-gray-500">{{ producto.emprendimiento.descripcion_short }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Nombre -->
              <div class="form-group">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto</label>
                <input type="text" id="nombre" v-model="form.nombre"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                  :class="{ 'border-red-500': errors.nombre }" required />
                <p v-if="errors.nombre" class="text-red-500 text-xs mt-1">{{ errors.nombre }}</p>
              </div>

              <!-- Descripción -->
              <div class="form-group">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcion" v-model="form.descripcion" rows="4"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                  :class="{ 'border-red-500': errors.descripcion }" required></textarea>
                <p v-if="errors.descripcion" class="text-red-500 text-xs mt-1">{{ errors.descripcion }}</p>
              </div>

              <!-- Imagen -->
              <div class="form-group">
  <label class="block text-sm font-medium text-gray-700 mb-1">Imagen del Producto</label>

  <!-- Área de imagen actual o nueva -->
  <div class="mt-2">
    <div v-if="imagePreview || producto.imagen"
         class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePreview || `https://amazonfairtrade.org/storage/${producto.imagen}`"
             :alt="producto.nombre"
             class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>

      <!-- Controles de imagen -->
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span v-if="imageFile" class="truncate max-w-xs">{{ imageFile.name }}</span>
          <span v-else>Imagen actual del producto</span>
          <span v-if="imageFile" class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile.size) }}</span>
        </div>

        <div class="flex space-x-2">
          <label class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            {{ imagePreview ? 'Cambiar' : producto.imagen ? 'Cambiar' : 'Subir' }}
            <input id="imagen" type="file" class="hidden" accept="image/*" @change="handleImageUpload" />
          </label>
        </div>
      </div>
    </div>

    <!-- Área de carga cuando no hay imagen -->
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true"
      @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop"
      :class="{ 'bg-purple-50 border-purple-300': dragOver }">
      <input id="imagen" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
          fill="none" viewBox="0 0 48 48" aria-hidden="true">
          <path
            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex justify-center text-sm text-gray-600">
          <span class="text-purple-600">Sube una imagen</span>
          <span class="pl-1">o arrastra y suelta aquí</span>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 5MB</p>
      </div>
    </div>
  </div>

  <p v-if="errors.imagen" class="mt-2 text-sm text-red-600">{{ errors.imagen }}</p>
</div>


<!-- Imagen 2 -->
<!-- Imagen 2 -->
<div class="form-group mt-6">
  <label class="block text-sm font-medium text-gray-700 mb-1">Imagen Secundaria del Producto</label>

  <div class="mt-2">
    <div v-if="imagePreview2 || (producto.imagen_2 && !form.remove_imagen_2)"
         class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePreview2 || `https://amazonfairtrade.org/storage/${producto.imagen_2}`"
             :alt="producto.nombre"
             class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>

      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span v-if="imageFile2" class="truncate max-w-xs">{{ imageFile2.name }}</span>
          <span v-else>Imagen secundaria actual</span>
          <span v-if="imageFile2" class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile2.size) }}</span>
        </div>

        <div class="flex space-x-2">
          <!-- Botón Cambiar -->
          <label class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            {{ imagePreview2 ? 'Cambiar' : producto.imagen_2 ? 'Cambiar' : 'Subir' }}
            <input type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_2')" />
          </label>

          <!-- Botón Eliminar -->
          <button type="button" @click="removeImage('imagen_2')"
            class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>
        </div>
      </div>
    </div>

    <!-- Área drag-and-drop si no hay imagen -->
    <div v-else
         class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
         @dragover.prevent="dragOver = true"
         @dragleave.prevent="dragOver = false"
         @drop.prevent="handleDrop($event, 'imagen_2')"
         :class="{ 'bg-purple-50 border-purple-300': dragOver }">
      <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
             accept="image/*" @change="handleImageUpload($event, 'imagen_2')" />
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
             fill="none" viewBox="0 0 48 48" aria-hidden="true">
          <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex justify-center text-sm text-gray-600">
          <span class="text-purple-600">Sube una imagen</span>
          <span class="pl-1">o arrastra y suelta aquí</span>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 5MB</p>
      </div>
    </div>
  </div>

  <p v-if="errors.imagen_2" class="mt-2 text-sm text-red-600">{{ errors.imagen_2 }}</p>
</div>




<!-- Imagen 3 -->
<!-- Imagen 3 -->
<div class="form-group mt-6">
  <label class="block text-sm font-medium text-gray-700 mb-1">Imagen 3 del Producto</label>

  <div class="mt-2">
    <div v-if="imagePreview3 || (producto.imagen_3 && !form.remove_imagen_3)"
         class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePreview3 || `https://amazonfairtrade.org/storage/${producto.imagen_3}`"
             :alt="producto.nombre"
             class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>

      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span v-if="imageFile3" class="truncate max-w-xs">{{ imageFile3.name }}</span>
          <span v-else>Imagen 3 actual</span>
          <span v-if="imageFile3" class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile3.size) }}</span>
        </div>

        <div class="flex space-x-2">
          <!-- Botón Cambiar -->
          <label class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            {{ imagePreview3 ? 'Cambiar' : producto.imagen_3 ? 'Cambiar' : 'Subir' }}
            <input type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_3')" />
          </label>

          <!-- Botón Eliminar -->
          <button type="button" @click="removeImage('imagen_3')"
            class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>
        </div>
      </div>
    </div>

    <!-- Área drag-and-drop si no hay imagen -->
    <div v-else
         class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
         @dragover.prevent="dragOver = true"
         @dragleave.prevent="dragOver = false"
         @drop.prevent="handleDrop($event, 'imagen_3')"
         :class="{ 'bg-purple-50 border-purple-300': dragOver }">
      <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
             accept="image/*" @change="handleImageUpload($event, 'imagen_3')" />
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
             fill="none" viewBox="0 0 48 48" aria-hidden="true">
          <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex justify-center text-sm text-gray-600">
          <span class="text-purple-600">Sube una imagen</span>
          <span class="pl-1">o arrastra y suelta aquí</span>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 5MB</p>
      </div>
    </div>
  </div>

  <p v-if="errors.imagen_3" class="mt-2 text-sm text-red-600">{{ errors.imagen_3 }}</p>
</div>


<!-- Imagen 4 -->
<!-- Imagen 4 -->
<div class="form-group mt-6">
  <label class="block text-sm font-medium text-gray-700 mb-1">Imagen 4 del Producto</label>

  <div class="mt-2">
    <div v-if="imagePreview4 || (producto.imagen_4 && !form.remove_imagen_4)"
         class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePreview4 || `https://amazonfairtrade.org/storage/${producto.imagen_4}`"
             :alt="producto.nombre"
             class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>

      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span v-if="imageFile4" class="truncate max-w-xs">{{ imageFile4.name }}</span>
          <span v-else>Imagen 4 actual</span>
          <span v-if="imageFile4" class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile4.size) }}</span>
        </div>

        <div class="flex space-x-2">
          <!-- Botón Cambiar -->
          <label class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            {{ imagePreview4 ? 'Cambiar' : producto.imagen_4 ? 'Cambiar' : 'Subir' }}
            <input type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_4')" />
          </label>

          <!-- Botón Eliminar -->
          <button type="button" @click="removeImage('imagen_4')"
            class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>
        </div>
      </div>
    </div>

    <!-- Área drag-and-drop si no hay imagen -->
    <div v-else
         class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
         @dragover.prevent="dragOver = true"
         @dragleave.prevent="dragOver = false"
         @drop.prevent="handleDrop($event, 'imagen_4')"
         :class="{ 'bg-purple-50 border-purple-300': dragOver }">
      <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
             accept="image/*" @change="handleImageUpload($event, 'imagen_4')" />
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
             fill="none" viewBox="0 0 48 48" aria-hidden="true">
          <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex justify-center text-sm text-gray-600">
          <span class="text-purple-600">Sube una imagen</span>
          <span class="pl-1">o arrastra y suelta aquí</span>
        </div>
        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 5MB</p>
      </div>
    </div>
  </div>

  <p v-if="errors.imagen_4" class="mt-2 text-sm text-red-600">{{ errors.imagen_4 }}</p>
</div>




              <!-- Etiquetas Presentación -->
<div class="form-group">
  <label for="etiquetas_presentacion" class="block text-sm font-medium text-gray-700 mb-1">
    Presentaciones Disponibles
  </label>
  <div class="mt-1">
    <div class="flex flex-wrap gap-2 mb-2">
      <span v-for="(tag, index) in tagsPresentation" :key="index"
        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800">
        {{ tag }}
        <button type="button" @click="removeTagPresentation(index)"
          class="ml-1.5 text-purple-600 hover:text-purple-900">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </span>
    </div>
    <div class="flex">
      <input type="text" id="presentationTag" v-model="currentPresentationTag"
        placeholder="Ej: 250ml"
        @keydown.enter.prevent="addTagPresentation"
        class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
      <button type="button" @click="addTagPresentation"
        class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
        Agregar
      </button>
    </div>
  </div>
</div>

<!-- Etiquetas Calidad -->
<div class="form-group">
  <label for="etiquetas_calidad" class="block text-sm font-medium text-gray-700 mb-1">
    Cualidades (Natural, Orgánico...)
  </label>
  <div class="mt-1">
    <div class="flex flex-wrap gap-2 mb-2">
      <span v-for="(tag, index) in tagsQuality" :key="index"
        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">
        {{ tag }}
        <button type="button" @click="removeTagQuality(index)"
          class="ml-1.5 text-green-600 hover:text-green-900">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </span>
    </div>
    <div class="flex">
      <input type="text" id="qualityTag" v-model="currentQualityTag"
        placeholder="Ej: 100% natural"
        @keydown.enter.prevent="addTagQuality"
        class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
      <button type="button" @click="addTagQuality"
        class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
        Agregar
      </button>
    </div>
  </div>
</div>

<!-- Beneficios -->
<div class="form-group">
  <label for="beneficios" class="block text-sm font-medium text-gray-700 mb-1">Beneficios</label>
  <textarea id="beneficios" v-model="form.beneficios" rows="4"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
    :class="{ 'border-red-500': errors.beneficios }"></textarea>
</div>

<!-- Modo de uso -->
<div class="form-group">
  <label for="modo_uso" class="block text-sm font-medium text-gray-700 mb-1">Modo de uso</label>
  <textarea id="modo_uso" v-model="form.modo_uso" rows="4"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
    :class="{ 'border-red-500': errors.modo_uso }"></textarea>
</div>

<!-- Origen -->
<div class="form-group">
  <label for="origen" class="block text-sm font-medium text-gray-700 mb-1">Origen</label>
  <input id="origen" v-model="form.origen"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
    placeholder="Ej: Hecho en Ecuador" />
</div>

              <!-- Botones de acción -->
              <div class="flex justify-end space-x-3 pt-4">
                <Link :href="`/producto/${producto.slug}`" as="button"
                  class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                  Cancelar
                </Link>
                <button type="submit"
                  class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                  :disabled="form.processing">
                  <div v-if="form.processing" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                      </path>
                    </svg>
                    Guardando...
                  </div>
                  <span v-else>Guardar Cambios</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';

const props = defineProps({
  producto: Object,
  emprendimiento: Object,
});

// Formulario
const form = useForm({
  nombre: props.producto.nombre,
  descripcion: props.producto.descripcion,
  imagen: null,
  imagen_2: null,
  imagen_3: null,
  imagen_4: null,
  remove_image: false,
  remove_imagen_2: false,
  remove_imagen_3: false,
  remove_imagen_4: false,
  etiquetas_presentacion: props.producto.etiquetas_presentacion,
  etiquetas_calidad: props.producto.etiquetas_calidad,
  beneficios: props.producto.beneficios,
  modo_uso: props.producto.modo_uso,
  origen: props.producto.origen,
});

// Vista previa y control de imágenes
const imagePreview = ref(null);
const imagePreview2 = ref(null);
const imagePreview3 = ref(null);
const imagePreview4 = ref(null);

const imageFile = ref(null);
const imageFile2 = ref(null);
const imageFile3 = ref(null);
const imageFile4 = ref(null);

const dragOver = ref(false);
const errors = ref({});

// Etiquetas Presentación
const tagsPresentation = ref([]);
try {
  const parsed = JSON.parse(form.etiquetas_presentacion);
  if (Array.isArray(parsed)) {
    tagsPresentation.value = parsed;
  }
} catch (e) {
  tagsPresentation.value = form.etiquetas_presentacion.split(',').map(t => t.trim());
}
const currentPresentationTag = ref('');

const addTagPresentation = () => {
  if (currentPresentationTag.value.trim()) {
    tagsPresentation.value.push(currentPresentationTag.value.trim());
    form.etiquetas_presentacion = JSON.stringify(tagsPresentation.value);
    currentPresentationTag.value = '';
  }
};

const removeTagPresentation = (index) => {
  tagsPresentation.value.splice(index, 1);
  form.etiquetas_presentacion = JSON.stringify(tagsPresentation.value);
};

// Etiquetas Calidad
const tagsQuality = ref([]);
try {
  const parsed = JSON.parse(form.etiquetas_calidad);
  if (Array.isArray(parsed)) {
    tagsQuality.value = parsed;
  }
} catch (e) {
  tagsQuality.value = form.etiquetas_calidad.split(',').map(t => t.trim());
}
const currentQualityTag = ref('');

const addTagQuality = () => {
  if (currentQualityTag.value.trim()) {
    tagsQuality.value.push(currentQualityTag.value.trim());
    form.etiquetas_calidad = JSON.stringify(tagsQuality.value);
    currentQualityTag.value = '';
  }
};

const removeTagQuality = (index) => {
  tagsQuality.value.splice(index, 1);
  form.etiquetas_calidad = JSON.stringify(tagsQuality.value);
};

// Precargar imágenes si existen
onMounted(() => {
  if (props.producto.imagen) imagePreview.value = `https://amazonfairtrade.org/storage/${props.producto.imagen}`;
  if (props.producto.imagen_2) imagePreview2.value = `https://amazonfairtrade.org/storage/${props.producto.imagen_2}`;
  if (props.producto.imagen_3) imagePreview3.value = `https://amazonfairtrade.org/storage/${props.producto.imagen_3}`;
  if (props.producto.imagen_4) imagePreview4.value = `https://amazonfairtrade.org/storage/${props.producto.imagen_4}`;
});

// Subida de imágenes genérica
const allowedTypes = [
  'image/jpeg',
  'image/png',
  'image/jpg',
  'image/gif',
  'image/webp',
];

const handleImageUpload = (event, imageType = 'imagen') => {
  const file = event.target.files[0];
  if (!file) return;

  // ⚠️ Verificar tipo MIME
  if (!allowedTypes.includes(file.type)) {
    Swal.fire({
      title: 'Tipo de imagen no permitido',
      text: 'No se permiten imágenes AVIF. Usa JPG, PNG, GIF o WEBP.',
      icon: 'error',
      confirmButtonText: 'Entendido',
      confirmButtonColor: '#9333EA'
    });
    return;
  }

  if (file.size > 5 * 1024 * 1024) {
    Swal.fire({
      title: 'Imagen demasiado grande',
      text: 'El tamaño máximo permitido es 5MB.',
      icon: 'error',
      confirmButtonText: 'Entendido',
      confirmButtonColor: '#9333EA'
    });
    return;
  }

  form[imageType] = file;

  const reader = new FileReader();
  reader.onload = (e) => {
    if (imageType === 'imagen') imagePreview.value = e.target.result;
    if (imageType === 'imagen_2') imagePreview2.value = e.target.result;
    if (imageType === 'imagen_3') imagePreview3.value = e.target.result;
    if (imageType === 'imagen_4') imagePreview4.value = e.target.result;
  };
  reader.readAsDataURL(file);

  switch (imageType) {
    case 'imagen':
      form.remove_image = false;
      imageFile.value = file;
      break;
    case 'imagen_2':
      form.remove_imagen_2 = false;
      imageFile2.value = file;
      break;
    case 'imagen_3':
      form.remove_imagen_3 = false;
      imageFile3.value = file;
      break;
    case 'imagen_4':
      form.remove_imagen_4 = false;
      imageFile4.value = file;
      break;
  }
};



// Drag & Drop genérico
const handleDrop = (event, imageType = 'imagen') => {
  dragOver.value = false;
  const file = event.dataTransfer.files[0];
  if (file && file.type.match('image.*')) {
    const dummyEvent = { target: { files: [file] } };
    handleImageUpload(dummyEvent, imageType);
  } else {
    showErrorAlert('Tipo de archivo no válido', 'Por favor, suba solo imágenes (JPG, PNG, GIF).');
  }
};

const removeImage = (imageType) => {
  console.log('[removeImage] Se solicitó eliminar:', imageType);

  Swal.fire({
    title: '¿Eliminar imagen?',
    text: 'Esta acción no se puede deshacer',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#9333EA',
    cancelButtonColor: '#6B7280',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (!result.isConfirmed) {
      console.log('[removeImage] Cancelado por el usuario');
      return;
    }

    switch (imageType) {
      case 'imagen':
        console.log('[removeImage] Eliminando imagen principal');
        form.remove_image = true;
        form.imagen = null;
        imagePreview.value = null;
        imageFile.value = null;
        break;

      case 'imagen_2':
        console.log('[removeImage] Eliminando imagen_2');
        form.remove_imagen_2 = true;
        form.imagen_2 = null;
        imagePreview2.value = null;
        imageFile2.value = null;
        break;

      case 'imagen_3':
        console.log('[removeImage] Eliminando imagen_3');
        form.remove_imagen_3 = true;
        form.imagen_3 = null;
        imagePreview3.value = null;
        imageFile3.value = null;
        break;

      case 'imagen_4':
        console.log('[removeImage] Eliminando imagen_4');
        form.remove_imagen_4 = true;
        form.imagen_4 = null;
        imagePreview4.value = null;
        imageFile4.value = null;
        break;

      default:
        console.warn('[removeImage] Tipo de imagen no reconocido:', imageType);
    }

    console.log('[removeImage] Estado actual del formulario:', {
      remove_image: form.remove_image,
      remove_imagen_2: form.remove_imagen_2,
      remove_imagen_3: form.remove_imagen_3,
      remove_imagen_4: form.remove_imagen_4
    });
  });
};





// Formato de tamaño
const formatFileSize = (bytes) => {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2) + ' ' + sizes[i]);
};

// Envío
const submitForm = () => {
  form.transform((data) => {
    const cleaned = {
      ...data,
      _method: 'PUT'
    };

    if (cleaned.remove_image) delete cleaned.imagen;
    if (cleaned.remove_imagen_2) delete cleaned.imagen_2;
    if (cleaned.remove_imagen_3) delete cleaned.imagen_3;
    if (cleaned.remove_imagen_4) delete cleaned.imagen_4;

    return cleaned;
  }).post(`/editar-producto/${props.producto.slug}`, {
    forceFormData: true,
    onSuccess: (page) => {
      const nuevoSlug = page.props?.slug ?? props.producto.slug;
      if (nuevoSlug !== props.producto.slug) {
        window.history.replaceState(null, '', `/editar-producto/${nuevoSlug}`);
      }

      Swal.fire({
        title: '¡Producto actualizado!',
        text: 'Los cambios se han guardado correctamente',
        icon: 'success',
        confirmButtonText: 'Continuar',
        confirmButtonColor: '#9333EA'
      });
    },
    onError: (errors) => {
      console.error('[submitForm] Errores recibidos:', errors);

      // Si hay error de imagen específica
      if (errors.imagen || errors.imagen_2 || errors.imagen_3 || errors.imagen_4) {
        const errores = [
          errors.imagen,
          errors.imagen_2,
          errors.imagen_3,
          errors.imagen_4,
        ].filter(Boolean); // Eliminar undefined

        Swal.fire({
          icon: 'error',
          title: 'Error en la imagen',
          html: errores.map(e => `<p>${e}</p>`).join(''),
          confirmButtonColor: '#9333EA'
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error al actualizar',
          text: 'Verifica los campos o revisa la consola para más detalles.',
          confirmButtonColor: '#9333EA'
        });
      }
    },
    onFinish: () => {
      console.log('[submitForm] Envío finalizado');
    },
    onException: (exception) => {
      console.error('[submitForm] Error inesperado en excepción:', exception);
      Swal.fire({
        icon: 'error',
        title: 'Error inesperado',
        text: 'Se produjo un problema inesperado. Revisa la consola.',
        confirmButtonColor: '#9333EA'
      });
    }
  });
};


// Error general
const showErrorAlert = (title, message = '') => {
  Swal.fire({
    title: title,
    text: message,
    icon: 'error',
    confirmButtonText: 'Entendido',
    confirmButtonColor: '#9333EA'
  });
};
</script>


<style>
.form-group {
  margin-bottom: 1.5rem;
}
</style>
