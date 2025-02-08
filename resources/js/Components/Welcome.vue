<script setup>
import { Inertia } from "@inertiajs/inertia";
import { defineProps, ref } from "vue";
import VueApexCharts from "vue3-apexcharts";

const props = defineProps({
    estadisticas: Object,
});

const { users } = props.estadisticas;
const apexchart = VueApexCharts;
const {
    numberLists,
    numberFlashcards,
    numberUsers,
    numberLanguages,
    numberAdmins,
} = props.estadisticas;

// banear a un usuario
const deshabilitarCuenta = (userId) => {
    const user = users.find((user) => user.id === userId);
    if (user) user.is_active = !user.is_active;

    Inertia.put(`/banear/${userId}`).catch(() => {
        // si falla en la base de datos, revertir los cambios
        if (user) user.is_active = !user.is_active;
    });
};

// mostrar estadísticas de usuario
const selectedUserId = ref(null);
const selectedUser = ref(null);
const showUserInfo = (userId) => {
    selectedUserId.value = userId;
    selectedUser.value = users.find((user) => user.id === userId);
};

// Gráfico usuarios
const series = ref([numberUsers, numberAdmins]);
const chartOptions = ref({
    chart: {
        width: 380,
        type: "pie",
    },
    labels: ["Administradores", "Usuarios"],
    responsive: [
        {
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        },
    ],
});

// Gráfico estadísticas básicas
const basicData = ref([
    {
        name: "nº",
        data: [numberUsers, numberLanguages, numberLists, numberFlashcards],
    },
]);
const chartOptionsBasicData = ref({
    chart: {
        type: "bar",
        height: 350,
    },
    labels: [
        "Usuarios registrados",
        "Idiomas usados",
        "Listas creadas",
        "Flashcards creadas",
    ],
    plotOptions: {
        bar: {
            borderRadius: 4,
            borderRadiusApplication: "end",
            horizontal: true,
        },
    },
    dataLabels: {
        enabled: false,
    },
    tooltip: {
        theme: "dark",
    },
    xaxis: {
        categories: [
            "Usuarios registrados",
            "Idiomas usados",
            "Listas creadas",
            "Flashcards creadas",
        ],
    },
});
</script>

<template>
    <div>
        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-900 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white"
        >
            <h1 class="my-10 text-center text-2xl font-medium">
                Bienvenid@ al Admin Dashboard de K O T O B A
            </h1>

            <div class="flex justify-around">
                <div class="mt-5">
                    <h2 class="text-center uppercase">Usuarios registrados</h2>
                    <div id="chart" class="mt-5">
                        <apexchart
                            type="pie"
                            width="380"
                            :options="chartOptions"
                            :series="series"
                        ></apexchart>
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="text-center uppercase">
                        Estadísticas de KOTOBA
                    </h2>
                    <div id="chart" class="mt-5">
                        <apexchart
                            type="bar"
                            width="350"
                            :options="chartOptionsBasicData"
                            :series="basicData"
                        ></apexchart>
                    </div>
                </div>
            </div>

            <div
                class="mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg"
            >
                <h3 class="text-xl font-semibold text-center mb-6">Usuarios</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Usuario</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Banear</th>
                                <th class="px-4 py-2 text-left">
                                    Info Usuario
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td class="px-4 py-2">{{ user.name }}</td>
                                <td class="px-4 py-2">{{ user.email }}</td>
                                <td class="px-4 py-2">
                                    {{
                                        user.is_active
                                            ? "Habilitado"
                                            : "Deshabilitado"
                                    }}
                                </td>
                                <td class="px-4 py-2">
                                    <button
                                        @click="deshabilitarCuenta(user.id)"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md"
                                    >
                                        {{
                                            user.is_active
                                                ? "Deshabilitar"
                                                : "Habilitar"
                                        }}
                                    </button>
                                </td>
                                <td class="px-4 py-2">
                                    <button
                                        @click="showUserInfo(user.id)"
                                        class="px-4 py-2 bg-green-500 text-white rounded-md"
                                    >
                                        Info Usuario
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Información del usuario -->
            <div
                v-if="selectedUserId"
                class="mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg"
            >
                <h3 class="text-xl font-semibold text-center mb-6">
                    Información del Usuario
                </h3>
                <div class="text-center">
                    <p>
                        <strong>Fecha de Registro:</strong>
                        {{ selectedUser?.formatted_created_at }}
                    </p>
                    <p>
                        <strong>Listas Creadas:</strong>
                        {{
                            selectedUser?.lists_count
                                ? selectedUser.lists_count
                                : "No ha creado listas todavía"
                        }}
                    </p>
                    <p>
                        <strong>Número de inicios de sesión:</strong>
                        {{
                            selectedUser?.login_histories_count
                                ? selectedUser.login_histories_count
                                : "Nunca ha iniciado sesión."
                        }}
                    </p>
                    <p>
                        <strong>Último Login:</strong>
                        {{
                            selectedUser?.last_login_date
                                ? selectedUser.last_login_date
                                : "No ha iniciado sesión todavía."
                        }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
