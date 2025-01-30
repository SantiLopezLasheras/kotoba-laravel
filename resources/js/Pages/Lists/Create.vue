<template>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h1
            class="text-center text-3xl font-semibold text-gray-800 dark:text-gray mb-8"
        >
            Crear Lista Nueva
        </h1>

        <form @submit.prevent="submitForm" class="space-y-6">
            <div>
                <label
                    for="nombre"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                >
                    Nombre de la lista
                </label>
                <input
                    v-model="form.nombre"
                    type="text"
                    id="nombre"
                    name="nombre"
                    required
                    placeholder="Nombre de la lista"
                    :class="{
                        'mt-1 block w-full px-3 py-2 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600': true,
                        'border-red-500': form.errors.nombre,
                    }"
                />
                <span v-if="form.errors.nombre" class="text-sm text-red-500">
                    {{ form.errors.nombre }}
                </span>
            </div>

            <div>
                <label
                    for="idioma"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                >
                    Idioma
                </label>
                <input
                    v-model="form.idioma"
                    type="text"
                    id="idioma"
                    name="idioma"
                    placeholder="Idioma"
                    :class="{
                        'mt-1 block w-full px-3 py-2 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600': true,
                        'border-red-500': form.errors.idioma,
                    }"
                />
                <span v-if="form.errors.idioma" class="text-sm text-red-500">
                    {{ form.errors.idioma }}
                </span>
            </div>

            <div>
                <label
                    for="nivel"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                >
                    Nivel
                </label>
                <select
                    v-model="form.nivel"
                    id="nivel"
                    name="nivel"
                    :class="{
                        'mt-1 block w-full px-3 py-2 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600': true,
                        'border-red-500': form.errors.nivel,
                    }"
                >
                    <option value="principiante">Principiante</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                </select>
                <span v-if="form.errors.nivel" class="text-sm text-red-500">
                    {{ form.errors.nivel }}
                </span>
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-indigo-400 transition-all"
                >
                    {{ form.processing ? "Creando..." : "Crear Lista" }}
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    data() {
        return {
            form: {
                nombre: "",
                idioma: "",
                nivel: "",
                errors: {},
                processing: false,
            },
        };
    },
    methods: {
        async submitForm() {
            this.form.errors = {}; // Borra errores anteriores
            this.form.processing = true;

            try {
                await Inertia.post("/lists", this.form);
            } catch (e) {
                this.form.errors = e.response.data.errors;
            } finally {
                this.form.processing = false;
            }
        },
    },
};
</script>

<style scoped>
.is-invalid {
    border-color: #f44336;
}
.text-red-500 {
    color: #f44336;
}
</style>
