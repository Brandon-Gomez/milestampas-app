<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import ToggleSwitch from 'primevue/toggleswitch';

defineProps({
    variation: {
        type: Object,
        required: true,
    },
});

const variation = usePage().props.variation;

const form = useForm({
    name: variation.name,
    description: variation.description,
});
const updateVariation = () => {
    form.post(route("variations.update",
        { _method: "PUT", variation: variation.id }
    ))
};
</script>

<template>

    <Head title="Variations list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Variation</h2>
        </template>

        <!-- content -->

        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateVariation" enctype="multipart/form-data">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Variation Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new variation.
                                    </p>
                                </div>

                                <div class="flex">
                                    <!-- Sección de inputs -->
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
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Description</label>
                                                <Textarea class="w-full" v-model="form.description" rows="5" cols="30"
                                                    id="description" />
                                                <InputError class="mt-2" :message="form.errors.description" />
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('variations.index')">
                                <Button class="mr-4" label="Cancel" severity="secondary" outlined />
                                </Link>

                                <Button type="submit" label="Save" />
                            </div>
                        </div>
                    </form>

                    <!-- tabs -->
                    <!-- <Tabs value="1">
                            <TabList>
                                <Tab class="capitalize" v-for="variation in variations"
                                    :value="variation.id.toString()">
                                    {{ variation.name }}
                                </Tab>
                                <Tab>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </Tab>
                            </TabList>
                            <TabPanels>
                                <TabPanel v-for="variation in variations" :value="variation.id.toString()">
                                    <p class="m-0 ">

                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Variation
                                            option</label>
                                        <MultiSelect v-model="objvariations[variation.id].options"
                                            :options="variation.variation_options" optionValue="id" optionLabel="name"
                                            placeholder="Select options" />
                                    </div>
                                    <div class="my-3">
                                        <label class="block text-sm font-medium text-gray-700">Price</label>
                                        <InputNumber v-model="objvariations[variation.id].price" :minFractionDigits="2"
                                            :maxFractionDigits="2" />
                                    </div>

                                    <div class="flex items-center space-x-6">
                                        <div class="shrink-0">
                                            <div v-if="objvariations[[variation.id]].file">
                                                <img :src="previewVariationImage(variation.id)"
                                                    class="object-cover w-16 h-16 rounded" alt="Preview">
                                            </div>
                                            <div v-else>
                                                <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                    class="object-cover w-16 h-16 rounded" alt="Preview">
                                            </div>
                                        </div>

                                        <label class="block">
                                            <input type="file" @change="updateFileModel($event, variation.id)"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-500 hover:file:bg-green-100" />
                                        </label>
                                    </div>
                                    </p>
                                </TabPanel>
                                <TabPanel>

                                    <Select v-model="form.category_id" :options="categories.data" optionValue="id"
                                        optionLabel="name" placeholder="Select a category" class="w-full" />
                                </TabPanel>
                            </TabPanels>
                        </Tabs> -->
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
