<script setup lang="ts">
import { useForm, usePage, Link } from '@inertiajs/vue3'
import { email } from '@/routes/password'
import { login } from '@/routes'

const page = usePage<{ status?: string }>()

const form = useForm({
    email: '',
})

const submit = (): void => {
    form.submit(email())
}
</script>

<template>
    <div class="min-h-screen bg-stone-50 px-4 py-10 text-stone-900 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-semibold tracking-tight">Reset your password</h1>
                <p class="mt-1 text-sm text-stone-500">We will send a reset link to your email address.</p>
            </div>

            <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
                <p v-if="page.props.status" class="mb-4 rounded-lg bg-emerald-50 px-3 py-2 text-sm text-emerald-700">
                    {{ page.props.status }}
                </p>

                <form class="space-y-4" @submit.prevent="submit">
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

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                    >
                        {{ form.processing ? 'Sending...' : 'Email reset link' }}
                    </button>
                </form>

                <p class="mt-5 text-center text-sm text-stone-600">
                    <Link :href="login.url()" class="font-medium text-stone-900 hover:text-stone-700">Back to sign in</Link>
                </p>
            </div>
        </div>
    </div>
</template>
