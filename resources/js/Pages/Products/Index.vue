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
const formatDate = (date) => {
    return new Date(date).toLocaleString('en-US', { day: 'numeric', month: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', hour12: false });
}
</script>

<template>

    <Head title="Products" />

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
                                        <Button label="Add product" severity="primary">
                                            <Link :href="route('products.create')">
                                            Add products
                                            </Link>
                                        </Button>
                                    </div>
                                </div>
                                <div class="card">
                                    <DataTable :value="products.data" paginator :rows="5"
                                        :rowsPerPageOptions="[5, 10, 20, 50]"
                                        tableStyle="min-width: 50rem;margin-top:2rem">
                                        <Column field="id" header="ID"></Column>
                                        <Column header="Image" style="width: 10%">
                                            <template #body="products">
                                                <img :src="`storage/products/${products.data.image}`"
                                                    :alt="products.data.image" class="w-[3.5rem] rounded shadow-md" />
                                            </template>
                                        </Column>
                                        <Column field="name" header="Name"></Column>
                                        <Column field="short_desc" header="Description"></Column>
                                        <Column field="price" header="Price"></Column>
                                        <Column field="stock" header="Stock"></Column>
                                        <Column field="unlimited" header="Unlimited"></Column>
                                        <Column field="category.name" header="Category"></Column>
                                        <Column header="Created at">
                                            <template #body="products">
                                                {{ formatDate(products.data.created_at) }}
                                            </template>
                                        </Column>
                                        <Column header="Updated at" style="width: 15%">
                                            <template #body="products">
                                                {{ formatDate(products.data.updated_at) }}
                                            </template>
                                        </Column>
                                        <Column header="Actions" style="width: 10%">
                                            <template #body="products">
                                                <div class="flex justify-start gap-5">
                                                    <Link :href="`/products/${products.data.id}/edit`"
                                                        class="text-green-600 hover:text-green-900">
                                                    <i class="pi pi-pencil" style="font-size: 1rem"></i>
                                                    </Link>
                                                    <!-- generate route and product argument -->
                                                    <button @click="deleteProduct(products.data.id)"
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
