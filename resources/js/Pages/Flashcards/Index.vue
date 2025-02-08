<template>
    <!-- Header -->
    <header
        class="bg-white dark:bg-gray-800 rounded-b-md grid grid-cols-2 items-center gap-2 py-6 lg:grid-cols-3 lg:flex lg:justify-between lg:items-center"
    >
        <div
            class="bg-white dark:bg-gray-800 grid grid-cols-2 items-center gap-2 lg:grid-cols-3"
        >
            <img
                src="/images/kotoba.png"
                alt="Kotoba"
                class="w-full md:w-1/2 h-auto rounded-md shadow-lg pl-5"
            />
        </div>

        <nav class="-mx-3 flex flex-1 justify-end ml-auto pr-5">
            <Link
                v-if="
                    $page.props.auth.user &&
                    $page.props.auth.user.role === 'admin'
                "
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
            >
                Dashboard
            </Link>

            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('lists.index')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Listas
                </Link>

                <Link
                    :href="route('games.index')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Juegos
                </Link>
                <Link
                    v-if="$page.props.auth.user"
                    as="button"
                    @click="logout"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Cerrar Sesión
                </Link>
            </template>
        </nav>
    </header>

    <!-- <header
        class="bg-white dark:bg-gray-800 grid grid-cols-2 items-center gap-2 py-6 lg:grid-cols-3 lg:flex lg:justify-between lg:items-center"
    >
        <div
            class="bg-white dark:bg-gray-800 grid grid-cols-2 items-center gap-2 lg:grid-cols-3"
        >
            <img
                src="/images/kotoba.png"
                alt="Kotoba"
                class="w-full md:w-1/2 h-auto rounded-md shadow-lg pl-5"
            />
        </div>

        <template v-if="$page.props.auth.user">
            <Link
                :href="route('lists.index')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Listas
            </Link>

            <Link
                :href="route('games.index')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Juegos
            </Link>
            <Link
                v-if="$page.props.auth.user"
                as="button"
                @click="logout"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Cerrar Sesión
            </Link>
        </template>
    </header> -->

    <div class="max-w-7xl mx-auto py-10">
        <h1
            class="text-3xl font-semibold text-gray-800 dark:text-gray mb-8 text-center"
        >
            {{ list.nombre }}
        </h1>

        <div class="flex gap-2">
            <button
                @click="createNewTarjeta(list)"
                class="flex gap-2 items-center px-4 py-2 mb-5 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 transition-all focus:outline-none focus:ring-2 focus:ring-green-500"
            >
                <span>Añadir tarjeta</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="currentColor"
                        d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z"
                    />
                </svg>
            </button>
            <div class="flex gap-2">
                <button
                    @click="toggleViewMode('list')"
                    class="flex gap-2 items-center px-4 py-2 mb-5 bg-purple-400 text-white rounded-md text-sm hover:bg-purple-500 transition-all"
                >
                    <span>Lista</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                    >
                        <g
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        >
                            <path
                                stroke-dasharray="2"
                                stroke-dashoffset="2"
                                d="M4 5h0.01"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    dur="0.1s"
                                    values="2;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="14"
                                stroke-dashoffset="14"
                                d="M8 5h12"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.1s"
                                    dur="0.2s"
                                    values="14;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="2"
                                stroke-dashoffset="2"
                                d="M4 10h0.01"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.3s"
                                    dur="0.1s"
                                    values="2;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="14"
                                stroke-dashoffset="14"
                                d="M8 10h12"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.4s"
                                    dur="0.2s"
                                    values="14;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="2"
                                stroke-dashoffset="2"
                                d="M4 15h0.01"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.6s"
                                    dur="0.1s"
                                    values="2;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="14"
                                stroke-dashoffset="14"
                                d="M8 15h12"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.7s"
                                    dur="0.2s"
                                    values="14;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="2"
                                stroke-dashoffset="2"
                                d="M4 20h0.01"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="0.9s"
                                    dur="0.1s"
                                    values="2;0"
                                />
                            </path>
                            <path
                                stroke-dasharray="14"
                                stroke-dashoffset="14"
                                d="M8 20h12"
                            >
                                <animate
                                    fill="freeze"
                                    attributeName="stroke-dashoffset"
                                    begin="1s"
                                    dur="0.2s"
                                    values="14;0"
                                />
                            </path>
                        </g>
                    </svg>
                </button>
                <button
                    @click="toggleViewMode('grid')"
                    class="flex gap-2 items-center px-4 py-2 mb-5 bg-purple-400 text-white rounded-md text-sm hover:bg-purple-500 transition-all0"
                >
                    <span>Cuadrícula</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 48 48"
                    >
                        <g
                            fill="none"
                            stroke="currentColor"
                            stroke-linejoin="round"
                            stroke-width="4"
                        >
                            <path
                                d="M42 8H6a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h36a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2Z"
                            />
                            <path d="M36 16h-8v8h8z" />
                            <path
                                stroke-linecap="round"
                                d="M12 32h24M12 16h6m-6 8h6"
                            />
                        </g>
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="viewMode === 'list'">
            <div class="flex space-x-6">
                <!-- Panel izquierdo -->
                <div class="w-2/5">
                    <ul class="space-y-4">
                        <li
                            v-for="flashcard in flashcards"
                            :key="flashcard.id"
                            class="flex flex-col sm:flex-row items-center justify-between px-3 py-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:scale-105 transition-all duration-300 transform cursor-pointer"
                            @click="selectFlashcard(flashcard)"
                        >
                            <div
                                class="flex flex-col sm:flex-row sm:space-x-4 w-full sm:w-auto"
                            >
                                <span
                                    class="text-xl font-semibold text-gray-800 dark:text-white"
                                    >{{ flashcard.palabra }}</span
                                >
                                <p
                                    class="text-sm text-gray-500 dark:text-gray-300"
                                >
                                    {{ flashcard.traduccion }}
                                </p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex space-x-4">
                                <button
                                    @click="editFlashcard(flashcard, $event)"
                                    class="px-2 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    Editar
                                </button>

                                <button
                                    @click="deleteFlashcard(flashcard.id)"
                                    class="px-2 py-1 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition-all focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    Borrar
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Panel derecho -->
                <div class="w-3/5">
                    <div
                        v-if="!selectedFlashcard && !isEditing"
                        class="mx-auto text-center rounded-md bg-purple-300"
                    >
                        <h2 class="text-2xl font-bold pt-5">
                            Nada que mostrar todavía
                        </h2>
                        <p>Selecciona una tarjeta para ver los detalles</p>
                        <img
                            class="w-2/5 mx-auto py-5"
                            src="/images/not-found-1024x1024.png"
                            alt="no hay nada que mostrar"
                        />
                    </div>

                    <div
                        v-if="!isEditing && selectedFlashcard"
                        class="max-w-md mx-auto bg-white text-gray-800 dark:bg-purple-300 p-6 rounded-lg shadow-lg"
                    >
                        <h2 class="text-2xl font-bold text-center mb-5">
                            {{ selectedFlashcard.palabra }}
                        </h2>

                        <p class="font-semibold italic text-right">
                            {{ selectedFlashcard.cat_gramatical }}
                        </p>
                        <p
                            v-if="selectedFlashcard.pronunciacion"
                            class="text-right italic"
                        >
                            /{{ selectedFlashcard.pronunciacion }}
                            /
                        </p>

                        <hr class="my-4 border-gray-300 dark:border-gray-600" />
                        <p class="font-bold">
                            {{ selectedFlashcard.traduccion }}
                        </p>
                        <p class="italic">
                            {{ selectedFlashcard.frase_ejemplo }}
                        </p>
                    </div>

                    <div v-if="isEditing">
                        <form
                            @submit.prevent="updateFlashcard"
                            class="bg-purple-300 p-3 rounded-md"
                        >
                            <div class="mb-4">
                                <label class="block text-sm font-semibold"
                                    >Palabra</label
                                >
                                <input
                                    type="text"
                                    v-model="updatedFlashcard.palabra"
                                    class="w-full p-2 border rounded-md"
                                />
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold"
                                    >Categoría Gramatical</label
                                >
                                <input
                                    type="text"
                                    v-model="updatedFlashcard.cat_gramatical"
                                    class="w-full p-2 border rounded-md"
                                />
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold"
                                    >Pronunciación</label
                                >
                                <input
                                    type="text"
                                    v-model="updatedFlashcard.pronunciacion"
                                    class="w-full p-2 border rounded-md"
                                />
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold"
                                    >Traducción</label
                                >
                                <input
                                    type="text"
                                    v-model="updatedFlashcard.traduccion"
                                    class="w-full p-2 border rounded-md"
                                />
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold"
                                    >Frase Ejemplo</label
                                >
                                <input
                                    type="text"
                                    v-model="updatedFlashcard.frase_ejemplo"
                                    class="w-full p-2 border rounded-md"
                                />
                            </div>
                            <button
                                type="submit"
                                class="mr-3 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                            >
                                Guardar
                            </button>
                            <button
                                @click="isEditing = false"
                                class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                            >
                                Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="viewMode === 'grid'">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div
                    v-for="flashcard in flashcards"
                    :key="flashcard.id"
                    class="bg-white text-gray-800 dark:bg-purple-300 p-6 rounded-lg shadow-lg hover:scale-105 transition-all duration-300 transform cursor-pointer"
                    @click="selectFlashcard(flashcard)"
                >
                    <h2 class="text-2xl font-bold text-center mb-5">
                        {{ flashcard.palabra }}
                    </h2>

                    <p class="font-semibold italic text-right">
                        {{ flashcard.cat_gramatical }}
                    </p>
                    <p v-if="flashcard.pronunciacion" class="text-right italic">
                        /{{ flashcard.pronunciacion }} /
                    </p>

                    <hr class="my-4 border-gray-300 dark:border-gray-600" />
                    <p class="font-bold">
                        {{ flashcard.traduccion }}
                    </p>
                    <p class="italic">
                        {{ flashcard.frase_ejemplo }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer
        class="bg-white dark:bg-gray-800 mt-10 py-10 text-center text-sm text-black dark:text-white/70"
    >
        <div class="flex justify-center gap-5 items-center">
            <p>K O T O B A</p>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 2048 2048"
            >
                <path
                    fill="currentColor"
                    d="m601 1152l295 886v10H765l-86-256H345l-86 256H128v-10l295-886zm36 512l-125-374l-125 374zM893 512q3 65 3 128v64q0 32-2 64H768v128H523l10 64q5 32 14 64H418q-8-32-12-64t-9-64H188q20 36 46 68t57 60h-35l-45 90q-101-91-156-214T0 640q0-88 23-170t64-153t100-129T317 88t153-65T640 0t170 23t153 64t129 100t100 130t65 153t23 170q0 32-3 64t-10 64h-124q17-65 17-128t-17-128zM640 120q-19 0-34 16t-28 41t-22 56t-15 60t-11 54t-6 37h231q-2-11-6-35t-10-54t-16-60t-22-56t-28-42t-33-17M387 768q-3-64-3-128q0-63 3-128H137q-17 65-17 128t17 128zm11-384q6-58 18-116t34-112q-83 33-150 91T188 384zm369 384q3-64 3-128q0-63-3-128H513q-3 65-3 128q0 64 3 128zm58-613q23 54 36 112t20 117h211q-45-78-113-137t-154-92m566 734q0-30-1-61t-8-60q69 0 137 6q6 1 12 3t7 10q0 5-3 12t-5 12q-2 6-3 16t-2 21t-1 22t0 17v13h296q42 0 83-1t84-2q7 0 13 3q3 5 3 10q-1 17-2 35t-1 36v58q0 36 1 72t2 73v7q0 4-3 6q-8 2-13 2h-25q-20 0-41 1q-19 0-34-1t-17-3q-2-8-2-24t-1-36q0-33 1-68t1-52h-802v39q0 15 1 31t0 34q0 29-1 52t-3 26q-8 2-13 2H949q-11 0-13-3t-2-13q1-40 1-79t0-79v-58q0-29-1-58q0-5 2-11q8-2 13-2q42 1 83 2t84 1h275zm639 553q2 8 2 13v96q0 4-2 12q-8 2-13 2q-40-1-79-2t-79-1h-321v33q0 52 1 104t3 104v4q0 24-9 48t-29 38q-14 10-39 15t-55 8t-56 3t-44 1h-19q-13 0-18-6q-3-3-7-16t-6-18q-7-26-16-48t-24-46q34 4 68 5t68 2q24 0 36-7t13-34v-190h-319q-40 0-80 1t-80 2q-8 0-12-3q-2-6-2-11v-103q0-4 3-7q6-2 11-2l80 2q40 1 80 1h319q-2-26-2-52t-6-53q20 2 39 3t40 4h3q1 0 4 1q35-25 67-53t64-57h-308q-42 0-83 1t-84 2q-8 0-12-3q-2-6-2-11v-95q0-4 2-12q8-2 12-2q42 1 83 2t84 1h373q16 0 30-4t25-5q8 0 23 12t30 28t26 32t12 25q0 10-6 15t-15 10q-14 7-27 18t-25 21q-52 43-104 83t-110 78v11h321q40 0 79-1t79-2q7 0 13 3"
                />
            </svg>
        </div>
    </footer>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    flashcards: Array,
    list: Object,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const viewMode = ref("list");
const selectedFlashcard = ref(null);
const isEditing = ref(false);
const updatedFlashcard = ref({});

const toggleViewMode = (mode) => {
    viewMode.value = mode;
};

const deleteFlashcard = (flashcardId) => {
    const listId = props.list.id;

    Inertia.delete(`/lists/${listId}/flashcards/${flashcardId}`, {
        onSuccess: () => {
            props.flashcards = props.flashcards.filter(
                (flashcard) => flashcard.id !== flashcardId
            );
        },
        onError: (error) => {
            console.error("Error al borrar tarjeta:", error);
        },
    });
};

const editFlashcard = (flashcard, event) => {
    event.stopPropagation();
    selectedFlashcard.value = { ...flashcard };
    isEditing.value = true;
    updatedFlashcard.value = { ...flashcard };
};

const selectFlashcard = (flashcard) => {
    selectedFlashcard.value = flashcard;
    isEditing.value = false;
};

const createNewTarjeta = (list) => {
    Inertia.visit(`/lists/${list.id}/flashcards/create`);
};

const updateFlashcard = async () => {
    try {
        await Inertia.put(
            `/lists/${props.list.id}/flashcards/${updatedFlashcard.value.id}`,
            updatedFlashcard.value
        );
        isEditing.value = false;
    } catch (error) {
        console.error("Error al actualizar la tarjeta:", error);
    }
};

const logout = () => {
    Inertia.post(route("logout"));
};

// export default {
//     props: {
//         flashcards: Array,
//         list: Object,
//     },
//     data() {
//         return {
//             viewMode: "list",
//             selectedFlashcard: null,
//             isEditing: false,
//             updatedFlashcard: {},
//         };
//     },
//     methods: {
//         toggleViewMode(mode) {
//             this.viewMode = mode;
//         },
//         deleteFlashcard(flashcardId) {
//             const listId = this.list.id;

//             Inertia.delete(`/lists/${listId}/flashcards/${flashcardId}`, {
//                 onSuccess: () => {
//                     this.flashcards = this.flashcards.filter(
//                         (flashcard) => flashcard.id !== flashcardId
//                     );
//                 },
//                 onError: (error) => {
//                     console.error("Error al borrar tarjeta:", error);
//                 },
//             });
//         },
//         editFlashcard(flashcard, event) {
//             event.stopPropagation();
//             this.selectedFlashcard = { ...flashcard };
//             this.isEditing = true;
//             this.updatedFlashcard = { ...flashcard };
//             // Inertia.visit(
//             //     `/lists/${this.list.id}/flashcards/${flashcardId}/edit`
//             // );
//         },
//         selectFlashcard(flashcard) {
//             this.selectedFlashcard = flashcard;
//             this.isEditing = false;
//         },
//         createNewTarjeta(list) {
//             Inertia.visit(`/lists/${list.id}/flashcards/create`);
//         },
//         async updateFlashcard() {
//             try {
//                 await Inertia.put(
//                     `/lists/${this.list.id}/flashcards/${this.updatedFlashcard.id}`,
//                     this.updatedFlashcard
//                 );
//                 this.isEditing = false;
//             } catch (error) {
//                 console.error("Error al actualizar la tarjeta:", error);
//             }
//         },
//     },
// };
</script>
