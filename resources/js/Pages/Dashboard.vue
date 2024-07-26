<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";

const fileupload = ref();

const upload = () => {
    fileupload.value.upload();
};

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
                        <Button label="Toggle Color Scheme" @click="toggleColorScheme()" />

                        <FileUpload name="file" url="/api/uploadProduct" accept="image/*" :maxFileSize="10000000"
                            :fileLimit="2">
                            <template #empty>
                                <span>Drag and drop files to here to upload.</span>
                            </template>
                        </FileUpload>
                        <!-- input texto -->
                        <input type="text" name="name" id="name"
                            class="block w-full mt-1 rounded-md shadow-sm sm:text-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300"
                            placeholder="Name" required>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
