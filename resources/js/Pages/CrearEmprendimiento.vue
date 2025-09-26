<template>

    <Head title="Create" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Emprendimiento</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Información de depuración -->
                        <div v-if="showDebug"
                            class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                            <h3 class="font-bold">Información de depuración:</h3>
                            <p>Categorías cargadas: {{ categorias.length }}</p>
                            <p>Países cargados: {{ paises.length }}</p>
                            <p>Provincias cargadas: {{ provincias.length }}</p>
                        </div>

                        <!-- Mensaje de éxito -->
                        <div v-if="$page.props.flash && $page.props.flash.message"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ $page.props.flash.message }}
                        </div>

                        <!-- Formulario -->
                        <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">

                            <!-- Título -->
                            <div>
                                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                                <input type="text" id="titulo" v-model="form.titulo"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    required />
                                <div v-if="form.errors.titulo" class="text-red-500 text-sm mt-1">{{ form.errors.titulo
                                    }}</div>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700">Descripción</label>
                                <textarea id="descripcion" v-model="form.descripcion"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    rows="4" required></textarea>
                                <div v-if="form.errors.descripcion" class="text-red-500 text-sm mt-1">{{
                                    form.errors.descripcion
                                    }}
                                </div>
                            </div>
                            <!-- Imagen Principal -->
                            <div>
                                <label for="imagen_principal" class="block text-sm font-medium text-gray-700">Imagen
                                    Principal</label>
                                <div class="mt-2">
                                    <div v-if="imagePrincipalPreview"
                                        class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <img :src="imagePrincipalPreview" alt="Vista previa Imagen Principal"
                                                class="h-52 max-h-52 w-auto object-contain rounded-md" />
                                        </div>
                                        <div v-if="imagePrincipalFile"
                                            class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <span class="truncate max-w-xs">{{ imagePrincipalFile.name }}</span>
                                                <span class="ml-2 text-xs text-gray-500">{{
                                                    formatFileSize(imagePrincipalFile.size) }}</span>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" @click="removeImage('principal')"
                                                    class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                                <label for="imagen_principal"
                                                    class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
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
                                    </div>
                                    <div v-else
                                        class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
                                        @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                                        @drop.prevent="handleDrop($event, 'principal')">
                                        <input id="imagen_principal" type="file"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*" @change="handleImageUpload($event, 'principal')">
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
                            </div>

                            <!-- Imagen Logo -->
                            <div>
                                <label for="imagen_logo" class="block text-sm font-medium text-gray-700">Imagen
                                    Logo</label>
                                <div class="mt-2">
                                    <div v-if="imageLogoPreview"
                                        class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <img :src="imageLogoPreview" alt="Vista previa Imagen Logo"
                                                class="h-52 max-h-52 w-auto object-contain rounded-md" />
                                        </div>
                                        <div v-if="imageLogoFile"
                                            class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <span class="truncate max-w-xs">{{ imageLogoFile.name }}</span>
                                                <span class="ml-2 text-xs text-gray-500">{{
                                                    formatFileSize(imageLogoFile.size)
                                                }}</span>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" @click="removeImage('logo')"
                                                    class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                                <label for="imagen_logo"
                                                    class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                                    </svg>
                                                    Cambiar
                                                </label>
                                                <input id="imagen_logo" type="file" class="hidden" accept="image/*"
                                                    @change="handleImageUpload($event, 'logo')" />
                                            </div>
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
                            </div>


                            <!-- Imagen Logo con Nombre -->
                            <div>
                                <label for="imagen_logo_con_nombre"
                                    class="block text-sm font-medium text-gray-700">Imagen Logo
                                    con Nombre</label>
                                <div class="mt-2">
                                    <div v-if="imageLogoConNombrePreview"
                                        class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <img :src="imageLogoConNombrePreview"
                                                alt="Vista previa Imagen Logo con Nombre"
                                                class="h-52 max-h-52 w-auto object-contain rounded-md" />
                                        </div>
                                        <div v-if="imageLogoConNombreFile"
                                            class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <span class="truncate max-w-xs">{{ imageLogoConNombreFile.name }}</span>
                                                <span class="ml-2 text-xs text-gray-500">{{
                                                    formatFileSize(imageLogoConNombreFile.size) }}</span>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" @click="removeImage('logoConNombre')"
                                                    class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                                <label for="imagen_logo_con_nombre"
                                                    class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                                    </svg>
                                                    Cambiar
                                                </label>
                                                <input id="imagen_logo_con_nombre" type="file" class="hidden"
                                                    accept="image/*"
                                                    @change="handleImageUpload($event, 'logoConNombre')" />
                                            </div>
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
                            </div>


                            <!-- Imagen Secundaria -->
                            <div>
                                <label for="imagen_secundaria" class="block text-sm font-medium text-gray-700">Imagen
                                    Secundaria</label>
                                <div class="mt-2">
                                    <div v-if="imageSecundariaPreview"
                                        class="relative bg-gray-50 border border-gray-200 rounded-lg p-1 shadow-sm">
                                        <div class="flex items-center justify-center">
                                            <img :src="imageSecundariaPreview" alt="Vista previa Imagen Secundaria"
                                                class="h-52 max-h-52 w-auto object-contain rounded-md" />
                                        </div>
                                        <div v-if="imageSecundariaFile"
                                            class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <span class="truncate max-w-xs">{{ imageSecundariaFile.name }}</span>
                                                <span class="ml-2 text-xs text-gray-500">{{
                                                    formatFileSize(imageSecundariaFile.size) }}</span>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" @click="removeImage('secundaria')"
                                                    class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                                <label for="imagen_secundaria"
                                                    class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                                    </svg>
                                                    Cambiar
                                                </label>
                                                <input id="imagen_secundaria" type="file" class="hidden"
                                                    accept="image/*"
                                                    @change="handleImageUpload($event, 'secundaria')" />
                                            </div>
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
                            </div>

                            <!-- Etiquetas 1 -->
                            <div>
                                <label for="etiquetas_1" class="block text-sm font-medium text-gray-700">Etiquetas
                                    1</label>
                                <div class="mt-1">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span v-for="(tag, index) in tagsEtiquetas1" :key="index"
                                            class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ tag }}
                                            <button type="button" @click="removeTagEtiquetas1(index)"
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
                                        <input type="text" id="etiquetas1Tag" v-model="currentTagEtiquetas1"
                                            placeholder="Ej: 200gr" @keydown.enter.prevent="addTagEtiquetas1"
                                            class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
                                        <button type="button" @click="addTagEtiquetas1"
                                            class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <p v-if="errors.etiquetas_1" class="text-red-500 text-xs mt-1">{{ errors.etiquetas_1 }}
                                </p>
                            </div>

                            <!-- Etiquetas 2 -->
                            <div>
                                <label for="etiquetas_2" class="block text-sm font-medium text-gray-700">Etiquetas
                                    2</label>
                                <div class="mt-1">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span v-for="(tag, index) in tagsEtiquetas2" :key="index"
                                            class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ tag }}
                                            <button type="button" @click="removeTagEtiquetas2(index)"
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
                                        <input type="text" id="etiquetas2Tag" v-model="currentTagEtiquetas2"
                                            placeholder="Ej: Orgánico" @keydown.enter.prevent="addTagEtiquetas2"
                                            class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:ring-purple-500 focus:border-purple-500" />
                                        <button type="button" @click="addTagEtiquetas2"
                                            class="px-4 py-2 border border-transparent rounded-r-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                                <p v-if="errors.etiquetas_2" class="text-red-500 text-xs mt-1">{{ errors.etiquetas_2 }}
                                </p>
                            </div>

                            <!-- Sección para los datos de "Nosotros" -->

                            <div>
                                <label for="titulo_1_nosotros" class="block text-sm font-medium text-gray-700">Título 1
                                    (Nosotros)</label>
                                <input type="text" id="titulo_1_nosotros" v-model="form.titulo_1_nosotros"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.titulo_1_nosotros" class="text-red-500 text-sm mt-1">{{
                                    form.errors.titulo_1_nosotros }}</div>
                            </div>

                            <!-- Imagen 1 (Nosotros) -->
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
      <div v-if="image1NosotrosFile"
        class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <span class="truncate max-w-xs">{{ image1NosotrosFile.name }}</span>
          <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(image1NosotrosFile.size) }}</span>
        </div>
        <div class="flex space-x-2">
          <button type="button" @click="removeImage('imagen1Nosotros')"
            class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>
          <label for="imagen_1_nosotros"
            class="p-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded flex items-center text-xs font-medium transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
              <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
            </svg>
            Cambiar
          </label>
          <input id="imagen_1_nosotros" type="file" class="hidden" accept="image/*"
            @change="handleImageUpload($event, 'imagen1Nosotros')" />
        </div>
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'imagen1Nosotros')">
      <input id="imagen_1_nosotros" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'imagen1Nosotros')">
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





                            <div>
                                <label for="texto_1_nosotros" class="block text-sm font-medium text-gray-700">Texto 1
                                    (Nosotros)</label>
                                <Editor v-model="form.texto_1_nosotros" id="texto_1_nosotros"
                                    api-key="2mamc399uo3rtd3te29feifckaegccgbkkhmfr8klpjpvddw" :init="editorConfig" />
                                <div v-if="form.errors.texto_1_nosotros" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.texto_1_nosotros }}
                                </div>
                            </div>
                            <div>
                                <label for="titulo_2_nosotros" class="block text-sm font-medium text-gray-700">Título 2
                                    (Nosotros)</label>
                                <input type="text" id="titulo_2_nosotros" v-model="form.titulo_2_nosotros"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.titulo_2_nosotros" class="text-red-500 text-sm mt-1">{{
                                    form.errors.titulo_2_nosotros }}</div>
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
      <div v-if="image2NosotrosFile"
        class="mt-2 px-2 py-1.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center text-sm text-gray-600">
          <span class="truncate max-w-xs">{{ image2NosotrosFile.name }}</span>
          <span class="ml-2 text-xs text-gray-500">{{ formatFileSize(image2NosotrosFile.size) }}</span>
        </div>
        <div class="flex space-x-2">
          <button type="button" @click="removeImage('imagen2Nosotros')"
            class="p-1 bg-red-100 text-red-600 hover:bg-red-200 rounded flex items-center text-xs font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            Eliminar
          </button>
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
            @change="handleImageUpload($event, 'imagen2Nosotros')" />
        </div>
      </div>
    </div>
    <div v-else
      class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition-colors"
      @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
      @drop.prevent="handleDrop($event, 'imagen2Nosotros')">
      <input id="imagen_2_nosotros" type="file"
        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
        accept="image/*" @change="handleImageUpload($event, 'imagen2Nosotros')">
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


                            <div>

                                <label for="texto_2_nosotros" class="block text-sm font-medium text-gray-700">Texto 2
                                    (Nosotros)</label>
                                <Editor v-model="form.texto_2_nosotros" id="texto_2_nosotros"
                                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
                                <div v-if="form.errors.texto_2_nosotros" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.texto_2_nosotros }}
                                </div>
                            </div>

                            <!-- Sección para la Misión -->
                            <div>
                                <label for="titulo_mision" class="block text-sm font-medium text-gray-700">Título de la
                                    Misión</label>
                                <input type="text" id="titulo_mision" v-model="form.titulo_mision"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.titulo_mision" class="text-red-500 text-sm mt-1">{{
                                    form.errors.titulo_mision
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="texto_mision" class="block text-sm font-medium text-gray-700">Texto de la
                                    Misión</label>
                                <Editor v-model="form.texto_mision" id="texto_mision"
                                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
                                <div v-if="form.errors.texto_mision" class="text-red-500 text-sm mt-1">{{
                                    form.errors.texto_mision
                                    }}
                                </div>
                            </div>


                            <!-- Sección para el Mapa -->
                            <div>
                                <label for="titulo_mapa" class="block text-sm font-medium text-gray-700">Título del
                                    Mapa</label>
                                <input type="text" id="titulo_mapa" v-model="form.titulo_mapa"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.titulo_mapa" class="text-red-500 text-sm mt-1">{{
                                    form.errors.titulo_mapa
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="texto_mapa" class="block text-sm font-medium text-gray-700">Texto del
                                    Mapa</label>
                                <textarea id="texto_mapa" v-model="form.texto_mapa"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    rows="4"></textarea>
                                <div v-if="form.errors.texto_mapa" class="text-red-500 text-sm mt-1">{{
                                    form.errors.texto_mapa
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="ubicacion_google_maps"
                                    class="block text-sm font-medium text-gray-700">Ubicación en
                                    Google
                                    Maps</label>
                                <input type="text" id="ubicacion_google_maps" v-model="form.ubicacion_google_maps"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    placeholder="Ejemplo: -1.5857772, -77.7436251" />
                                <div v-if="form.errors.ubicacion_google_maps" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.ubicacion_google_maps }}
                                </div>
                            </div>
                            <!-- Sección para el Contacto -->
                            <div>
                                <label for="correo_electronico" class="block text-sm font-medium text-gray-700">Correo
                                    Electrónico</label>
                                <input type="email" id="correo_electronico" v-model="form.correo_electronico" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.correo_electronico" class="text-red-500 text-sm mt-1">{{
                                    form.errors.correo_electronico }}</div>
                            </div>

                            <!-- Contraseña -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña de
                                    acceso</label>
                                <input type="password" id="password" v-model="form.password"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    required />
                                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.password }}
                                </div>
                            </div>

                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="text" id="telefono" v-model="form.telefono"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{
                                    form.errors.telefono }}
                                </div>
                            </div>

                            <div>
                                <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                                <input type="text" id="celular" v-model="form.celular"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.celular" class="text-red-500 text-sm mt-1">{{ form.errors.celular
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                                <input type="text" id="ubicacion" v-model="form.ubicacion"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.ubicacion" class="text-red-500 text-sm mt-1">{{
                                    form.errors.ubicacion }}
                                </div>
                            </div>

                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" id="direccion" v-model="form.direccion"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                                <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{
                                    form.errors.direccion }}
                                </div>
                            </div>

                            <!-- Redes Sociales -->
                            <div>
                                <label for="facebook_url" class="block text-sm font-medium text-gray-700">Facebook
                                    URL</label>
                                <input type="text" id="facebook_url" v-model="form.facebook_url"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://facebook.com/tu-pagina" />
                                <div v-if="form.errors.facebook_url" class="text-red-500 text-sm mt-1">{{
                                    form.errors.facebook_url
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram
                                    URL</label>
                                <input type="text" id="instagram_url" v-model="form.instagram_url"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://instagram.com/tu-cuenta" />
                                <div v-if="form.errors.instagram_url" class="text-red-500 text-sm mt-1">{{
                                    form.errors.instagram_url
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700">LinkedIn
                                    URL</label>
                                <input type="text" id="linkedin_url" v-model="form.linkedin_url"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://linkedin.com/in/tu-perfil" />
                                <div v-if="form.errors.linkedin_url" class="text-red-500 text-sm mt-1">{{
                                    form.errors.linkedin_url
                                    }}
                                </div>
                            </div>

                            <div>
                                <label for="web_url" class="block text-sm font-medium text-gray-700">Sitio Web</label>
                                <input type="text" id="web_url" v-model="form.web_url"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    placeholder="https://tusitioweb.com" />
                                <div v-if="form.errors.web_url" class="text-red-500 text-sm mt-1">{{ form.errors.web_url
                                    }}
                                </div>
                            </div>

                            <!-- TikTok URL -->
<div>
    <label for="tiktok_url" class="block text-sm font-medium text-gray-700">TikTok URL</label>
    <input type="text" id="tiktok_url" v-model="form.tiktok_url"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        placeholder="https://tiktok.com/@tu-cuenta" />
    <div v-if="form.errors.tiktok_url" class="text-red-500 text-sm mt-1">{{ form.errors.tiktok_url }}</div>
</div>

<!-- YouTube URL -->
<div>
    <label for="youtube_url" class="block text-sm font-medium text-gray-700">YouTube URL</label>
    <input type="text" id="youtube_url" v-model="form.youtube_url"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        placeholder="https://youtube.com/c/tu-canal" />
    <div v-if="form.errors.youtube_url" class="text-red-500 text-sm mt-1">{{ form.errors.youtube_url }}</div>
</div>

                            <!-- Sección para los Colores -->
                            <div>
                                <label for="color_principal_1" class="block text-sm font-medium text-gray-700">Color
                                    Principal
                                    1</label>

                                <div class="relative mt-1">
                                    <!-- Color input con previsualización -->
                                    <div class="flex items-center">
                                        <!-- Previsualización del color -->
                                        <div class="h-10 w-10 rounded-l-md border border-gray-300 shadow-sm"
                                            :style="{ backgroundColor: form.color_principal_1 }"></div>

                                        <!-- Input de color mejorado -->
                                        <div class="flex-1 relative">
                                            <input type="color" id="color_principal_1" v-model="form.color_principal_1"
                                                class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />
                                            <div
                                                class="flex items-center h-10 px-3 border border-l-0 border-gray-300 rounded-r-md shadow-sm bg-white">
                                                <span class="flex-1 text-gray-700 font-mono text-sm">{{
                                                    form.color_principal_1
                                                    }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    viewBox="0 0 20 20" fill="currentColor"
                                                    :style="{ fill: form.color_principal_1 }">
                                                    <path
                                                        d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.errors.color_principal_1" class="text-red-500 text-sm mt-1">{{
                                    form.errors.color_principal_1 }}</div>
                            </div>


                            <div>
                                <label for="color_secundario_1" class="block text-sm font-medium text-gray-700">Color
                                    Secundario
                                    1</label>

                                <div class="relative mt-1">
                                    <!-- Color input con previsualización -->
                                    <div class="flex items-center">
                                        <!-- Previsualización del color -->
                                        <div class="h-10 w-10 rounded-l-md border border-gray-300 shadow-sm"
                                            :style="{ backgroundColor: form.color_secundario_1 }"></div>

                                        <!-- Input de color mejorado -->
                                        <div class="flex-1 relative">
                                            <input type="color" id="color_secundario_1"
                                                v-model="form.color_secundario_1"
                                                class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />
                                            <div
                                                class="flex items-center h-10 px-3 border border-l-0 border-gray-300 rounded-r-md shadow-sm bg-white">
                                                <span class="flex-1 text-gray-700 font-mono text-sm">{{
                                                    form.color_secundario_1
                                                }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                    viewBox="0 0 20 20" fill="currentColor"
                                                    :style="{ fill: form.color_secundario_1 }">
                                                    <path
                                                        d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.errors.color_secundario_1" class="text-red-500 text-sm mt-1">{{
                                    form.errors.color_secundario_1 }}</div>
                            </div>

                            <!-- Categoría -->
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                                <select v-model="form.categoria_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    required>
                                    <option value="" disabled selected>Seleccione una categoría</option>
                                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                                        {{ categoria.nombre }}
                                    </option>
                                </select>
                                <div v-if="form.errors.categoria_id" class="text-red-500 text-sm mt-1">{{
                                    form.errors.categoria_id
                                    }}
                                </div>
                            </div>

                            <!-- País -->
                            <div>
                                <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                                <select v-model="form.pais_id" @change="fetchProvincias"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    required>
                                    <option value="" disabled selected>Seleccione un país</option>
                                    <option v-for="pais in paises" :key="pais.id" :value="pais.id">
                                        {{ pais.nombre }}
                                    </option>
                                </select>
                                <div v-if="form.errors.pais_id" class="text-red-500 text-sm mt-1">{{ form.errors.pais_id
                                    }}
                                </div>
                            </div>

                            <!-- Provincia -->
                            <div>
                                <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                                <select v-model="form.provincia_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                    required :disabled="!form.pais_id">
                                    <option value="" disabled selected>{{ form.pais_id ? 'Seleccione una provincia' :
                                        'Seleccione primero un país' }}</option>
                                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">
                                        {{ provincia.nombre }}
                                    </option>
                                </select>
                                <div v-if="form.errors.provincia_id" class="text-red-500 text-sm mt-1">{{
                                    form.errors.provincia_id
                                    }}
                                </div>
                            </div>

                            <!-- Enviar formulario -->
                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700"
                                    :disabled="form.processing">
                                    {{ form.processing ? 'Creando...' : 'Crear Emprendimiento' }}
                                </button>
                            </div>

                            <!-- Información de depuración -->
                            <div class="mt-4">
                                <button type="button" @click="showDebug = !showDebug"
                                    class="text-sm text-gray-500 hover:text-gray-700">
                                    {{ showDebug ? 'Ocultar información de depuración' : 'Mostrar información de depuración' }}
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue'
import Swal from 'sweetalert2';

const imagePreview = ref(null);
const imageFile = ref(null);
const isUploading = ref(false);
const dragOver = ref(false);
const errors = ref({});

// Referencias para las vistas previas y archivos
const imagePrincipalPreview = ref(null);
const imageLogoPreview = ref(null);
const imageLogoConNombrePreview = ref(null);
const imageSecundariaPreview = ref(null);
const image1NosotrosPreview = ref(null);
const image2NosotrosPreview = ref(null);

// Archivos cargados
const imagePrincipalFile = ref(null);
const imageLogoFile = ref(null);
const imageLogoConNombreFile = ref(null);
const imageSecundariaFile = ref(null);
const image1NosotrosFile = ref(null);
const image2NosotrosFile = ref(null);

// Referencias reactivas para las etiquetas
const tagsEtiquetas1 = ref([]);        // Etiquetas para la primera sección
const tagsEtiquetas2 = ref([]);        // Etiquetas para la segunda sección

const currentTagEtiquetas1 = ref('');  // Valor actual de la etiqueta para la primera sección
const currentTagEtiquetas2 = ref('');  // Valor actual de la etiqueta para la segunda sección

// Función para agregar una etiqueta a la primera sección
const addTagEtiquetas1 = () => {
    if (currentTagEtiquetas1.value.trim()) {
        tagsEtiquetas1.value.push(currentTagEtiquetas1.value.trim());
        currentTagEtiquetas1.value = '';
        updateFormEtiquetas1();
    }
};

// Función para eliminar una etiqueta de la primera sección
const removeTagEtiquetas1 = (index) => {
    tagsEtiquetas1.value.splice(index, 1);
    updateFormEtiquetas1();
};

// Función para agregar una etiqueta a la segunda sección
const addTagEtiquetas2 = () => {
    if (currentTagEtiquetas2.value.trim()) {
        tagsEtiquetas2.value.push(currentTagEtiquetas2.value.trim());
        currentTagEtiquetas2.value = '';
        updateFormEtiquetas2();
    }
};

// Función para eliminar una etiqueta de la segunda sección
const removeTagEtiquetas2 = (index) => {
    tagsEtiquetas2.value.splice(index, 1);
    updateFormEtiquetas2();
};

// Actualiza el formulario con las etiquetas en formato de cadena
const updateFormEtiquetas1 = () => {
    form.etiquetas_1 = tagsEtiquetas1.value.join(',');
};

const updateFormEtiquetas2 = () => {
    form.etiquetas_2 = tagsEtiquetas2.value.join(',');
};
// Función para formatear el tamaño del archivo
const formatFileSize = (size) => {
    if (size < 1024) return `${size} bytes`;
    else if (size < 1048576) return `${(size / 1024).toFixed(2)} KB`;
    else if (size < 1073741824) return `${(size / 1048576).toFixed(2)} MB`;
    else return `${(size / 1073741824).toFixed(2)} GB`;
};

// Función para manejar la carga de imágenes
const handleImageUpload = (event, imageType) => {
    const file = event.target.files[0];
    if (!file) return;

    if (!file.type.match('image.*')) {
        alert('El archivo seleccionado no es una imagen válida');
        return;
    }

    isUploading.value = true;

    const reader = new FileReader();
    reader.onload = (e) => {
        switch (imageType) {
            case 'principal':
                imagePrincipalPreview.value = e.target.result;
                imagePrincipalFile.value = file;
                break;
            case 'logo':
                imageLogoPreview.value = e.target.result;
                imageLogoFile.value = file;
                break;
            case 'logoConNombre':
                imageLogoConNombrePreview.value = e.target.result;
                imageLogoConNombreFile.value = file;
                break;
            case 'secundaria':
                imageSecundariaPreview.value = e.target.result;
                imageSecundariaFile.value = file;
                break;
            case 'imagen1Nosotros':
                image1NosotrosPreview.value = e.target.result;
                image1NosotrosFile.value = file;
                break;
            case 'imagen2Nosotros':
                image2NosotrosPreview.value = e.target.result;
                image2NosotrosFile.value = file;
                break;
        }
        isUploading.value = false;
    };

    reader.onerror = () => {
        alert('Error al cargar la imagen');
        isUploading.value = false;
    };
    reader.readAsDataURL(file);
};


// Función para eliminar imágenes
const removeImage = (imageType) => {
    switch (imageType) {
        case 'principal':
            imagePrincipalFile.value = null;
            imagePrincipalPreview.value = null;
            break;
        case 'logo':
            imageLogoFile.value = null;
            imageLogoPreview.value = null;
            break;
        case 'logoConNombre':
            imageLogoConNombreFile.value = null;
            imageLogoConNombrePreview.value = null;
            break;
        case 'secundaria':
            imageSecundariaFile.value = null;
            imageSecundariaPreview.value = null;
            break;
        case 'imagen1Nosotros':
            image1NosotrosFile.value = null;
            image1NosotrosPreview.value = null;
            break;
        case 'imagen2Nosotros':
            image2NosotrosFile.value = null;
            image2NosotrosPreview.value = null;
            break;
    }
};


const handleDrop = (event, imageType) => {
    dragOver.value = false;
    const file = event.dataTransfer.files[0];
    if (file && file.type.match('image.*')) {
        // Reemplazar la imagen actual con la nueva
        const dummyEvent = { target: { files: [file] } };
        handleImageUpload(dummyEvent, imageType);
    } else {
        alert('Solo se permiten archivos de imagen');
    }
};

// Definir las propiedades pasadas al componente
const props = defineProps({
    categorias: Array,
    paises: Array,
});

const editorConfig = {
    height: 300,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
        'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount' // 👈 sin "paste"
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    branding: false,
    language: 'es', // español
};

// Variable para mostrar/ocultar la depuración
const showDebug = ref(false);

// Inicializar el formulario
const form = useForm({
    titulo: '',
    descripcion: '',
    imagen_principal: null,
    imagen_logo: null,
    imagen_logo_con_nombre: null,
    imagen_secundaria: null,
    etiquetas_1: '',
    etiquetas_2: '',
    categoria_id: '',
    pais_id: '',
    provincia_id: '',
    color_principal_1: '',  // Color principal 1
    color_secundario_1: '', // Color secundario 1
    color_secundario_2: '#ffffff',
    facebook_url: '',        // 🟢 nuevas redes
    instagram_url: '',
    linkedin_url: '',
    web_url: '',
    correo_electronico: '',    // ya existente
    password: '',
    tiktok_url: '',
    youtube_url: '',
});

// Referencias reactivas
const categorias = ref([]);
const paises = ref([]);
const provincias = ref([]);

// Cargar categorías desde API si no se pasan en props
const loadCategorias = async () => {
    try {
        const response = await axios.get('/api/categorias');
        categorias.value = response.data;
    } catch (error) {
        console.error('Error al cargar categorías:', error);
    }
};

// Cargar países desde API si no se pasan en props
const loadPaises = async () => {
    try {
        const response = await axios.get('/api/paises');
        paises.value = response.data;
    } catch (error) {
        console.error('Error al cargar países:', error);
    }
};

// Cargar provincias según el país seleccionado
const fetchProvincias = async () => {
    if (form.pais_id) {
        try {
            form.provincia_id = '';
            const response = await axios.get(`/api/provincias/${form.pais_id}`);
            provincias.value = response.data;
        } catch (error) {
            console.error('Error al cargar provincias:', error);
        }
    } else {
        provincias.value = [];
    }
};

// Cargar categorías y países cuando el componente se monta
onMounted(() => {
    if (props.categorias && props.categorias.length) {
        categorias.value = props.categorias;
    } else {
        loadCategorias();
    }

    if (props.paises && props.paises.length) {
        paises.value = props.paises;
    } else {
        loadPaises();
    }
});

// Enviar el formulario
const submitForm = async () => {
    const formData = new FormData();

    // Agregar todos los campos del formulario
    formData.append('titulo', form.titulo);
    formData.append('descripcion', form.descripcion);
   if (imagePrincipalFile.value) {
    formData.append('imagen_principal', imagePrincipalFile.value);
}
if (imageLogoFile.value) {
    formData.append('imagen_logo', imageLogoFile.value);
}
if (imageLogoConNombreFile.value) {
    formData.append('imagen_logo_con_nombre', imageLogoConNombreFile.value);
}
if (imageSecundariaFile.value) {
    formData.append('imagen_secundaria', imageSecundariaFile.value);
}
if (image1NosotrosFile.value) {
    formData.append('imagen_1_nosotros', image1NosotrosFile.value);
}
if (image2NosotrosFile.value) {
    formData.append('imagen_2_nosotros', image2NosotrosFile.value);
}


    // Relaciones (Categoría, País, Provincia)
    formData.append('categoria_id', form.categoria_id);
    formData.append('pais_id', form.pais_id);
    formData.append('provincia_id', form.provincia_id);

    // Eliminar JSON.stringify
    // Convertir etiquetas a un arreglo de cadenas
    //formData.append('etiquetas_1', JSON.stringify(form.etiquetas_1.split(',').map(item => item.trim())));
    //formData.append('etiquetas_2', JSON.stringify(form.etiquetas_2.split(',').map(item => item.trim())));

    formData.append('etiquetas_1', JSON.stringify(tagsEtiquetas1.value));
    formData.append('etiquetas_2', JSON.stringify(tagsEtiquetas2.value));

    formData.append('pais_id', form.pais_id);
    formData.append('provincia_id', form.provincia_id);
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
    formData.append('password', form.password);
    formData.append('telefono', form.telefono);
    formData.append('celular', form.celular);
    formData.append('ubicacion', form.ubicacion);
    formData.append('direccion', form.direccion);
    formData.append('facebook_url', form.facebook_url);
    formData.append('instagram_url', form.instagram_url);
    formData.append('linkedin_url', form.linkedin_url);
    formData.append('web_url', form.web_url);
   // Agregar YouTube y TikTok
    formData.append('youtube_url', form.youtube_url);
    formData.append('tiktok_url', form.tiktok_url);

    try {
        console.log('Enviando datos del formulario:', Object.fromEntries(formData.entries()));

        const response = await axios.post(route('emprendimiento.store'), formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });

        // Mostrar la alerta de éxito con SweetAlert2
        Swal.fire({
            title: '¡Éxito!',
            text: 'El emprendimiento se ha creado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });

        console.log('Respuesta exitosa:', response);

        // Redirigir o hacer algo más después del éxito
        // window.location.href = '/ruta/del/éxito'; // Ejemplo de redirección si es necesario

    } catch (error) {
        console.error('Error al enviar el formulario:', error);
        if (error.response?.data) {
            console.log('Detalles del error del backend:', error.response.data);
                console.log('Errores de validación:', error.response.data.errors);

        }

        // Mostrar la alerta de error con SweetAlert2
        Swal.fire({
            title: '¡Error!',
            text: error.response?.data?.message || 'Hubo un error al crear el emprendimiento.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
};
</script>
