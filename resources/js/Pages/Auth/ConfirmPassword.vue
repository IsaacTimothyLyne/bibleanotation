<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { store } from '@/routes/password/confirm'

const form = useForm({
    password: '',
})

const submit = (): void => {
    form.submit(store())
}
</script>

<template>
    <div class="min-h-screen bg-stone-50 px-4 py-10 text-stone-900 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-2xl font-semibold tracking-tight">Confirm your password</h1>
            <p class="mt-2 text-sm text-stone-600">For security, please confirm your password to continue.</p>

            <form class="mt-5 space-y-4" @submit.prevent="submit">
                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                    >
                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                >
                    {{ form.processing ? 'Confirming...' : 'Confirm password' }}
                </button>
            </form>
        </div>
    </div>
</template>
