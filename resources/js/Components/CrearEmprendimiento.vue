<template>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Crear Nuevo Emprendimiento</h1>

        <!-- Información de depuración -->
        <div v-if="showDebug" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
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
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
                <div v-if="form.errors.titulo" class="text-red-500 text-sm mt-1">{{ form.errors.titulo }}</div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea id="descripcion" v-model="form.descripcion"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" rows="4"
                    required></textarea>
                <div v-if="form.errors.descripcion" class="text-red-500 text-sm mt-1">{{ form.errors.descripcion }}
                </div>
            </div>

            <!-- Imágenes -->
            <div>
                <label for="imagen_principal" class="block text-sm font-medium text-gray-700">Imagen Principal</label>
                <input type="file" id="imagen_principal" @input="form.imagen_principal = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_principal" class="text-red-500 text-sm mt-1">{{
                    form.errors.imagen_principal }}</div>
            </div>

            <div>
                <label for="imagen_logo" class="block text-sm font-medium text-gray-700">Imagen Logo</label>
                <input type="file" id="imagen_logo" @input="form.imagen_logo = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_logo" class="text-red-500 text-sm mt-1">{{ form.errors.imagen_logo }}
                </div>
            </div>

            <div>
                <label for="imagen_logo_con_nombre" class="block text-sm font-medium text-gray-700">Imagen Logo con
                    Nombre</label>
                <input type="file" id="imagen_logo_con_nombre"
                    @input="form.imagen_logo_con_nombre = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_logo_con_nombre" class="text-red-500 text-sm mt-1">{{
                    form.errors.imagen_logo_con_nombre }}</div>
            </div>

            <div>
                <label for="imagen_secundaria" class="block text-sm font-medium text-gray-700">Imagen Secundaria</label>
                <input type="file" id="imagen_secundaria" @input="form.imagen_secundaria = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_secundaria" class="text-red-500 text-sm mt-1">{{
                    form.errors.imagen_secundaria }}</div>
            </div>

            <!-- Etiquetas 1 -->
            <div>
                <label for="etiquetas_1" class="block text-sm font-medium text-gray-700">Etiquetas 1</label>
                <input type="text" id="etiquetas_1" v-model="form.etiquetas_1"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="Etiquetas separadas por coma" />
                <div v-if="form.errors.etiquetas_1" class="text-red-500 text-sm mt-1">{{ form.errors.etiquetas_1 }}
                </div>
            </div>

            <!-- Etiquetas 2 -->
            <div>
                <label for="etiquetas_2" class="block text-sm font-medium text-gray-700">Etiquetas 2</label>
                <input type="text" id="etiquetas_2" v-model="form.etiquetas_2"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="Etiquetas separadas por coma" />
                <div v-if="form.errors.etiquetas_2" class="text-red-500 text-sm mt-1">{{ form.errors.etiquetas_2 }}
                </div>
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

            <div>
                <label for="imagen_1_nosotros" class="block text-sm font-medium text-gray-700">Imagen 1
                    (Nosotros)</label>
                <input type="file" id="imagen_1_nosotros" @input="form.imagen_1_nosotros = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_1_nosotros" class="text-red-500 text-sm mt-1">{{
                    form.errors.imagen_1_nosotros }}</div>
            </div>



            <div>
                <label for="texto_1_nosotros" class="block text-sm font-medium text-gray-700">Texto 1 (Nosotros)</label>
                <Editor v-model="form.texto_1_nosotros" id="texto_1_nosotros"
                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
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
            <div>
                <label for="imagen_2_nosotros" class="block text-sm font-medium text-gray-700">Imagen 2
                    (Nosotros)</label>
                <input type="file" id="imagen_2_nosotros" @input="form.imagen_2_nosotros = $event.target.files[0]"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.imagen_2_nosotros" class="text-red-500 text-sm mt-1">{{
                    form.errors.imagen_2_nosotros }}</div>
            </div>

            <div>

                <label for="texto_2_nosotros" class="block text-sm font-medium text-gray-700">Texto 2 (Nosotros)</label>
                <Editor v-model="form.texto_2_nosotros" id="texto_2_nosotros"
                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
                <div v-if="form.errors.texto_2_nosotros" class="text-red-500 text-sm mt-1">
                    {{ form.errors.texto_2_nosotros }}
                </div>
            </div>

            <!-- Sección para la Misión -->
            <div>
                <label for="titulo_mision" class="block text-sm font-medium text-gray-700">Título de la Misión</label>
                <input type="text" id="titulo_mision" v-model="form.titulo_mision"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.titulo_mision" class="text-red-500 text-sm mt-1">{{ form.errors.titulo_mision }}
                </div>
            </div>

            <div>
                <label for="texto_mision" class="block text-sm font-medium text-gray-700">Texto de la Misión</label>
                <Editor v-model="form.texto_mision" id="texto_mision"
                    api-key="b3u3hzbr5vf8fkfcmcxzy68c98ugm2fm7swpvuxlkm3h6eyi" :init="editorConfig" />
                <div v-if="form.errors.texto_mision" class="text-red-500 text-sm mt-1">{{ form.errors.texto_mision }}
                </div>
            </div>


            <!-- Sección para el Mapa -->
            <div>
                <label for="titulo_mapa" class="block text-sm font-medium text-gray-700">Título del Mapa</label>
                <input type="text" id="titulo_mapa" v-model="form.titulo_mapa"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.titulo_mapa" class="text-red-500 text-sm mt-1">{{ form.errors.titulo_mapa }}
                </div>
            </div>

            <div>
                <label for="texto_mapa" class="block text-sm font-medium text-gray-700">Texto del Mapa</label>
                <textarea id="texto_mapa" v-model="form.texto_mapa"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" rows="4"></textarea>
                <div v-if="form.errors.texto_mapa" class="text-red-500 text-sm mt-1">{{ form.errors.texto_mapa }}</div>
            </div>

            <div>
                <label for="ubicacion_google_maps" class="block text-sm font-medium text-gray-700">Ubicación en Google
                    Maps</label>
                <input type="text" id="ubicacion_google_maps" v-model="form.ubicacion_google_maps"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="Ejemplo: -1.5857772, -77.7436251" required />
                <div v-if="form.errors.ubicacion_google_maps" class="text-red-500 text-sm mt-1">
                    {{ form.errors.ubicacion_google_maps }}
                </div>
            </div>
            <!-- Sección para el Contacto -->
            <div>
                <label for="correo_electronico" class="block text-sm font-medium text-gray-700">Correo
                    Electrónico</label>
                <input type="email" id="correo_electronico" v-model="form.correo_electronico"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.correo_electronico" class="text-red-500 text-sm mt-1">{{
                    form.errors.correo_electronico }}</div>
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña de acceso</label>
                <input type="password" id="password" v-model="form.password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                    {{ form.errors.password }}
                </div>
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" id="telefono" v-model="form.telefono"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{ form.errors.telefono }}</div>
            </div>

            <div>
                <label for="celular" class="block text-sm font-medium text-gray-700">Celular</label>
                <input type="text" id="celular" v-model="form.celular"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.celular" class="text-red-500 text-sm mt-1">{{ form.errors.celular }}</div>
            </div>

            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" id="ubicacion" v-model="form.ubicacion"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.ubicacion" class="text-red-500 text-sm mt-1">{{ form.errors.ubicacion }}</div>
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" id="direccion" v-model="form.direccion"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{ form.errors.direccion }}</div>
            </div>

            <!-- Redes Sociales -->
            <div>
                <label for="facebook_url" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                <input type="text" id="facebook_url" v-model="form.facebook_url"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="https://facebook.com/tu-pagina" />
                <div v-if="form.errors.facebook_url" class="text-red-500 text-sm mt-1">{{ form.errors.facebook_url }}
                </div>
            </div>

            <div>
                <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                <input type="text" id="instagram_url" v-model="form.instagram_url"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="https://instagram.com/tu-cuenta" />
                <div v-if="form.errors.instagram_url" class="text-red-500 text-sm mt-1">{{ form.errors.instagram_url }}
                </div>
            </div>

            <div>
                <label for="linkedin_url" class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
                <input type="text" id="linkedin_url" v-model="form.linkedin_url"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="https://linkedin.com/in/tu-perfil" />
                <div v-if="form.errors.linkedin_url" class="text-red-500 text-sm mt-1">{{ form.errors.linkedin_url }}
                </div>
            </div>

            <div>
                <label for="web_url" class="block text-sm font-medium text-gray-700">Sitio Web</label>
                <input type="text" id="web_url" v-model="form.web_url"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    placeholder="https://tusitioweb.com" />
                <div v-if="form.errors.web_url" class="text-red-500 text-sm mt-1">{{ form.errors.web_url }}</div>
            </div>

            <!-- Sección para los Colores -->
            <div>
                <label for="color_principal_1" class="block text-sm font-medium text-gray-700">Color Principal 1</label>
                <input type="color" id="color_principal_1" v-model="form.color_principal_1"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.color_principal_1" class="text-red-500 text-sm mt-1">{{
                    form.errors.color_principal_1 }}</div>
            </div>

            <div>
                <label for="color_secundario_1" class="block text-sm font-medium text-gray-700">Color Secundario
                    1</label>
                <input type="color" id="color_secundario_1" v-model="form.color_secundario_1"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
                <div v-if="form.errors.color_secundario_1" class="text-red-500 text-sm mt-1">{{
                    form.errors.color_secundario_1 }}</div>
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
                <select v-model="form.categoria_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled selected>Seleccione una categoría</option>
                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                        {{ categoria.nombre }}
                    </option>
                </select>
                <div v-if="form.errors.categoria_id" class="text-red-500 text-sm mt-1">{{ form.errors.categoria_id }}
                </div>
            </div>

            <!-- País -->
            <div>
                <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                <select v-model="form.pais_id" @change="fetchProvincias"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled selected>Seleccione un país</option>
                    <option v-for="pais in paises" :key="pais.id" :value="pais.id">
                        {{ pais.nombre }}
                    </option>
                </select>
                <div v-if="form.errors.pais_id" class="text-red-500 text-sm mt-1">{{ form.errors.pais_id }}</div>
            </div>

            <!-- Provincia -->
            <div>
                <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                <select v-model="form.provincia_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required
                    :disabled="!form.pais_id">
                    <option value="" disabled selected>{{ form.pais_id ? 'Seleccione una provincia' : 'Seleccione primero un país' }}</option>
                    <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">
                        {{ provincia.nombre }}
                    </option>
                </select>
                <div v-if="form.errors.provincia_id" class="text-red-500 text-sm mt-1">{{ form.errors.provincia_id }}
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
                <button type="button" @click="showDebug = !showDebug" class="text-sm text-gray-500 hover:text-gray-700">
                    {{ showDebug ? 'Ocultar información de depuración' : 'Mostrar información de depuración' }}
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue'

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
    formData.append('imagen_principal', form.imagen_principal);
    formData.append('imagen_logo', form.imagen_logo);
    formData.append('imagen_logo_con_nombre', form.imagen_logo_con_nombre);
    formData.append('imagen_secundaria', form.imagen_secundaria);

    // Relaciones (Categoría, País, Provincia)
    formData.append('categoria_id', form.categoria_id);
    formData.append('pais_id', form.pais_id);
    formData.append('provincia_id', form.provincia_id);

    // Eliminar JSON.stringify
    // Convertir etiquetas a un arreglo de cadenas
    formData.append('etiquetas_1', JSON.stringify(form.etiquetas_1.split(',').map(item => item.trim())));
    formData.append('etiquetas_2', JSON.stringify(form.etiquetas_2.split(',').map(item => item.trim())));

    formData.append('categoria_id', form.categoria_id);
    formData.append('pais_id', form.pais_id);
    formData.append('provincia_id', form.provincia_id);
    formData.append('color_principal_1', form.color_principal_1);
    formData.append('color_secundario_1', form.color_secundario_1);
    formData.append('color_secundario_2', form.color_secundario_2);
    formData.append('imagen_1_nosotros', form.imagen_1_nosotros);
    formData.append('titulo_1_nosotros', form.titulo_1_nosotros);
    formData.append('texto_1_nosotros', form.texto_1_nosotros);
    formData.append('imagen_2_nosotros', form.imagen_2_nosotros);
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

    try {
        console.log('Enviando datos del formulario:', Object.fromEntries(formData.entries()));

        const response = await axios.post(route('emprendimiento.store'), formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });

        console.log('Respuesta exitosa:', response);
        alert('Emprendimiento creado con éxito');
    } catch (error) {
        console.error('Error al enviar el formulario:', error);
        if (error.response?.data) {
            console.log('Detalles del error del backend:', error.response.data);
        }
    }
};

</script>
