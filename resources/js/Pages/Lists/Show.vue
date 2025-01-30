<template>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="mb-8 text-center">
            <h1
                class="text-3xl font-semibold text-gray-800 dark:text-gray mb-4"
            >
                {{ list.nombre }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Aquí se mostrarán las flashcards de la lista seleccionada.
            </p>
        </div>

        <div class="space-y-6">
            <div
                class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow"
            >
                <span class="text-xl font-medium text-gray-800 dark:text-white"
                    >Idioma</span
                >
                <span class="text-lg text-gray-600 dark:text-gray-300">{{
                    list.idioma
                }}</span>
            </div>

            <div
                class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow"
            >
                <span class="text-xl font-medium text-gray-800 dark:text-white"
                    >Nivel</span
                >
                <span class="text-lg text-gray-600 dark:text-gray-300">{{
                    list.nivel
                }}</span>
            </div>
        </div>

        <div class="mt-8 text-center">
            <button
                @click="goBack"
                class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Volver atrás
            </button>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        list: Object,
    },
    methods: {
        goBack() {
            Inertia.visit("/lists");
        },
    },
};
</script>
