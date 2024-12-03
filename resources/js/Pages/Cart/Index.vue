<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps, ref } from "vue";
import axios from 'axios';

const props = defineProps({
    cart: {
        type: Array,
        required: true
    }
});

const cart = ref([...props.cart]); // Hacer reactivo el array de cart

const form = useForm({
    identifier:
        Math.random().toString(36).substr(2, 9),
    name: 'camisa',
    price: '1',
    quantity: '1',
});

const submit = async () => {

    try {
        cart.value.push(form);
        const response = await axios.post(route('cart.add'), form);
    } catch (error) {
        cart.value.pop();
        console.error('Error adding item to cart:', error);
    }
};

const deleteItem = (id) => {
    alert(id);
    form.delete(route('cart.remove', id));
};

// clear cart
const clearCart = () => {
    form.get(route('cart.clear'));
};

</script>

<template>

    <Head title="Cart" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Cart</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <!-- Test crud form cart -->
                        <!-- add -->
                        <h2 class="text-xl font-semibold leading-tight text-gray-800">Add</h2>
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="name" class="block mb-2 text-sm text-gray-600">Name</label>
                                <input id="name" type="text" v-model="form.name"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block mb-2 text-sm text-gray-600">Price</label>
                                <input id="price" type="text" v-model="form.price"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="block mb-2 text-sm text-gray-600">Quantity</label>
                                <input id="quantity" type="text" v-model="form.quantity"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    required>
                            </div>

                            <div class="mb-4">
                                <button type="submit"
                                    class="w-full px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-400 focus:outline-none focus:bg-blue-400">Submit</button>
                            </div>
                        </form>


                    </div>

                    <div>
                        <h1>Carrito de Compras</h1>
                        <div v-if="cart.length">
                            <ul>
                                <li v-for="(item, index) in cart" :key="index">
                                    <p>{{ item.identifier }}</p>
                                    <p>{{ item.name }}</p>
                                    <p>{{ item.price }}</p>
                                    <p>Cantidad: {{ item.quantity }}</p>
                                    <button class="my-3 btn-secondary" @click="deleteItem(index)">Eliminar</button>
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <p>El carrito está vacío.</p>
                        </div>
                        <button class="my-3 btn-secondary" @click="clearCart">Vaciar carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
