<template>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h1
            class="text-3xl font-semibold text-gray-800 dark:text-gray mb-8 text-center"
        >
            Lista de Flashcards
        </h1>

        <ul class="space-y-4">
            <li
                v-for="flashcard in flashcards"
                :key="flashcard.id"
                class="flex flex-col sm:flex-row items-center justify-between p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:scale-105 transition-all duration-300 transform"
            >
                <div
                    class="flex flex-col sm:flex-row sm:space-x-4 w-full sm:w-auto"
                >
                    <span
                        class="text-xl font-semibold text-gray-800 dark:text-white"
                        >{{ flashcard.palabra }}</span
                    >
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        {{ flashcard.traduccion }}
                    </p>
                </div>

                <div class="mt-4 sm:mt-0 flex space-x-4">
                    <button
                        @click="editFlashcard(flashcard.id)"
                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Editar
                    </button>
                    <button
                        @click="deleteFlashcard(flashcard.id)"
                        class="px-4 py-2 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition-all focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                        Borrar
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        flashcards: Array,
        list: Object,
    },
    methods: {
        deleteFlashcard(flashcardId) {
            const listId = this.list.id;

            Inertia.delete(`/lists/${listId}/flashcards/${flashcardId}`, {
                onSuccess: () => {
                    this.flashcards = this.flashcards.filter(
                        (flashcard) => flashcard.id !== flashcardId
                    );
                },
                onError: (error) => {
                    console.error("Error al borrar tarjeta:", error);
                },
            });
        },
        editFlashcard(flashcardId) {
            Inertia.visit(
                `/lists/${this.list.id}/flashcards/${flashcardId}/edit`
            );
        },
    },
    mounted() {
        console.log(this.flashcards);
    },
};
</script>
