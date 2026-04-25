<script setup lang="ts">
import { useForm, Link } from '@inertiajs/vue3'
import { store } from '@/routes/two-factor/login'
import { login } from '@/routes'

const form = useForm({
    code: '',
    recovery_code: '',
})

const submit = (): void => {
    form.submit(store())
}
</script>

<template>
    <div class="min-h-screen bg-stone-50 px-4 py-10 text-stone-900 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-2xl font-semibold tracking-tight">Two-factor challenge</h1>
            <p class="mt-2 text-sm text-stone-600">
                Enter your authentication code or a recovery code to continue.
            </p>

            <form class="mt-5 space-y-4" @submit.prevent="submit">
                <div>
                    <label for="code" class="block text-sm font-medium text-stone-700">Authenticator code</label>
                    <input
                        id="code"
                        v-model="form.code"
                        type="text"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                    >
                </div>

                <div>
                    <label for="recovery_code" class="block text-sm font-medium text-stone-700">Recovery code</label>
                    <input
                        id="recovery_code"
                        v-model="form.recovery_code"
                        type="text"
                        class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                    >
                    <p v-if="form.errors.code || form.errors.recovery_code" class="mt-1 text-sm text-red-600">
                        {{ form.errors.code || form.errors.recovery_code }}
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                >
                    {{ form.processing ? 'Verifying...' : 'Verify and continue' }}
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-stone-600">
                Entered this by mistake?
                <Link :href="login.url()" class="font-medium text-stone-900 hover:text-stone-700">Back to login</Link>
            </p>
        </div>
    </div>
</template>
