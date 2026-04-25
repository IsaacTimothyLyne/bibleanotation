<script setup lang="ts">
import { useForm, usePage, Link } from '@inertiajs/vue3'
import { send } from '@/routes/verification'
import { logout } from '@/routes'

const page = usePage<{ status?: string }>()
const resendForm = useForm({})

const resend = (): void => {
    resendForm.submit(send())
}
</script>

<template>
    <div class="min-h-screen bg-stone-50 px-4 py-10 text-stone-900 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md rounded-2xl border border-stone-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-2xl font-semibold tracking-tight">Verify your email</h1>
            <p class="mt-2 text-sm text-stone-600">
                Before continuing, please verify your email by clicking the link we just sent you.
            </p>

            <p v-if="page.props.status" class="mt-4 rounded-lg bg-emerald-50 px-3 py-2 text-sm text-emerald-700">
                {{ page.props.status }}
            </p>

            <form class="mt-5" @submit.prevent="resend">
                <button
                    type="submit"
                    :disabled="resendForm.processing"
                    class="w-full rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                >
                    {{ resendForm.processing ? 'Sending...' : 'Resend verification email' }}
                </button>
            </form>

            <Link
                :href="logout.url()"
                method="post"
                as="button"
                class="mt-3 w-full rounded-lg border border-stone-300 px-4 py-2.5 text-sm font-medium text-stone-700 hover:bg-stone-100"
            >
                Log out
            </Link>
        </div>
    </div>
</template>
