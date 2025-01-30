<template>
    <div
        class="min-h-screen bg-gray-50 dark:bg-black flex flex-col items-center justify-center"
    >
        <div class="text-center">
            <h1
                class="text-3xl font-bold text-[#FF2D20] dark:text-[#FF2D20] mb-4"
            >
                ¡Vaya, todavía no hemos terminado de construir esta página!
            </h1>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                Vuelve un poco más tarde.
            </p>

            <img
                src="/images/constructing.jpg"
                alt="Página en construcción"
                class="mt-6 w-64 h-auto mx-auto"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "PageUnderConstruction",
};
</script>
