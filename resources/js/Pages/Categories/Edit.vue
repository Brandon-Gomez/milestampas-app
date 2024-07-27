<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import ToggleSwitch from 'primevue/toggleswitch';
import Badge from 'primevue/badge';
import { usePrimeVue } from 'primevue/config';

defineProps({
    categories: {
        type: Object,
    },
    category: {
        type: Object,
    },
});

// onmount set cards produ

let category = usePage().props.category;
// let product_options = usePage().props.product_options.data;
// onmount set cards product options
const form = useForm({
    name: category.name,
    parent_category_id: category.parent_category_id,
});

const updateCategory = () => {
    form.post(route("categories.update", {
        _method: 'patch',
        category: category.id
    }))
}

</script>

<template>

    <Head title="Categorys list" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Categories</h2>
        </template>

        <!-- content -->

        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateCategory" enctype="multipart/form-data">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Category Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to update a new product.
                                    </p>
                                </div>

                                <div class="flex">
                                    <div class="w-1/2 p-4">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                                <InputText class="w-full" type="text" v-model="form.name" id="name"
                                                    :class="{
                                                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                            form.errors.name,
                                                    }" />
                                                <InputError class="mt-2" :message="form.errors.name" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                                <Select v-model="form.parent_category_id" :options="categories.data"
                                                    optionValue="id" optionLabel="name" placeholder="Select a category"
                                                    class="w-full" />
                                                <InputError class="mt-2" :message="form.errors.parent_category_id" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('categories.index')">
                                <Button class="mr-4" label="Cancel" severity="secondary" outlined />
                                </Link>

                                <Button type="submit" label="Save" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
