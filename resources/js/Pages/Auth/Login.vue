<script setup lang="ts">
import LMButton from '@/Components/LMButton.vue';
import { useForm } from '@inertiajs/vue3';
import { store } from '@/routes/login';

const form = useForm({
    email: '',
    password: '',
});

const submit = (): void => {
    form.submit(store());
};

</script>
<template>
    <!-- Log In Page -->
    <div class="min-h-screen flex items-center justify-center bg-slate-950 text-slate-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-slate-900 rounded-lg">
            <h2 class="text-2xl font-bold text-center">Log In to Your Account</h2>
            <form class="space-y-4" @submit.prevent="submit">
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        class="w-full px-3 py-2 mt-1 border border-slate-700 rounded-md bg-slate-800 text-slate-100 focus:outline-none focus:ring focus:ring-slate-600"
                    />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        class="w-full px-3 py-2 mt-1 border border-slate-700 rounded-md bg-slate-800 text-slate-100 focus:outline-none focus:ring focus:ring-slate-600"
                    />
                </div>
                <LMButton :style="'secondary'" class="w-full">Log In</LMButton>
            </form>
        </div>
    </div>
</template>
