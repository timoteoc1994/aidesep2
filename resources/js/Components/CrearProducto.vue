<template>
  <AdminLayout>
    <div class="container mx-auto py-6">
      <h1 class="text-2xl font-bold mb-6">Crear Producto</h1>

      <form @submit.prevent="submitForm" class="space-y-6" enctype="multipart/form-data">
        <!-- Emprendimiento -->
        <div>
          <label for="emprendimiento_id" class="block text-sm font-medium text-gray-700">Emprendimiento</label>
          <select id="emprendimiento_id" v-model="form.emprendimiento_id"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
            <option value="" disabled selected>Seleccione un emprendimiento</option>
            <option v-for="emprendimiento in emprendimientos" :key="emprendimiento.id" :value="emprendimiento.id">
              {{ emprendimiento.titulo }}
            </option>
          </select>
        </div>

        <!-- Nombre -->
        <div>
          <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
          <input type="text" id="nombre" v-model="form.nombre"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
        </div>

        <!-- Descripción -->
        <div>
          <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
          <textarea id="descripcion" v-model="form.descripcion" rows="4"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <!-- Imagen -->
        <div>
          <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
          <input type="file" id="imagen" @input="form.imagen = $event.target.files[0]"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" />
        </div>

        <!-- Etiquetas Presentación -->
        <div>
          <label for="etiquetas_presentacion" class="block text-sm font-medium text-gray-700">Presentaciones Disponibles</label>
          <input type="text" id="etiquetas_presentacion" v-model="form.etiquetas_presentacion"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
            placeholder="Ej: 200gr, 400gr" />
        </div>

        <!-- Etiquetas Calidad -->
        <div>
          <label for="etiquetas_calidad" class="block text-sm font-medium text-gray-700">Cualidades (Natural, Orgánico...)</label>
          <input type="text" id="etiquetas_calidad" v-model="form.etiquetas_calidad"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
            placeholder="Ej: 100% natural, Orgánico" />
        </div>

        <!-- Beneficios -->
        <div>
          <label for="beneficios" class="block text-sm font-medium text-gray-700">Beneficios</label>
          <textarea id="beneficios" v-model="form.beneficios" rows="4"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"></textarea>
        </div>

        <!-- Modo de Uso -->
        <div>
          <label for="modo_uso" class="block text-sm font-medium text-gray-700">Modo de Uso</label>
          <textarea id="modo_uso" v-model="form.modo_uso" rows="4"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"></textarea>
        </div>

        <!-- Origen -->
        <div>
          <label for="origen" class="block text-sm font-medium text-gray-700">Origen</label>
          <input type="text" id="origen" v-model="form.origen"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
            placeholder="Ej: Elaborado en la Amazonía" />
        </div>

        <!-- Botón -->
        <div>
          <button type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700">
            {{ form.processing ? 'Creando...' : 'Crear Producto' }}
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  emprendimientos: Array,
});

const emprendimientos = ref(props.emprendimientos);

const form = useForm({
  emprendimiento_id: '',
  nombre: '',
  descripcion: '',
  imagen: null,
  etiquetas_presentacion: '',
  etiquetas_calidad: '',
  beneficios: '',
  modo_uso: '',
  origen: '',
});

const submitForm = async () => {
  const formData = new FormData();

  // Agregamos todos los campos con logs
  console.log('📦 Preparando datos del producto...');

  formData.append('emprendimiento_id', form.emprendimiento_id);
  console.log('➡️ Emprendimiento ID:', form.emprendimiento_id);

  formData.append('nombre', form.nombre);
  console.log('➡️ Nombre:', form.nombre);

  formData.append('descripcion', form.descripcion);
  console.log('➡️ Descripción:', form.descripcion);

  if (form.imagen) {
    formData.append('imagen', form.imagen);
    console.log('📸 Imagen cargada:', form.imagen.name);
  } else {
    console.log('⚠️ No se cargó ninguna imagen');
  }

  formData.append('etiquetas_presentacion', JSON.stringify(form.etiquetas_presentacion.split(',').map(item => item.trim())));
  formData.append('etiquetas_calidad', JSON.stringify(form.etiquetas_calidad.split(',').map(item => item.trim())));

  formData.append('beneficios', form.beneficios);
  console.log('💡 Beneficios:', form.beneficios);

  formData.append('modo_uso', form.modo_uso);
  console.log('📘 Modo de uso:', form.modo_uso);

  formData.append('origen', form.origen);
  console.log('🌍 Origen:', form.origen);

  console.log('🚀 Enviando datos al backend...');

  try {

    const response = await axios.post(route('producto.store'), formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        console.log('Respuesta exitosa:', response);
                alert('Producto creado con éxito');

  } catch (error) {
    console.error('❌ Error al crear producto:', error);
    if (error.response?.data) {
      console.log('📋 Detalle del error:', error.response.data);
    }
  }
};

</script>
