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

            <template v-if="!$page.props.auth.user">
                <Link
                    href="/"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Home
                </Link>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Iniciar sesión
                </Link>
            </template>

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
                <button
                    v-if="$page.props.auth.user"
                    as="button"
                    @click="logout"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 dark:text-white dark:hover:text-white/80"
                >
                    Cerrar Sesión
                </button>
            </template>
        </nav>
    </header>

    <div>
        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
        >
            <h1
                class="mt-8 text-center text-2xl font-medium text-gray-900 dark:text-white"
            >
                Juegos de K O T O B A
            </h1>

            <div>
                <h2 class="text-center text-xl text-white my-5">
                    Esta página se encuentra en construcción.
                </h2>
                <img
                    class="w-3/5 rounded-md mx-auto"
                    src="/images/constructing.jpg"
                    alt="página en construcción"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/vue3";

const logout = () => {
    Inertia.post(route("logout"));
};
</script>
