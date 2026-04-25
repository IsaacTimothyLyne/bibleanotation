<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3'
import { update as resetPassword } from '@/routes/password'
import { login } from '@/routes'

const props = defineProps<{
    email: string
    token: string
}>()

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const submit = (): void => {
    form.submit(resetPassword())
}
</script>

<template>
    <div class="min-h-screen bg-stone-50 px-4 py-10 text-stone-900 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-semibold tracking-tight">Choose a new password</h1>
                <p class="mt-1 text-sm text-stone-500">Enter your new password to regain access.</p>
            </div>

            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                <form class="space-y-4" @submit.prevent="submit">
                    <input v-model="form.token" type="hidden">

                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-700">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            autocomplete="email"
                            required
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-700">New password</label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            autocomplete="new-password"
                            required
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-stone-700">Confirm password</label>
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            required
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                    >
                        {{ form.processing ? 'Resetting...' : 'Reset password' }}
                    </button>
                </form>

                <p class="mt-5 text-center text-sm text-stone-600">
                    <Link :href="login.url()" class="font-medium text-stone-900 hover:text-stone-700">Back to sign in</Link>
                </p>
            </div>
        </div>
    </div>
</template>
