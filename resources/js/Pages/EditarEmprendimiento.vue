<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">Editar Emprendimiento</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
                        <!-- Título -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" id="titulo" v-model="form.titulo"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                required />
                            <div v-if="form.errors.titulo" class="text-red-500 text-sm mt-1">
                                {{ form.errors.titulo }}
                            </div>
                        </div>


                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" v-model="form.slug" class="mt-1 block w-full border rounded" disabled />
                        </div>

                        <!-- Descripción -->
                       <div>
  <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
  <textarea
    id="descripcion"
    v-model="form.descripcion"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    rows="4"
    required
  ></textarea>
  <div v-if="form.errors.descripcion" class="text-red-500 text-sm mt-1">
    {{ form.errors.descripcion }}
  </div>
</div>


                        <!-- Imagen Principal -->
                        <div>
  <label for="imagen_principal" class="block text-sm font-medium text-gray-700">Imagen Principal</label>
  <div class="mt-2">
    <div v-if="imagePrincipalPreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imagePrincipalPreview" alt="Vista previa Imagen Principal"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_principal"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_principal" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, 'principal')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'principal')">
      <input id="imagen_principal" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'principal')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 48 48" stroke="currentColor">
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
</div>

<!-- Imagen Logo -->
<div>
  <label for="imagen_logo" class="block text-sm font-medium text-gray-700">Imagen Logo</label>
  <div class="mt-2">
    <div v-if="imageLogoPreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imageLogoPreview" alt="Vista previa Imagen Logo"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_logo"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_logo" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, 'logo')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'logo')">
      <input id="imagen_logo" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'logo')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 48 48" stroke="currentColor">
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
</div>

<!-- Imagen Logo con Nombre -->
<div>
  <label for="imagen_logo_con_nombre" class="block text-sm font-medium text-gray-700">Imagen Logo con Nombre</label>
  <div class="mt-2">
    <div v-if="imageLogoConNombrePreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imageLogoConNombrePreview" alt="Vista previa Imagen Logo con Nombre"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_logo_con_nombre"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_logo_con_nombre" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, 'logoConNombre')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'logoConNombre')">
      <input id="imagen_logo_con_nombre" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'logoConNombre')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
          viewBox="0 0 48 48" stroke="currentColor">
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
</div>

<!-- Imagen Secundaria -->
<div>
  <label for="imagen_secundaria" class="block text-sm font-medium text-gray-700">Imagen Secundaria</label>
  <div class="mt-2">
    <div v-if="imageSecundariaPreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="imageSecundariaPreview" alt="Vista previa Imagen Secundaria"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_secundaria"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_secundaria" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, 'secundaria')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'secundaria')">
      <input id="imagen_secundaria" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'secundaria')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
          viewBox="0 0 48 48" stroke="currentColor">
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
</div>


<!-- Etiquetas 1 -->
<div>
  <label for="etiquetas_1" class="block text-sm font-medium text-gray-700">Etiquetas 1</label>
  <div class="mt-1">
    <div class="flex flex-wrap gap-2 mb-2">
      <span
        v-for="(tag, index) in tagsEtiquetas1"
        :key="index"
        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800"
      >
        {{ tag }}
        <button
          type="button"
          @click="removeTagEtiquetas1(index)"
          class="ml-1.5 text-purple-600 hover:text-purple-900"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </span>
    </div>
    <div class="flex">
      <input
        type="text"
        id="etiquetas1Tag"
        v-model="currentTagEtiquetas1"
        placeholder="Ej: 200gr"
        @keydown.enter.prevent="addTagEtiquetas1"
        class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
      />
      <button
        type="button"
        @click="addTagEtiquetas1"
        class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
      >
        Agregar
      </button>
    </div>
  </div>
  <p v-if="form.errors.etiquetas_1" class="text-red-500 text-xs mt-1">{{ form.errors.etiquetas_1 }}</p>
</div>

<!-- Etiquetas 2 -->
<div>
  <label for="etiquetas_2" class="block text-sm font-medium text-gray-700">Etiquetas 2</label>
  <div class="mt-1">
    <div class="flex flex-wrap gap-2 mb-2">
      <span
        v-for="(tag, index) in tagsEtiquetas2"
        :key="index"
        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800"
      >
        {{ tag }}
        <button
          type="button"
          @click="removeTagEtiquetas2(index)"
          class="ml-1.5 text-purple-600 hover:text-purple-900"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </span>
    </div>
    <div class="flex">
      <input
        type="text"
        id="etiquetas2Tag"
        v-model="currentTagEtiquetas2"
        placeholder="Ej: Orgánico"
        @keydown.enter.prevent="addTagEtiquetas2"
        class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
      />
      <button
        type="button"
        @click="addTagEtiquetas2"
        class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
      >
        Agregar
      </button>
    </div>
  </div>
  <p v-if="form.errors.etiquetas_2" class="text-red-500 text-xs mt-1">{{ form.errors.etiquetas_2 }}</p>
</div>


<!-- Sección para los datos de "Nosotros" -->

<!-- Título 1 (Nosotros) -->
<div>
  <label for="titulo_1_nosotros" class="block text-sm font-medium text-gray-700">
    Título 1 (Nosotros)
  </label>
  <input
    type="text"
    id="titulo_1_nosotros"
    v-model="form.titulo_1_nosotros"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.titulo_1_nosotros" class="text-red-500 text-sm mt-1">
    {{ form.errors.titulo_1_nosotros }}
  </div>
</div>


<!-- Imagen 1 (Nosotros) -->
<div>
  <label for="imagen_1_nosotros" class="block text-sm font-medium text-gray-700">Imagen 1 (Nosotros)</label>
  <div class="mt-2">
    <div v-if="image1NosotrosPreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="image1NosotrosPreview" alt="Vista previa Imagen 1 (Nosotros)"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_1_nosotros"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_1_nosotros" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, '1_nosotros')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, '1_nosotros')">
      <input id="imagen_1_nosotros" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, '1_nosotros')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
          viewBox="0 0 48 48" stroke="currentColor">
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
</div>

                        <!-- Nosotros 1 tiny -->
                                                        <div>
                                <label for="texto_1_nosotros" class="block text-sm font-medium text-gray-700">Texto 1
                                    (Nosotros)</label>
                                <Editor v-model="form.texto_1_nosotros" id="texto_1_nosotros"
                                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
                                <div v-if="form.errors.texto_1_nosotros" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.texto_1_nosotros }}
                                </div>
                            </div>

                            <!-- Título 2 (Nosotros) -->
<div>
  <label for="titulo_2_nosotros" class="block text-sm font-medium text-gray-700">
    Título 2 (Nosotros)
  </label>
  <input
    type="text"
    id="titulo_2_nosotros"
    v-model="form.titulo_2_nosotros"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
  />
  <div v-if="form.errors.titulo_2_nosotros" class="text-red-500 text-sm mt-1">
    {{ form.errors.titulo_2_nosotros }}
  </div>
</div>

<!-- Imagen 2 (Nosotros) -->
<div>
  <label for="imagen_2_nosotros" class="block text-sm font-medium text-gray-700">Imagen 2 (Nosotros)</label>
  <div class="mt-2">
    <div v-if="image2NosotrosPreview"
      class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
      <div class="flex items-center justify-center">
        <img :src="image2NosotrosPreview" alt="Vista previa Imagen 2 (Nosotros)"
          class="h-52 max-h-52 w-auto object-contain rounded-md" />
      </div>
      <div class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
        <label for="imagen_2_nosotros"
          class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
          </svg>
          Cambiar
        </label>
        <input id="imagen_2_nosotros" type="file" class="hidden" accept="image/*"
          @change="handleImageUpload($event, '2_nosotros')" />
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, '2_nosotros')">
      <input id="imagen_2_nosotros" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, '2_nosotros')">
      <div class="space-y-2 text-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
          viewBox="0 0 48 48" stroke="currentColor">
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
</div>

<!-- Texto 2 (Nosotros) -->
<div>
  <label for="texto_2_nosotros" class="block text-sm font-medium text-gray-700">Texto 2 (Nosotros)</label>
  <div class="mt-2">
    <Editor
      v-model="form.texto_2_nosotros"
      id="texto_2_nosotros"
      api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi"
      :init="editorConfig"
    />
    <div v-if="form.errors.texto_2_nosotros" class="text-red-500 text-sm mt-1">
      {{ form.errors.texto_2_nosotros }}
    </div>
  </div>
</div>

<!-- Título de la Misión -->
<div>
  <label for="titulo_mision" class="block text-sm font-medium text-gray-700">Título de la Misión</label>
  <input
    type="text"
    id="titulo_mision"
    v-model="form.titulo_mision"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.titulo_mision" class="text-red-500 text-sm mt-1">
    {{ form.errors.titulo_mision }}
  </div>
</div>

<!-- Texto de la Misión -->
<div>
  <label for="texto_mision" class="block text-sm font-medium text-gray-700">Texto de la Misión</label>
  <Editor
    v-model="form.texto_mision"
    id="texto_mision"
    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi"
    :init="editorConfig"
  />
  <div v-if="form.errors.texto_mision" class="text-red-500 text-sm mt-1">
    {{ form.errors.texto_mision }}
  </div>
</div>

<!-- Sección para el Mapa -->
<div>
  <label for="titulo_mapa" class="block text-sm font-medium text-gray-700">Título del Mapa</label>
  <input
    type="text"
    id="titulo_mapa"
    v-model="form.titulo_mapa"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.titulo_mapa" class="text-red-500 text-sm mt-1">
    {{ form.errors.titulo_mapa }}
  </div>
</div>

<div class="mt-4">
  <label for="texto_mapa" class="block text-sm font-medium text-gray-700">Texto del Mapa</label>
  <textarea
    id="texto_mapa"
    v-model="form.texto_mapa"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    rows="4"
  ></textarea>
  <div v-if="form.errors.texto_mapa" class="text-red-500 text-sm mt-1">
    {{ form.errors.texto_mapa }}
  </div>
</div>

<div class="mt-4">
  <label for="ubicacion_google_maps" class="block text-sm font-medium text-gray-700">Ubicación en Google Maps</label>
  <input
    type="text"
    id="ubicacion_google_maps"
    v-model="form.ubicacion_google_maps"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="Ejemplo: -1.5857772, -77.7436251"
    required
  />
  <div v-if="form.errors.ubicacion_google_maps" class="text-red-500 text-sm mt-1">
    {{ form.errors.ubicacion_google_maps }}
  </div>
</div>

<!-- Sección de Contacto -->
<div>
  <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
  <input
    type="text"
    id="telefono"
    v-model="form.telefono"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">
    {{ form.errors.telefono }}
  </div>
</div>

<div class="mt-4">
  <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
  <input
    type="text"
    id="celular"
    v-model="form.celular"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.celular" class="text-red-500 text-sm mt-1">
    {{ form.errors.celular }}
  </div>
</div>

<div class="mt-4">
  <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
  <input
    type="text"
    id="ubicacion"
    v-model="form.ubicacion"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.ubicacion" class="text-red-500 text-sm mt-1">
    {{ form.errors.ubicacion }}
  </div>
</div>

<div class="mt-4">
  <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
  <input
    type="text"
    id="direccion"
    v-model="form.direccion"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
  />
  <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">
    {{ form.errors.direccion }}
  </div>
</div>

<!-- Redes Sociales -->
<div>
  <label for="facebook_url" class="block text-sm font-medium text-gray-700">Facebook URL</label>
  <input
    type="text"
    id="facebook_url"
    v-model="form.facebook_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://facebook.com/tu-pagina"
  />
  <div v-if="form.errors.facebook_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.facebook_url }}
  </div>
</div>

<div class="mt-4">
  <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram URL</label>
  <input
    type="text"
    id="instagram_url"
    v-model="form.instagram_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://instagram.com/tu-cuenta"
  />
  <div v-if="form.errors.instagram_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.instagram_url }}
  </div>
</div>

<div class="mt-4">
  <label for="linkedin_url" class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
  <input
    type="text"
    id="linkedin_url"
    v-model="form.linkedin_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://linkedin.com/in/tu-perfil"
  />
  <div v-if="form.errors.linkedin_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.linkedin_url }}
  </div>
</div>

<div class="mt-4">
  <label for="web_url" class="block text-sm font-medium text-gray-700">Sitio Web</label>
  <input
    type="text"
    id="web_url"
    v-model="form.web_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://tusitioweb.com"
  />
  <div v-if="form.errors.web_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.web_url }}
  </div>
</div>

<!-- Nuevos campos para YouTube y TikTok -->
<div class="mt-4">
  <label for="youtube_url" class="block text-sm font-medium text-gray-700">YouTube URL</label>
  <input
    type="text"
    id="youtube_url"
    v-model="form.youtube_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://youtube.com/tu-canal"
  />
  <div v-if="form.errors.youtube_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.youtube_url }}
  </div>
</div>

<div class="mt-4">
  <label for="tiktok_url" class="block text-sm font-medium text-gray-700">TikTok URL</label>
  <input
    type="text"
    id="tiktok_url"
    v-model="form.tiktok_url"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    placeholder="https://tiktok.com/@tu-cuenta"
  />
  <div v-if="form.errors.tiktok_url" class="text-red-500 text-sm mt-1">
    {{ form.errors.tiktok_url }}
  </div>
</div>

<!-- Sección para los Colores -->
<div>
  <!-- Color Principal 1 -->
  <label for="color_principal_1" class="block text-sm font-medium text-gray-700">Color Principal 1</label>
  <div class="relative mt-1">
    <div class="flex items-center">
      <!-- Vista previa del color -->
      <div class="h-10 w-10 rounded-l-md border border-gray-300 shadow-sm"
           :style="{ backgroundColor: form.color_principal_1 }"></div>

      <!-- Selector de color oculto con visual -->
      <div class="flex-1 relative">
        <input type="color" id="color_principal_1" v-model="form.color_principal_1"
               class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />
        <div
          class="flex items-center h-10 px-3 border border-l-0 border-gray-300 rounded-r-md shadow-sm bg-white">
          <span class="flex-1 text-gray-700 font-mono text-sm">{{ form.color_principal_1 }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
               :style="{ fill: form.color_principal_1 }">
            <path
              d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
          </svg>
        </div>
      </div>
    </div>
  </div>
  <div v-if="form.errors.color_principal_1" class="text-red-500 text-sm mt-1">
    {{ form.errors.color_principal_1 }}
  </div>
</div>

<div class="mt-4">
  <!-- Color Secundario 1 -->
  <label for="color_secundario_1" class="block text-sm font-medium text-gray-700">Color Secundario 1</label>
  <div class="relative mt-1">
    <div class="flex items-center">
      <div class="h-10 w-10 rounded-l-md border border-gray-300 shadow-sm"
           :style="{ backgroundColor: form.color_secundario_1 }"></div>

      <div class="flex-1 relative">
        <input type="color" id="color_secundario_1" v-model="form.color_secundario_1"
               class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />
        <div
          class="flex items-center h-10 px-3 border border-l-0 border-gray-300 rounded-r-md shadow-sm bg-white">
          <span class="flex-1 text-gray-700 font-mono text-sm">{{ form.color_secundario_1 }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
               :style="{ fill: form.color_secundario_1 }">
            <path
              d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
          </svg>
        </div>
      </div>
    </div>
  </div>
  <div v-if="form.errors.color_secundario_1" class="text-red-500 text-sm mt-1">
    {{ form.errors.color_secundario_1 }}
  </div>
</div>

<!-- Categoría -->
<div>
  <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
  <select id="categoria_id" v-model="form.categoria_id"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-700"
          required>
    <option disabled value="">Seleccione una categoría</option>
    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
      {{ categoria.nombre }}
    </option>
  </select>
  <div v-if="form.errors.categoria_id" class="text-red-500 text-sm mt-1">
    {{ form.errors.categoria_id }}
  </div>
</div>

<!-- Categoría -->
<div>
  <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
  <select id="categoria_id" v-model="form.categoria_id"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    required>
    <option value="" disabled>Seleccione una categoría</option>
    <option v-for="categoria in props.categorias" :key="categoria.id" :value="categoria.id">
      {{ categoria.nombre }}
    </option>
  </select>
  <div v-if="form.errors.categoria_id" class="text-red-500 text-sm mt-1">{{ form.errors.categoria_id }}</div>
</div>

<!-- País -->
<div>
  <label for="pais_id" class="block text-sm font-medium text-gray-700">País</label>
  <select id="pais_id" v-model="form.pais_id" @change="fetchProvincias"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    required>
    <option value="" disabled>Seleccione un país</option>
    <option v-for="pais in props.paises" :key="pais.id" :value="pais.id">
      {{ pais.nombre }}
    </option>
  </select>
  <div v-if="form.errors.pais_id" class="text-red-500 text-sm mt-1">{{ form.errors.pais_id }}</div>
</div>

<!-- Provincia -->
<div>
  <label for="provincia_id" class="block text-sm font-medium text-gray-700">Provincia</label>
  <select id="provincia_id" v-model="form.provincia_id"
    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
    required :disabled="!form.pais_id">
    <option value="" disabled>
      {{ form.pais_id ? 'Seleccione una provincia' : 'Seleccione primero un país' }}
    </option>
    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">
      {{ provincia.nombre }}
    </option>
  </select>
  <div v-if="form.errors.provincia_id" class="text-red-500 text-sm mt-1">{{ form.errors.provincia_id }}</div>
</div>

<!-- Enviar formulario -->
<div class="mt-6">
  <button
    type="submit"
    class="w-full flex justify-center items-center gap-2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
    :disabled="form.processing"
  >
    <svg
      v-if="form.processing"
      class="animate-spin h-5 w-5 text-white"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
    >
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path
        class="opacity-75"
        fill="currentColor"
        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"
      ></path>
    </svg>
    {{ form.processing ? 'Guardando...' : 'Guardar Cambios' }}
  </button>
</div>


                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Editor from '@tinymce/tinymce-vue'
import axios from 'axios';
import Swal from 'sweetalert2'

const editorConfig = {
    height: 300,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
        'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount',  // 👈 sin "paste"
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    branding: false,
    language: 'es', // español
};

const props = defineProps({
  categorias: Array,
  paises: Array,
  emprendimiento: Object,
});

const provincias = ref([]);

const fetchProvincias = async () => {
  if (!form.pais_id) return;
  console.log('[fetchProvincias] Buscando provincias para país ID:', form.pais_id);

  try {
    const response = await axios.get(`/api/provincias/${form.pais_id}`);
    provincias.value = response.data;

    // Confirmar si la provincia asignada es válida
    const ids = provincias.value.map(p => p.id);
    console.log('[fetchProvincias] IDs disponibles:', ids);
    console.log('[fetchProvincias] provincia_id actual:', form.provincia_id);

    if (!ids.includes(form.provincia_id)) {
      console.warn('[fetchProvincias] La provincia_id actual no está entre las recibidas');
      form.provincia_id = ''; // opcionalmente puedes resetearla
    }
  } catch (error) {
    console.error('Error al cargar provincias:', error);
  }
};

const imagePrincipalPreview = ref(
  props.emprendimiento.imagen_principal ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_principal}` : null
)
const imagePrincipalFile = ref(null)

const imageLogoPreview = ref(
  props.emprendimiento.imagen_logo ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_logo}` : null
)
const imageLogoFile = ref(null)

const imageLogoConNombrePreview = ref(
  props.emprendimiento.imagen_logo_con_nombre
    ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_logo_con_nombre}`
    : null
)
const imageLogoConNombreFile = ref(null)

const imageSecundariaPreview = ref(
  props.emprendimiento.imagen_secundaria
    ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_secundaria}`
    : null
)
const imageSecundariaFile = ref(null)

const image1NosotrosPreview = ref(
  props.emprendimiento.imagen_1_nosotros
    ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_1_nosotros}`
    : null
)

const image1NosotrosFile = ref(null)

const image2NosotrosPreview = ref(
  props.emprendimiento.imagen_2_nosotros
    ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_2_nosotros}`
    : null
)

const image2NosotrosFile = ref(null)

function handleImageUpload(event, type) {
  const file = event.target.files[0]
  if (!file) return

  if (type === 'logo') {
    imageLogoFile.value = file
    imageLogoPreview.value = URL.createObjectURL(file)
    form.imagen_logo = file
  } else if (type === 'principal') {
    imagePrincipalFile.value = file
    imagePrincipalPreview.value = URL.createObjectURL(file)
    form.imagen_principal = file
  } else if (type === 'logoConNombre') {
    imageLogoConNombreFile.value = file
    imageLogoConNombrePreview.value = URL.createObjectURL(file)
    form.imagen_logo_con_nombre = file
  } else if (type === 'secundaria') {
    imageSecundariaFile.value = file
    imageSecundariaPreview.value = URL.createObjectURL(file)
    form.imagen_secundaria = file
  }else if (type === '1_nosotros') {
  image1NosotrosFile.value = file
  image1NosotrosPreview.value = URL.createObjectURL(file)
  form.imagen_1_nosotros = file
}else if (type === '2_nosotros') {
  image2NosotrosFile.value = file
  image2NosotrosPreview.value = URL.createObjectURL(file)
  form.imagen_2_nosotros = file
}
}

function handleDrop(event, type) {
  const file = event.dataTransfer.files[0]
  if (file && file.type.startsWith('image/')) {
    const dummyEvent = { target: { files: [file] } }
    handleImageUpload(dummyEvent, type)
  }
}

function formatFileSize(size) {
  const kb = size / 1024
  return kb > 1024 ? `${(kb / 1024).toFixed(2)} MB` : `${kb.toFixed(2)} KB`
}

// Etiquetas 1
const currentTagEtiquetas1 = ref('')
const tagsEtiquetas1 = ref(
  Array.isArray(props.emprendimiento.etiquetas_1)
    ? [...props.emprendimiento.etiquetas_1]
    : []
)

watch(tagsEtiquetas1, () => {
  form.etiquetas_1 = JSON.stringify(tagsEtiquetas1.value)
})

function addTagEtiquetas1() {
  const tag = currentTagEtiquetas1.value.trim()
  if (tag && !tagsEtiquetas1.value.includes(tag)) {
    tagsEtiquetas1.value.push(tag)
  }
  currentTagEtiquetas1.value = ''
}

function removeTagEtiquetas1(index) {
  tagsEtiquetas1.value.splice(index, 1)
}

// Etiquetas 2
const currentTagEtiquetas2 = ref('')
const tagsEtiquetas2 = ref(
  Array.isArray(props.emprendimiento.etiquetas_2)
    ? [...props.emprendimiento.etiquetas_2]
    : []
)

watch(tagsEtiquetas2, () => {
  form.etiquetas_2 = JSON.stringify(tagsEtiquetas2.value)
})

function addTagEtiquetas2() {
  const tag = currentTagEtiquetas2.value.trim()
  if (tag && !tagsEtiquetas2.value.includes(tag)) {
    tagsEtiquetas2.value.push(tag)
  }
  currentTagEtiquetas2.value = ''
}

function removeTagEtiquetas2(index) {
  tagsEtiquetas2.value.splice(index, 1)
}

// Inicializamos el form solo cuando props.emprendimiento está listo
const form = useForm({
  // Datos básicos
  titulo: props.emprendimiento?.titulo || '',
  slug: props.emprendimiento?.slug || '',
  descripcion: props.emprendimiento?.descripcion || '',

  // Etiquetas
  etiquetas_1: props.emprendimiento?.etiquetas_1 || [],
  etiquetas_2: props.emprendimiento?.etiquetas_2 || [],

  // Redes sociales
  facebook_url: props.emprendimiento?.facebook_url || '',
  instagram_url: props.emprendimiento?.instagram_url || '',
  linkedin_url: props.emprendimiento?.linkedin_url || '',
  web_url: props.emprendimiento?.web_url || '',
youtube_url: props.emprendimiento?.youtube_url || '',  // Nuevo campo para YouTube
tiktok_url: props.emprendimiento?.tiktok_url || '',    // Nuevo campo para TikTok
  // Imágenes (solo archivos, previews van por separado)
  imagen_principal: null,
  imagen_logo: null,
  imagen_logo_con_nombre: null,
  imagen_secundaria: null,
  imagen_1_nosotros: null,
  imagen_2_nosotros: null,

  // Vista previa de imágenes existentes
  imagen_principal_preview: props.emprendimiento?.imagen_principal ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_principal}` : null,
  imagen_logo_preview: props.emprendimiento?.imagen_logo ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_logo}` : null,
  imagen_logo_con_nombre_preview: props.emprendimiento?.imagen_logo_con_nombre ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_logo_con_nombre}` : null,
  imagen_secundaria_preview: props.emprendimiento?.imagen_secundaria ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_secundaria}` : null,
  imagen_1_nosotros_preview: props.emprendimiento?.imagen_1_nosotros ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_1_nosotros}` : null,
  imagen_2_nosotros_preview: props.emprendimiento?.imagen_2_nosotros ? `https://amazonfairtrade.org/storage/${props.emprendimiento.imagen_2_nosotros}` : null,

  // Nosotros
  titulo_1_nosotros: props.emprendimiento?.titulo_1_nosotros || '',
  texto_1_nosotros: props.emprendimiento?.texto_1_nosotros || '',
  titulo_2_nosotros: props.emprendimiento?.titulo_2_nosotros || '',
  texto_2_nosotros: props.emprendimiento?.texto_2_nosotros || '',

  // Misión
  titulo_mision: props.emprendimiento?.titulo_mision || '',
  texto_mision: props.emprendimiento?.texto_mision || '',

  // Mapa
  titulo_mapa: props.emprendimiento?.titulo_mapa || '',
  texto_mapa: props.emprendimiento?.texto_mapa || '',
  ubicacion_google_maps: props.emprendimiento?.ubicacion_google_maps || '',

  // Contacto
  correo_electronico: props.emprendimiento?.correo_electronico || '',
  telefono: props.emprendimiento?.telefono || '',
  celular: props.emprendimiento?.celular || '',
  ubicacion: props.emprendimiento?.ubicacion || '',
  direccion: props.emprendimiento?.direccion || '',

  // Colores personalizados
  color_principal_1: props.emprendimiento?.color_principal_1 || '#ffffff',
  color_secundario_1: props.emprendimiento?.color_secundario_1 || '#ffffff',
  color_secundario_2: '#ffffff', // fijo, como pediste

  // Relaciones
  categoria_id: props.emprendimiento?.categoria_id || '',
  pais_id: props.emprendimiento?.pais_id || '',
  provincia_id: props.emprendimiento?.provincia_id || '',
})

onMounted(() => {
  console.log('[onMounted] pais_id:', form.pais_id);

  if (form.pais_id) {
    fetchProvincias();
  } else {
    console.warn('[onMounted] pais_id aún no disponible, se omitió fetchProvincias');
  }

  try {
    const parsed1 = JSON.parse(form.etiquetas_1);
    tagsEtiquetas1.value = Array.isArray(parsed1) ? parsed1 : [];
  } catch {
    tagsEtiquetas1.value = form.etiquetas_1?.split(',').map(t => t.trim()) || [];
  }

  try {
    const parsed2 = JSON.parse(form.etiquetas_2);
    tagsEtiquetas2.value = Array.isArray(parsed2) ? parsed2 : [];
  } catch {
    tagsEtiquetas2.value = form.etiquetas_2?.split(',').map(t => t.trim()) || [];
  }
});


function handleFileChange(event, field) {
    const file = event.target.files[0]
    if (file) {
        form[field] = file
        form[`${field}_preview`] = URL.createObjectURL(file)
    }
}

const submitForm = async () => {
    const formData = new FormData();

    // Datos básicos
    formData.append('titulo', form.titulo);
    formData.append('descripcion', form.descripcion);
    formData.append('slug', form.slug);

    // Imágenes (solo se actualizan si el usuario cambió algo)
    if (imagePrincipalFile.value) {
        formData.append('imagen_principal', imagePrincipalFile.value);
    } else if (imagePrincipalPreview.value) {
        formData.append('imagen_principal_actual', imagePrincipalPreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    if (imageLogoFile.value) {
        formData.append('imagen_logo', imageLogoFile.value);
    } else if (imageLogoPreview.value) {
        formData.append('imagen_logo_actual', imageLogoPreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    if (imageLogoConNombreFile.value) {
        formData.append('imagen_logo_con_nombre', imageLogoConNombreFile.value);
    } else if (imageLogoConNombrePreview.value) {
        formData.append('imagen_logo_con_nombre_actual', imageLogoConNombrePreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    if (imageSecundariaFile.value) {
        formData.append('imagen_secundaria', imageSecundariaFile.value);
    } else if (imageSecundariaPreview.value) {
        formData.append('imagen_secundaria_actual', imageSecundariaPreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    if (image1NosotrosFile.value) {
        formData.append('imagen_1_nosotros', image1NosotrosFile.value);
    } else if (image1NosotrosPreview.value) {
        formData.append('imagen_1_nosotros_actual', image1NosotrosPreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    if (image2NosotrosFile.value) {
        formData.append('imagen_2_nosotros', image2NosotrosFile.value);
    } else if (image2NosotrosPreview.value) {
        formData.append('imagen_2_nosotros_actual', image2NosotrosPreview.value.replace('https://amazonfairtrade.org/storage/', ''));
    }

    // Relaciones
    formData.append('categoria_id', form.categoria_id);
    formData.append('pais_id', form.pais_id);
    formData.append('provincia_id', form.provincia_id);

    // Etiquetas
    formData.append('etiquetas_1', JSON.stringify(tagsEtiquetas1.value));
    formData.append('etiquetas_2', JSON.stringify(tagsEtiquetas2.value));

    // Campos adicionales
    formData.append('color_principal_1', form.color_principal_1);
    formData.append('color_secundario_1', form.color_secundario_1);
    formData.append('color_secundario_2', form.color_secundario_2);

    formData.append('titulo_1_nosotros', form.titulo_1_nosotros);
    formData.append('texto_1_nosotros', form.texto_1_nosotros);
    formData.append('titulo_2_nosotros', form.titulo_2_nosotros);
    formData.append('texto_2_nosotros', form.texto_2_nosotros);
    formData.append('titulo_mision', form.titulo_mision);
    formData.append('texto_mision', form.texto_mision);
    formData.append('titulo_mapa', form.titulo_mapa);
    formData.append('texto_mapa', form.texto_mapa);
    formData.append('ubicacion_google_maps', form.ubicacion_google_maps);

    formData.append('correo_electronico', form.correo_electronico);
    if (form.password) {
        formData.append('password', form.password);
    }
    formData.append('telefono', form.telefono);
    formData.append('celular', form.celular);
    formData.append('ubicacion', form.ubicacion);
    formData.append('direccion', form.direccion);
    formData.append('facebook_url', form.facebook_url);
    formData.append('instagram_url', form.instagram_url);
    formData.append('linkedin_url', form.linkedin_url);
    formData.append('web_url', form.web_url);
formData.append('youtube_url', form.youtube_url);  // Nuevo campo para YouTube
formData.append('tiktok_url', form.tiktok_url);    // Nuevo campo para TikTok
    try {
        console.log('📤 Enviando datos actualizados:', Object.fromEntries(formData.entries()));

        const response = await axios.post(route('emprendimiento.update'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-HTTP-Method-Override': 'PUT', // 👈 Laravel lo interpreta como PUT
            },
        });

        Swal.fire({
            title: '¡Éxito!',
            text: 'El emprendimiento se ha actualizado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });

        console.log('✅ Respuesta exitosa:', response);
    } catch (error) {
        console.error('❌ Error al enviar el formulario:', error);
        if (error.response?.data?.errors) {
            const errores = error.response.data.errors;
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                html: Object.values(errores).map(e => `<p>${e}</p>`).join('')
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error inesperado',
                text: 'Algo salió mal al actualizar. Revisa la consola.'
            });
        }
    }
};




</script>


<style scoped>
input[type='color'] {
    padding: 0;
    border: none;
}
</style>
