<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Kotoba" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-between selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-7xl px-6 lg:max-w-7xl">
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
                    <nav
                        v-if="canLogin"
                        class="-mx-3 flex flex-1 justify-end ml-auto pr-5"
                    >
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
                    </nav>
                </header>

                <section class="flex items-center justify-center mt-10">
                    <div class="flex w-full max-w-7xl">
                        <div class="w-1/2">
                            <img
                                :src="`/images/landing-image.jpg`"
                                alt="Kotoba"
                                class="w-full h-auto rounded-lg shadow-lg"
                            />
                        </div>

                        <div
                            class="w-1/2 pl-8 flex flex-col justify-center items-center"
                        >
                            <h1
                                class="text-4xl font-bold text-black dark:text-white mb-4"
                            >
                                K O T O B A
                            </h1>
                            <p
                                class="text-lg text-gray-700 dark:text-gray-300 mb-6"
                            >
                                Crea tus listas de vocabulario y aprende con
                                juegos.
                            </p>
                            <button
                                class="px-6 py-2 bg-[#FF2D20] text-white rounded-md shadow-md hover:bg-[#e02a1b] transition-all"
                            >
                                Iniciar sesión
                            </button>
                        </div>
                    </div>
                </section>

                <section
                    class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
                >
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center"
                    >
                        <h3
                            class="text-xl font-semibold text-[#FF2D20] dark:text-[#FF2D20] mb-3"
                        >
                            Listas de vocabulario
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            Crea tus propias listas de vocabulario por idioma y
                            nivel.
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center"
                    >
                        <h3
                            class="text-xl font-semibold text-[#FF2D20] dark:text-[#FF2D20] mb-3"
                        >
                            Flashcards
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            Repasa vocabulario con tus flashcards personalizadas
                            o usando uno de los mazos públicos.
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center"
                    >
                        <h3
                            class="text-xl font-semibold text-[#FF2D20] dark:text-[#FF2D20] mb-3"
                        >
                            Memory Game
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            Repasa vocabulario con el clásico juego de buscar
                            las parejas. ¡Encuentra las palabra y su traducción!
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-center"
                    >
                        <h3
                            class="text-xl font-semibold text-[#FF2D20] dark:text-[#FF2D20] mb-3"
                        >
                            Ordena las frases
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            Arrastra las palabras hacia su sitio correcto para
                            que la frase tenga sentido.
                        </p>
                    </div>
                </section>

                <footer
                    class="bg-white dark:bg-gray-800 rounded-t-md mt-10 py-10 text-center text-sm text-black dark:text-white/70"
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
            </div>
        </div>
    </div>
</template>
