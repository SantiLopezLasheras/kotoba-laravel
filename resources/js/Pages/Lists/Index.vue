<script>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

export default {
    setup() {
        const listaSeleccionada = ref(null);
        const editando = ref(false);
        const formData = ref({
            nombre: "",
            idioma: "",
            nivel: "",
        });

        const mostrarLista = (list) => {
            listaSeleccionada.value = list;
            editando.value = false;
        };

        const abrirLista = (list) => {
            Inertia.visit(`/lists/${list.id}`);
        };

        const createNewList = () => {
            Inertia.visit(`/lists/create`);
        };

        const deleteList = async (id) => {
            if (confirm("¿Borrar lista?")) {
                try {
                    await Inertia.delete(`/lists/${id}`);
                } catch (error) {
                    console.error("Error al eliminar la lista:", error);
                }
            }
        };

        const editarLista = (list) => {
            formData.value = { ...list };
            listaSeleccionada.value = list;
            editando.value = true;
            // Inertia.visit(`/lists/${id}/edit`);
        };

        // guardar los cambios
        const guardarLista = async () => {
            try {
                await Inertia.put(
                    `/lists/${listaSeleccionada.value.id}`,
                    formData.value
                );
                const updatedList = {
                    ...listaSeleccionada.value,
                    ...formData.value,
                };
                const index = lists.findIndex(
                    (list) => list.id === updatedList.id
                );
                if (index !== -1) {
                    lists[index] = updatedList;
                }
                editando.value = false;
            } catch (error) {
                console.error("Error al actualizar la lista:", error);
            }
        };

        const cancelEdit = () => {
            editando.value = false;
            formData.value = { ...listaSeleccionada.value };
        };

        return {
            listaSeleccionada,
            mostrarLista,
            createNewList,
            deleteList,
            editarLista,
            cancelEdit,
            editando,
            formData,
            guardarLista,
            abrirLista,
        };
    },
    props: {
        lists: Array,
    },
};
</script>

<template>
    <!-- Header -->
    <header
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
        <!-- <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end ml-auto pr-5">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </Link>

            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('lists.index')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Listas
                </Link>

                <Link
                    :href="route('games.index')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Juegos
                </Link>
            </template>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Iniciar sesión
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Registrarse
                </Link>
            </template>
        </nav> -->
    </header>

    <div class="max-w-7xl mx-auto py-10">
        <h1
            class="text-center mb-10 text-3xl font-semibold text-gray-800 dark:text-gray-700"
        >
            Listas de vocabulario
        </h1>
        <button
            @click="createNewList"
            class="flex gap-2 items-center px-4 py-2 mb-5 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 transition-all focus:outline-none focus:ring-2 focus:ring-green-500"
        >
            <span>Crear nueva lista</span>
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

        <div class="flex space-x-8">
            <div class="w-3/5">
                <ul class="space-y-4">
                    <li
                        v-for="list in lists"
                        :key="list.id"
                        class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow"
                    >
                        <span
                            class="text-md mr-2 text-gray-800 dark:text-white"
                            >{{ list.nombre }}</span
                        >

                        <div class="space-x-3">
                            <button
                                @click="abrirLista(list)"
                                class="px-3 py-1 bg-orange-600 text-white rounded-md text-sm hover:bg-orange-700 transition-all focus:outline-none focus:ring-2 focus:ring-gray-500"
                            >
                                Abrir lista
                            </button>
                            <button
                                @click="mostrarLista(list)"
                                class="px-3 py-1 bg-yellow-600 text-white rounded-md text-sm hover:bg-yellow-700 transition-all focus:outline-none focus:ring-2 focus:ring-gray-500"
                            >
                                Ver detalles
                            </button>
                            <button
                                @click="editarLista(list)"
                                class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                Editar
                            </button>

                            <button
                                @click="deleteList(list.id)"
                                class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition-all focus:outline-none focus:ring-2 focus:ring-red-500"
                            >
                                Borrar
                            </button>
                        </div>
                    </li>
                </ul>
            </div>

            <div
                v-if="!editando && !listaSeleccionada"
                class="w-2/5 text-center rounded-md bg-purple-300"
            >
                <h2 class="text-2xl font-bold p-5">Nada que mostrar todavía</h2>
                <p>Selecciona una lista para ver los detalles</p>
                <img
                    class="w-2/5 mx-auto mt-10 rounded-md"
                    src="/images/not-found-1024x1024.png"
                    alt="no hay nada que mostrar"
                />
            </div>
            <div
                v-if="!editando && listaSeleccionada"
                class="w-2/5 text-center rounded-md bg-purple-300"
            >
                <h2 class="text-2xl font-bold p-5">
                    {{ listaSeleccionada.nombre }}
                </h2>
                <hr class="" />
                <img
                    src="/images/flashcards.jpg"
                    alt="study flashcards"
                    class="w-1/2 p-5 mx-auto"
                />
                <p><strong>Idioma:</strong> {{ listaSeleccionada.idioma }}</p>
                <p><strong>Nivel:</strong> {{ listaSeleccionada.nivel }}</p>
            </div>

            <div v-if="editando" class="w-2/5 rounded-md bg-purple-300">
                <h2 class="text-center text-2xl font-bold p-5">Editar Lista</h2>
                <hr />
                <form @submit.prevent="guardarLista">
                    <div class="mb-4 mt-4">
                        <label
                            for="nombre"
                            class="text-center block text-sm font-medium"
                            >Nombre</label
                        >
                        <input
                            type="text"
                            id="nombre"
                            v-model="formData.nombre"
                            class="mt-1 block w-4/5 mx-auto p-2 border border-gray-300 rounded-md"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="idioma"
                            class="text-center block text-sm font-medium"
                            >Idioma</label
                        >
                        <input
                            type="text"
                            id="idioma"
                            v-model="formData.idioma"
                            class="mt-1 block w-4/5 mx-auto p-2 border border-gray-300 rounded-md"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="nivel"
                            class="text-center block text-sm font-medium"
                            >Nivel</label
                        >
                        <input
                            type="text"
                            id="nivel"
                            v-model="formData.nivel"
                            class="mt-1 block w-4/5 mx-auto p-2 border border-gray-300 rounded-md"
                            required
                        />
                    </div>
                    <div class="flex justify-center space-x-4 mb-5">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-all"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            @click="cancelEdit"
                            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-all"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
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
