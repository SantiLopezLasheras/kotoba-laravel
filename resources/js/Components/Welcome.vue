<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <div>
        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
        >
            <ApplicationLogo class="block h-12 w-auto" />

            <h1
                class="mt-8 text-center text-2xl font-medium text-gray-900 dark:text-white"
            >
                Bienvenida al Admin Dashboard de K O T O B A
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
