<template>

    <Head title="Crear Producto" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Producto</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
                            <!-- Emprendimiento -->
                            <div class="form-group">
                                <label for="emprendimiento_id"
                                    class="block text-sm font-medium text-gray-700 mb-1">Emprendimiento</label>

                                <!-- Campo de búsqueda para filtrar emprendimientos -->
                                <div class="relative mb-2">
                                    <input type="text" v-model="searchTerm" placeholder="Buscar emprendimiento..."
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
                                </div>

                                <div class="relative">
                                    <select id="emprendimiento_id" v-model="form.emprendimiento_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                        :class="{ 'border-red-500': errors.emprendimiento_id }" required>
                                        <option value="" disabled selected>Seleccione un emprendimiento</option>
                                        <!-- Filtrar los emprendimientos según el término de búsqueda -->
                                        <option v-for="emprendimiento in filteredEmprendimientos"
                                            :key="emprendimiento.id" :value="emprendimiento.id">
                                            {{ emprendimiento.titulo }}
                                        </option>
                                    </select>
                                    <p v-if="errors.emprendimiento_id" class="text-red-500 text-xs mt-1">{{
                                        errors.emprendimiento_id }}</p>
                                </div>
                            </div>


                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del
                                    Producto</label>
                                <input type="text" id="nombre" v-model="form.nombre"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                    :class="{ 'border-red-500': errors.nombre }" required />
                                <p v-if="errors.nombre" class="text-red-500 text-xs mt-1">{{ errors.nombre }}</p>
                            </div>

                            <!-- Descripción -->
                            <div class="form-group">
                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                <textarea id="descripcion" v-model="form.descripcion" rows="4"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                    :class="{ 'border-red-500': errors.descripcion }" required></textarea>
                                <p v-if="errors.descripcion" class="text-red-500 text-xs mt-1">{{ errors.descripcion }}
                                </p>
                            </div>

                            <!-- Imagen -->
                           <!-- Imagen 1 -->
<div class="form-group">
    <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen del Producto</label>

    <!-- Area de visualización de imagen -->
    <div class="mt-2">
        <div v-if="imagePreview"
            class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
            <div class="flex items-center justify-center">
                <img :src="imagePreview" alt="Vista previa"
                    class="h-52 max-h-52 w-auto object-contain rounded-md" />
            </div>

            <!-- Información del archivo -->
            <div v-if="imageFile"
                class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="truncate max-w-xs">{{ imageFile.name }}</span>
                    <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile.size) }}</span>
                </div>

                <!-- Control de opciones -->
                <div class="flex space-x-2">
                    <button type="button" @click="removeImage('imagen')"
                        class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Eliminar
                    </button>
                    <label for="imagen"
                        class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                        </svg>
                        Cambiar
                    </label>
                    <input id="imagen" type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen')" />
                </div>
            </div>
        </div>

        <!-- Área de carga (cuando no hay imagen) -->
        <div v-else
            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event, 'imagen')"
            :class="{ 'bg-purple-50 border-purple-300': dragOver }">
            <input id="imagen" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="handleImageUpload($event, 'imagen')" />
            <div class="space-y-2 text-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                    viewBox="0 0 48 48" aria-hidden="true">
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

    <!-- Loading indicator -->
    <div v-if="isUploadingImagen" class="mt-2 flex items-center justify-center">
        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-sm text-gray-500">Cargando imagen...</span>
    </div>

    <!-- Error message -->
    <p v-if="errors.imagen" class="mt-2 text-sm text-red-600">{{ errors.imagen }}</p>

    <!-- Recommendation -->
    <p class="mt-2 text-xs text-gray-500">Para una mejor visualización, recomendamos imágenes de al menos 800x800 píxeles.</p>
</div>

<!-- Imagen 2, 3 y 4 -->



                            <!-- Imagen 2 -->
<div class="form-group">
    <label for="imagen_2" class="block text-sm font-medium text-gray-700 mb-1">Imagen 2 del Producto</label>

    <!-- Área de visualización de imagen 2 -->
    <div class="mt-2">
        <div v-if="imagePreview2"
            class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
            <div class="flex items-center justify-center">
                <img :src="imagePreview2" alt="Vista previa"
                    class="h-52 max-h-52 w-auto object-contain rounded-md" />
            </div>

            <!-- Información del archivo 2 -->
            <div v-if="imageFile2"
                class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="truncate max-w-xs">{{ imageFile2.name }}</span>
                    <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile2.size) }}</span>
                </div>

                <!-- Control de opciones 2 -->
                <div class="flex space-x-2">
                    <button type="button" @click="removeImage('imagen_2')"
                        class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Eliminar
                    </button>
                    <label for="imagen_2"
                        class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                        </svg>
                        Cambiar
                    </label>
                    <input id="imagen_2" type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_2')" />
                </div>
            </div>
        </div>

        <!-- Área de carga (cuando no hay imagen 2) -->
        <div v-else
            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event, 'imagen_2')"
            :class="{ 'bg-purple-50 border-purple-300': dragOver }">
            <input id="imagen_2" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="handleImageUpload($event, 'imagen_2')" />
            <div class="space-y-2 text-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                    viewBox="0 0 48 48" aria-hidden="true">
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

    <!-- Loading indicator -->
    <div v-if="isUploading" class="mt-2 flex items-center justify-center">
        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-sm text-gray-500">Cargando imagen...</span>
    </div>

    <!-- Error message -->
    <p v-if="errors.imagen_2" class="mt-2 text-sm text-red-600">{{ errors.imagen_2 }}</p>

    <!-- Recommendation -->
    <p class="mt-2 text-xs text-gray-500">Para una mejor visualización, recomendamos imágenes de al menos 800x800 píxeles.</p>
</div>

<!-- Imagen 3 -->
<div class="form-group">
    <label for="imagen_3" class="block text-sm font-medium text-gray-700 mb-1">Imagen 3 del Producto</label>

    <!-- Área de visualización de imagen 3 -->
    <div class="mt-2">
        <div v-if="imagePreview3"
            class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
            <div class="flex items-center justify-center">
                <img :src="imagePreview3" alt="Vista previa"
                    class="h-52 max-h-52 w-auto object-contain rounded-md" />
            </div>

            <!-- Información del archivo 3 -->
            <div v-if="imageFile3"
                class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="truncate max-w-xs">{{ imageFile3.name }}</span>
                    <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile3.size) }}</span>
                </div>

                <!-- Control de opciones 3 -->
                <div class="flex space-x-2">
                    <button type="button" @click="removeImage('imagen_3')"
                        class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Eliminar
                    </button>
                    <label for="imagen_3"
                        class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                        </svg>
                        Cambiar
                    </label>
                    <input id="imagen_3" type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_3')" />
                </div>
            </div>
        </div>

        <!-- Área de carga (cuando no hay imagen 3) -->
        <div v-else
            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event, 'imagen_3')"
            :class="{ 'bg-purple-50 border-purple-300': dragOver }">
            <input id="imagen_3" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="handleImageUpload($event, 'imagen_3')" />
            <div class="space-y-2 text-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                    viewBox="0 0 48 48" aria-hidden="true">
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

    <!-- Loading indicator -->
    <div v-if="isUploading" class="mt-2 flex items-center justify-center">
        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-sm text-gray-500">Cargando imagen...</span>
    </div>

    <!-- Error message -->
    <p v-if="errors.imagen_3" class="mt-2 text-sm text-red-600">{{ errors.imagen_3 }}</p>

    <!-- Recommendation -->
    <p class="mt-2 text-xs text-gray-500">Para una mejor visualización, recomendamos imágenes de al menos 800x800 píxeles.</p>
</div>

<!-- Imagen 4 -->
<div class="form-group">
    <label for="imagen_4" class="block text-sm font-medium text-gray-700 mb-1">Imagen 4 del Producto</label>

    <!-- Área de visualización de imagen 4 -->
    <div class="mt-2">
        <div v-if="imagePreview4"
            class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
            <div class="flex items-center justify-center">
                <img :src="imagePreview4" alt="Vista previa"
                    class="h-52 max-h-52 w-auto object-contain rounded-md" />
            </div>

            <!-- Información del archivo 4 -->
            <div v-if="imageFile4"
                class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="truncate max-w-xs">{{ imageFile4.name }}</span>
                    <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(imageFile4.size) }}</span>
                </div>

                <!-- Control de opciones 4 -->
                <div class="flex space-x-2">
                    <button type="button" @click="removeImage('imagen_4')"
                        class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Eliminar
                    </button>
                    <label for="imagen_4"
                        class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                        </svg>
                        Cambiar
                    </label>
                    <input id="imagen_4" type="file" class="hidden" accept="image/*" @change="handleImageUpload($event, 'imagen_4')" />
                </div>
            </div>
        </div>

        <!-- Área de carga (cuando no hay imagen 4) -->
        <div v-else
            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event, 'imagen_4')"
            :class="{ 'bg-purple-50 border-purple-300': dragOver }">
            <input id="imagen_4" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="handleImageUpload($event, 'imagen_4')" />
            <div class="space-y-2 text-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                    viewBox="0 0 48 48" aria-hidden="true">
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

    <!-- Loading indicator -->
    <div v-if="isUploading" class="mt-2 flex items-center justify-center">
        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-sm text-gray-500">Cargando imagen...</span>
    </div>

    <!-- Error message -->
    <p v-if="errors.imagen_4" class="mt-2 text-sm text-red-600">{{ errors.imagen_4 }}</p>

    <!-- Recommendation -->
    <p class="mt-2 text-xs text-gray-500">Para una mejor visualización, recomendamos imágenes de al menos 800x800 píxeles.</p>
</div>

                            <!-- Etiquetas Presentación -->
                            <div class="form-group">
                                <label for="etiquetas_presentacion"
                                    class="block text-sm font-medium text-gray-700 mb-1">
                                    Presentaciones Disponibles
                                </label>
                                <div class="mt-1">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span v-for="(tag, index) in tagsPresentation" :key="index"
                                            class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ tag }}
                                            <button type="button" @click="removeTagPresentation(index)"
                                                class="ml-1.5 text-purple-600 hover:text-purple-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <input type="text" id="presentationTag" v-model="currentPresentationTag"
                                            placeholder="Ej: 200gr" @keydown.enter.prevent="addTagPresentation"
                                            class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
                                        <button type="button" @click="addTagPresentation"
                                            class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <p v-if="errors.etiquetas_presentacion" class="text-red-500 text-xs mt-1">{{
                                    errors.etiquetas_presentacion }}</p>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="flex">
                                        <input type="text" id="qualityTag" v-model="currentQualityTag"
                                            placeholder="Ej: 100% natural" @keydown.enter.prevent="addTagQuality"
                                            class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
                                        <button type="button" @click="addTagQuality"
                                            class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <p v-if="errors.etiquetas_calidad" class="text-red-500 text-xs mt-1">{{
                                    errors.etiquetas_calidad
                                }}</p>
                            </div>

                            <!-- Beneficios -->
                            <div class="form-group">
                                <label for="beneficios"
                                    class="block text-sm font-medium text-gray-700 mb-1">Beneficios</label>
                                <textarea id="beneficios" v-model="form.beneficios" rows="4"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                    :class="{ 'border-red-500': errors.beneficios }"></textarea>
                                <p v-if="errors.beneficios" class="text-red-500 text-xs mt-1">{{ errors.beneficios }}
                                </p>
                            </div>

                            <!-- Modo de Uso -->
                            <div class="form-group">
                                <label for="modo_uso" class="block text-sm font-medium text-gray-700 mb-1">Modo de
                                    Uso</label>
                                <textarea id="modo_uso" v-model="form.modo_uso" rows="4"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                    :class="{ 'border-red-500': errors.modo_uso }"></textarea>
                                <p v-if="errors.modo_uso" class="text-red-500 text-xs mt-1">{{ errors.modo_uso }}</p>
                            </div>

                            <!-- Origen -->
                            <div class="form-group">
                                <label for="origen" class="block text-sm font-medium text-gray-700 mb-1">Origen</label>
                                <input type="text" id="origen" v-model="form.origen"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                                    :class="{ 'border-red-500': errors.origen }"
                                    placeholder="Ej: Elaborado en la Amazonía" />
                                <p v-if="errors.origen" class="text-red-500 text-xs mt-1">{{ errors.origen }}</p>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" @click="cancelForm"
                                    class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                                    :disabled="form.processing">
                                    <div v-if="form.processing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Creando...
                                    </div>
                                    <span v-else>Crear Producto</span>
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
import { ref, onMounted, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import axios from 'axios';

const props = defineProps({
    emprendimientos: Array,
});
const searchTerm = ref(''); // Término de búsqueda para filtrar emprendimientos

// Computed property para filtrar los emprendimientos
const filteredEmprendimientos = computed(() => {
    if (!searchTerm.value) {
        return emprendimientos.value; // Si no hay búsqueda, mostrar todos los emprendimientos
    }
    return emprendimientos.value.filter(emprendimiento =>
        emprendimiento.titulo.toLowerCase().includes(searchTerm.value.toLowerCase()) // Filtra por título
    );
});
const emprendimientos = ref(props.emprendimientos || []);
const imagePreview = ref(null);
const imageFile = ref(null);
const imagePreview2 = ref(null);
const imageFile2 = ref(null);
const imagePreview3 = ref(null);
const imageFile3 = ref(null);
const imagePreview4 = ref(null);
const imageFile4 = ref(null);
const isUploading = ref(false);
const dragOver = ref(false);
const errors = ref({});


// Tag management for presentations
const tagsPresentation = ref([]);
const currentPresentationTag = ref('');

const addTagPresentation = () => {
    if (currentPresentationTag.value.trim()) {
        tagsPresentation.value.push(currentPresentationTag.value.trim());
        currentPresentationTag.value = '';
        updateFormPresentationTags();
    }
};

const removeTagPresentation = (index) => {
    tagsPresentation.value.splice(index, 1);
    updateFormPresentationTags();
};

const updateFormPresentationTags = () => {
    form.etiquetas_presentacion = tagsPresentation.value.join(',');
};

// Tag management for quality
const tagsQuality = ref([]);
const currentQualityTag = ref('');

const addTagQuality = () => {
    if (currentQualityTag.value.trim()) {
        tagsQuality.value.push(currentQualityTag.value.trim());
        currentQualityTag.value = '';
        updateFormQualityTags();
    }
};

const removeTagQuality = (index) => {
    tagsQuality.value.splice(index, 1);
    updateFormQualityTags();
};

const updateFormQualityTags = () => {
    form.etiquetas_calidad = tagsQuality.value.join(',');
};

// Form setup with validation
const form = useForm({
    emprendimiento_id: '',
    nombre: '',
    descripcion: '',
    imagen: null,
    imagen_2: null,
    imagen_3: null,
    imagen_4: null,
    etiquetas_presentacion: '',
    etiquetas_calidad: '',
    beneficios: '',
    modo_uso: '',
    origen: '',
    processing: false,
});

// Image handling for each image
const handleImageUpload = (event, imageType) => {
    const file = event.target.files[0];
    if (!file) return;

    if (!file.type.match('image.*')) {
        showErrorAlert('El archivo seleccionado no es una imagen válida');
        return;
    }

    // Validar tamaño del archivo (máximo 10MB)
    if (file.size > 10 * 1024 * 1024) {
        showErrorAlert('La imagen es demasiado grande', 'El tamaño máximo permitido es 10MB.');
        return;
    }

    isUploading.value = true;

    if (imageType === 'imagen') {
        form.imagen = file;
        imageFile.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
            isUploading.value = false;
        };
        reader.readAsDataURL(file);
    } else if (imageType === 'imagen_2') {
        form.imagen_2 = file;
        imageFile2.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview2.value = e.target.result;
            isUploading.value = false;
        };
        reader.readAsDataURL(file);
    } else if (imageType === 'imagen_3') {
        form.imagen_3 = file;
        imageFile3.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview3.value = e.target.result;
            isUploading.value = false;
        };
        reader.readAsDataURL(file);
    } else if (imageType === 'imagen_4') {
        form.imagen_4 = file;
        imageFile4.value = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview4.value = e.target.result;
            isUploading.value = false;
        };
        reader.readAsDataURL(file);
    }
};


const handleDrop = (event, imageType) => {
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
    if (imageType === 'imagen') {
        form.imagen = null;
        imagePreview.value = null;
        imageFile.value = null;
    } else if (imageType === 'imagen_2') {
        form.imagen_2 = null;
        imagePreview2.value = null;
        imageFile2.value = null;
    } else if (imageType === 'imagen_3') {
        form.imagen_3 = null;
        imagePreview3.value = null;
        imageFile3.value = null;
    } else if (imageType === 'imagen_4') {
        form.imagen_4 = null;
        imagePreview4.value = null;
        imageFile4.value = null;
    }
};

// Format file size for display
const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

// Form submission
const submitForm = async () => {
    const newErrors = {};

    if (!form.emprendimiento_id) newErrors.emprendimiento_id = 'Debe seleccionar un emprendimiento';
    if (!form.nombre) newErrors.nombre = 'El nombre del producto es requerido';
    if (!form.descripcion) newErrors.descripcion = 'La descripción es requerida';

    if (Object.keys(newErrors).length > 0) {
        errors.value = newErrors;
        showErrorAlert('Por favor, complete todos los campos requeridos');
        return;
    }

    form.processing = true;

    const formData = new FormData();
    formData.append('emprendimiento_id', form.emprendimiento_id);
    formData.append('nombre', form.nombre);
    formData.append('descripcion', form.descripcion);
    if (form.imagen) formData.append('imagen', form.imagen);
    if (form.imagen_2) formData.append('imagen_2', form.imagen_2);
    if (form.imagen_3) formData.append('imagen_3', form.imagen_3);
    if (form.imagen_4) formData.append('imagen_4', form.imagen_4);
    formData.append('etiquetas_presentacion', JSON.stringify(tagsPresentation.value));
    formData.append('etiquetas_calidad', JSON.stringify(tagsQuality.value));
    formData.append('beneficios', form.beneficios);
    formData.append('modo_uso', form.modo_uso);
    formData.append('origen', form.origen);

    try {
        await axios.post('/crear-producto', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });

        Swal.fire({
            title: '¡Producto creado!',
            text: 'El producto ha sido creado exitosamente',
            icon: 'success',
            confirmButtonText: 'Continuar',
            confirmButtonColor: '#9333EA'
        }).then(() => {
            // No hacer nada por ahora
        });
    } catch (error) {
        if (error.response?.data?.errors) {
            errors.value = error.response.data.errors;
        }

        showErrorAlert(
            'Error al crear el producto',
            error.response?.data?.message || 'Por favor, verifique los datos e intente nuevamente'
        );

        console.error('Error al crear producto:', error);
    } finally {
        form.processing = false;
    }
};

const cancelForm = () => {
    Swal.fire({
        title: '¿Cancelar operación?',
        text: 'Los cambios no guardados se perderán',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#9333EA',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Sí, salir',
        cancelButtonText: 'No, continuar editando'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/productos';
        }
    });
};

// Helper functions for alerts
const showErrorAlert = (title, message = '') => {
    Swal.fire({
        title: title,
        text: message,
        icon: 'error',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#9333EA'
    });
};

// Initialize from existing data when editing
onMounted(() => {
    // Split existing tags if form is in edit mode
    if (form.etiquetas_presentacion) {
        try {
            const existingTags = form.etiquetas_presentacion.split(',').map(tag => tag.trim());
            if (existingTags.length > 0 && existingTags[0] !== '') {
                tagsPresentation.value = existingTags;
            }
        } catch (e) {
            console.error('Error parsing presentation tags', e);
        }
    }

    if (form.etiquetas_calidad) {
        try {
            const existingTags = form.etiquetas_calidad.split(',').map(tag => tag.trim());
            if (existingTags.length > 0 && existingTags[0] !== '') {
                tagsQuality.value = existingTags;
            }
        } catch (e) {
            console.error('Error parsing quality tags', e);
        }
    }
});
</script>

<style>
/* Add any custom styles here */
.form-group {
    margin-bottom: 1.5rem;
}
</style>
