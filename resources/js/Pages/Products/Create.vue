<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";

defineProps({
    categories: {
        type: Object,
    },
});

const form = useForm({
    name: "",
    image: "",
    category_id: "",
    variation_id: "",
});

const loadFile = (event) => {
    const input = event.target;
    const file = input.files[0];
    const type = file.type;
    const output = document.getElementById('preview_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
};

watch(

    () => form.category_id,
    (newValue) => {
        getVariations(newValue);
    }
);

let variations = ref({});

const getVariations = (category_id) => {
    axios.get("/api/variations?category_id=" + category_id).then((response) => {
        variations.value = response.data;
    });
};

</script>

<template>

    <Head title="Products list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
        </template>


        <!-- content -->
        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="submit">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Product Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new product.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input v-model="form.name" type="text" id="name"
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.name,
                                            }" />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id"
                                            class="block text-sm font-medium text-gray-700">Category</label>
                                        <select v-model="form.category_id" id="category_id"
                                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.class_id,
                                            }">
                                            <option value="">
                                                Select a Category
                                            </option>
                                            <option v-for="item in categories.data" :key="item.id" :value="item.id">
                                                {{ item.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.category_id" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <div class="flex items-center space-x-6">
                                            <div class="shrink-0">
                                                <img id='preview_img' class="object-cover w-16 h-16 rounded"
                                                    src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                    alt="Current product photo" />
                                            </div>
                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input type="file" @change="loadFile"
                                                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 " />
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="description"
                                            class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="form.description" id="description" cols="10" rows="3"></textarea>

                                        <InputError class="mt-2" :message="form.errors.description" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="variation_id"
                                            class="block text-sm font-medium text-gray-700">Section</label>
                                        <select v-model="form.variation_id" id="variation_id"
                                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.section_id,
                                            }">
                                            <option value="">
                                                Select a Variation
                                            </option>
                                            <option v-for="variation in variations.data" :value="variation.id">
                                                {{ variation.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.variation_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('products.index')"
                                    class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                                </Link>
                                <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--  -->


    </AuthenticatedLayout>
</template>
