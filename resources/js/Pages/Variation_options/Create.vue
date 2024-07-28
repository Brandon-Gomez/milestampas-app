<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import ToggleSwitch from 'primevue/toggleswitch';
import { useToast } from "primevue/usetoast";
const toast = useToast();

const showSuccess = () => {
    toast.add({ severity: 'success', summary: 'Success', detail: 'Options created successfully', life: 3000 });
};

defineProps({
    variations: {
        type: Array,
        required: true,
    },
});

const variations = usePage().props.variations.data;

const form = useForm({
    name: null,
    variations: null,
});

const createOption = () => {
    form.post(route('variationOptions.store'), {
        onSuccess: () => {
            showSuccess();
        },
    });
};

</script>

<template>
    <Toast />

    <Head title="Variations list" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Variations</h2>
        </template>

        <!-- content -->

        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createOption" enctype="multipart/form-data">
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
                                                    class="block text-sm font-medium text-gray-700">Variations</label>
                                                <MultiSelect v-model="form.variations" :options="variations"
                                                    optionValue="id" optionLabel="name" placeholder="Select variations"
                                                    class="w-full" />
                                                <InputError class="mt-2" :message="form.errors.variations" />
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('variationOptions.index')">
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
