<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
    categories: {
        type: Object,
    },
});

// const categories = ref(categories);

const caregories = usePage().props.categories;

const deletForm = useForm({});
const deleteCategory = (categoryId) => {
    if (confirm('Are you sure you want to delete this produt?')) {
        deletForm.delete(route('categories.destroy', categoryId));
    }
}

const formatDate = (date) => {
    return new Date(date).toLocaleString('en-US', { day: 'numeric', month: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', hour12: false });
}

</script>

<template>

    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Categories</h2>
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
                                            Categories List
                                        </h1>
                                        <p class="mt-2 text-sm text-gray-700">
                                            A list of all the categories.
                                        </p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                        <Button label="Add product" severity="primary">
                                            <Link :href="route('categories.create')">
                                            Add category
                                            </Link>
                                        </Button>
                                    </div>

                                </div>
                                <div class="card">

                                    <DataTable :value="categories.data" paginator :rows="5"
                                        :rowsPerPageOptions="[5, 10, 20, 50]"
                                        tableStyle="min-width: 50rem;margin-top:2rem">
                                        <Column field="id" header="ID"></Column>
                                        <Column field="name" header="Name" style="width: 25%"></Column>
                                        <Column field="parent_category.name" header="Category parent"
                                            style="width: 25%">
                                        </Column>
                                        <Column header="Created at">
                                            <template #body="categories">
                                                {{ formatDate(categories.data.created_at) }}
                                            </template>
                                        </Column>
                                        <Column header="Updated at">
                                            <template #body="categories">
                                                {{ formatDate(categories.data.updated_at) }}
                                            </template>
                                        </Column>
                                        <Column header="Actions">
                                            <template #body="categories">
                                                <div class="flex justify-start gap-5">
                                                    <Link :href="`/categories/${categories.data.id}/edit`"
                                                        class="text-green-600 hover:text-green-900">
                                                    <i class="pi pi-pencil" style="font-size: 1rem"></i>
                                                    </Link>
                                                    <button @click="deleteCategory(categories.data.id)"
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
