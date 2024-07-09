<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    categories: {
        type: Object,
    },
    variations: {
        type: Object
    }
});
const objvariations = ref({});

for (let index = 0; index < props.variations.length; index++) {
    const element = props.variations[index];
    objvariations.value[element.id] = {
        price: 0,
        selected: "",
        image: "",
    };
}

const form = useForm({
    name: "",
    product_image: "",
    description: "",
    category_id: "",
    price: 0,
    variations: objvariations
});

const loadFile = (event) => {
    const input = event.target;
    const file = input.files[0];
    form.product_image = file.name;
    const type = file.type;
    const output = document.getElementById('preview_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
};

let variationOptions = ref({});

watch(objvariations, (newValue) => {
    // Actualiza `form.variations` manualmente cada vez que `objvariations` cambie
    form.variations = newValue;
}, { deep: true }); // La opción { deep: true } es para observar cambios profundos dentro del objeto


const getVariationOptions = (variation_id) => {
    axios.get("/api/variationOptions?variation_id=" + variation_id).then((response) => {
        variationOptions.value = response.data;
    });
};

const createProduct = () => {
    form.post(route("products.store"))
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
                    <form @submit.prevent="createProduct">
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
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <InputText class="w-full" type="text" v-model="form.name" id="name" :class="{
                                            'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                form.errors.name,
                                        }" />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Category</label>

                                        <Select v-model="form.category_id" :options="categories.data" optionValue="id"
                                            optionLabel="name" placeholder="Select a category" class="w-full" />
                                        <InputError class="mt-2" :message="form.errors.category_id" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Price</label>
                                        <InputNumber v-model="form.price" :minFractionDigits="2"
                                            :maxFractionDigits="2" />
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
                                                <InputError class="mt-2" :message="form.errors.product_image" />


                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <Textarea class="w-full" v-model="form.description" rows="5" cols="30"
                                            id="description" />
                                        <InputError class="mt-2" :message="form.errors.description" />
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
                        <!-- tabs -->
                        <Tabs value="1">
                            <TabList>
                                <Tab class="capitalize" v-for="variation in variations"
                                    :value="variation.id.toString()">
                                    {{ variation.name }}
                                </Tab>
                            </TabList>
                            <TabPanels>
                                <TabPanel v-for="variation in variations" :value="variation.id.toString()">
                                    <p class="m-0 ">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Variation
                                            option</label>
                                        <MultiSelect v-model="objvariations[variation.id].selected"
                                            :options="variation.variation_options" optionValue="id" optionLabel="name"
                                            placeholder="Select options" />

                                        <!-- <InputError class="mt-2" :message="form.errors.variationOption_id" /> -->
                                    </div>
                                    <div class="my-3">
                                        <label class="block text-sm font-medium text-gray-700">Price</label>
                                        <InputNumber v-model="objvariations[variation.id].price" :minFractionDigits="2"
                                            :maxFractionDigits="2" />
                                    </div>
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
                                            <!-- <InputError class="mt-2" :message="form.errors.product_image" /> -->
                                        </label>
                                    </div>


                                    </p>
                                </TabPanel>
                            </TabPanels>
                        </Tabs>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
