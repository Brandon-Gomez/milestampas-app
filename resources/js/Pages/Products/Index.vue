<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
    products: {
        type: Object,
        required: true,
    },
});

const deletForm = useForm({});
const deleteProduct = (productId) => {
    if (confirm('Are you sure you want to delete this produt?')) {
        deletForm.delete(route('products.destroy', productId));
    }
}


</script>

<template>

    <Head title="Products list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
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
                                            Products List
                                        </h1>
                                        <p class="mt-2 text-sm text-gray-700">
                                            A list of all the products.
                                        </p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                        <Link :href="route('products.create')"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                        Add products
                                        </Link>
                                    </div>
                                </div>
                                <div class="card">
                                    <DataTable :value="products.data" paginator :rows="5"
                                        :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                                        <Column field="id" header="ID" style="width: 25%"></Column>
                                        <Column field="name" header="NAME" style="width: 25%"></Column>
                                        <Column field="category.name" header="CATEGORY" style="width: 25%"></Column>
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
