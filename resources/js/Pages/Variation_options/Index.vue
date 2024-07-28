<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
    variationOptions: {
        type: Object,
        required: true,
    },
});

const deletForm = useForm({});
const deleteVariation = (variationOptionId) => {
    if (confirm('Are you sure you want to delete this option?')) {
        deletForm.delete(route('variationOptions.destroy', variationOptionId));
    }
}

</script>

<template>

    <Head title="Variation Options" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Variation Options</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="py-10 bg-gray-100">
                        <div class="mx-auto max-w-7xl">
                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="sm:flex sm:items-center">
                                    <div class="sm:flex-auto">
                                        <h1 class="text-xl font-semibold text-gray-900">
                                            Variation Options List
                                        </h1>
                                        <p class="mt-2 text-sm text-gray-700">
                                            A list of all the variation options.
                                        </p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

                                        <Button style="margin-left: 1rem;" severity="primary">
                                            <Link :href="route('variationOptions.create')">
                                            Add variationOptions
                                            </Link>
                                        </Button>
                                    </div>

                                </div>
                                <div class="card">
                                    <DataTable :value="variationOptions.data" paginator :rows="5"
                                        tableStyle="min-width: 1rem;margin-top:2rem">
                                        <Column field="id" header="ID"></Column>
                                        <Column field="name" header="Option name"></Column>
                                        <Column field="variation.name" header="Variation name"></Column>
                                        <Column header="Actions" style="width: 10%">
                                            <template #body="variationOptions">
                                                <div class="flex justify-start gap-5">
                                                    <Link :href="route('variationOptions.edit', variationOptions.data)"
                                                        class="text-green-600 hover:text-green-900">
                                                    <i class="pi pi-pencil" style="font-size: 1rem"></i>
                                                    </Link>

                                                    <button @click="deleteVariation(variationOptions.data.id)"
                                                        class="text-red-600 hover:text-red-900">
                                                        <i class="pi pi-trash" style="font-size: 1rem"></i>
                                                    </button>
                                                </div>
                                            </template>
                                        </Column>
                                    </DataTable>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
