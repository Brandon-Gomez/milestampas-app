<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";

const selectedCities = ref();
const cities = ref([
    { name: 'New York', id: 'NY' },
    { name: 'Rome', id: 'RM' },
    { name: 'London', id: 'LDN' },
    { name: 'Istanbul', id: 'IST' },
    { name: 'Paris', id: 'PRS' }
]);

const toggleColorScheme = () => {
    const element = document.querySelector('html');
    element.classList.toggle('my-app-dark');
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- <Button label="Toggle Color Scheme" @click="toggleColorScheme()" /> -->

                        <MultiSelect v-model="selectedCities" :options="cities" optionLabel="name"
                            placeholder="Select Cities" :maxSelectedLabels="3" class="w-full md:w-[20rem]" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
