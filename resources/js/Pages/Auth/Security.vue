<script setup lang="ts">
import { Link, router, useForm, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref } from 'vue'
import { update as updateProfile } from '@/routes/user-profile-information'
import { confirm as confirmPassword, update as updatePassword } from '@/routes/password'
import {
    enable,
    confirm as confirmTwoFactor,
    disable,
    qrCode,
    recoveryCodes,
    regenerateRecoveryCodes,
} from '@/routes/two-factor'

const page = usePage<{
    auth: {
        user: {
            name: string
            email: string
            two_factor_confirmed_at: string | null
        } | null
    }
}>()

const user = computed(() => page.props.auth.user)
const twoFactorEnabled = computed(() => !!user.value?.two_factor_confirmed_at)

const profileForm = useForm({
    name: user.value?.name ?? '',
    email: user.value?.email ?? '',
})

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})

const enableForm = useForm({})
const confirmForm = useForm({
    code: '',
})
const disableForm = useForm({})
const regenerateCodesForm = useForm({})

const qrSvg = ref<string | null>(null)
const codes = ref<string[]>([])

const refreshTwoFactorData = async (): Promise<void> => {
    const qrResponse = await fetch(qrCode.url(), {
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
        },
    })

    if (qrResponse.ok) {
        const qrData = await qrResponse.json() as { svg?: string }
        qrSvg.value = qrData.svg ?? null
    }

    const codesResponse = await fetch(recoveryCodes.url(), {
        credentials: 'same-origin',
        headers: {
            Accept: 'application/json',
        },
    })

    if (codesResponse.ok) {
        const codesData = await codesResponse.json() as string[]
        codes.value = codesData
    }
}

const submitProfile = (): void => {
    profileForm.submit(updateProfile(), {
        onSuccess: () => {
            router.reload()
        },
    })
}

const submitPassword = (): void => {
    passwordForm.submit(updatePassword(), {
        onSuccess: () => {
            passwordForm.reset()
        },
    })
}

const enableTwoFactor = (): void => {
    enableForm.submit(enable(), {
        onSuccess: async () => {
            await refreshTwoFactorData()
        },
    })
}

const confirmTwoFactorSetup = (): void => {
    confirmForm.submit(confirmTwoFactor(), {
        onSuccess: async () => {
            confirmForm.reset()
            await refreshTwoFactorData()
            router.reload()
        },
    })
}

const disableTwoFactor = (): void => {
    disableForm.submit(disable(), {
        onSuccess: () => {
            qrSvg.value = null
            codes.value = []
            router.reload()
        },
    })
}

const regenerateCodes = (): void => {
    regenerateCodesForm.submit(regenerateRecoveryCodes(), {
        onSuccess: async () => {
            await refreshTwoFactorData()
        },
    })
}

onMounted(async () => {
    if (twoFactorEnabled.value) {
        await refreshTwoFactorData()
    }
})
</script>

<template>
    <div class="mx-auto w-full max-w-4xl p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold tracking-tight">Security settings</h1>
            <p class="mt-1 text-sm text-stone-500">Manage your profile, password, and two-factor authentication.</p>
        </div>

        <div class="space-y-6">
            <section class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="text-lg font-semibold">Profile information</h2>
                <form class="mt-4 grid gap-4 sm:grid-cols-2" @submit.prevent="submitProfile">
                    <div>
                        <label for="name" class="block text-sm font-medium text-stone-700">Display name</label>
                        <input
                            id="name"
                            v-model="profileForm.name"
                            type="text"
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="profileForm.errors.name" class="mt-1 text-sm text-red-600">{{ profileForm.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-700">Email</label>
                        <input
                            id="email"
                            v-model="profileForm.email"
                            type="email"
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="profileForm.errors.email" class="mt-1 text-sm text-red-600">{{ profileForm.errors.email }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <button
                            type="submit"
                            :disabled="profileForm.processing"
                            class="rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                        >
                            {{ profileForm.processing ? 'Saving...' : 'Save profile' }}
                        </button>
                    </div>
                </form>
            </section>

            <section class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="text-lg font-semibold">Update password</h2>
                <form class="mt-4 grid gap-4 sm:grid-cols-2" @submit.prevent="submitPassword">
                    <div class="sm:col-span-2">
                        <label for="current_password" class="block text-sm font-medium text-stone-700">Current password</label>
                        <input
                            id="current_password"
                            v-model="passwordForm.current_password"
                            type="password"
                            autocomplete="current-password"
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="passwordForm.errors.current_password" class="mt-1 text-sm text-red-600">{{ passwordForm.errors.current_password }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-700">New password</label>
                        <input
                            id="password"
                            v-model="passwordForm.password"
                            type="password"
                            autocomplete="new-password"
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                        <p v-if="passwordForm.errors.password" class="mt-1 text-sm text-red-600">{{ passwordForm.errors.password }}</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-stone-700">Confirm password</label>
                        <input
                            id="password_confirmation"
                            v-model="passwordForm.password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                        >
                    </div>

                    <div class="sm:col-span-2">
                        <button
                            type="submit"
                            :disabled="passwordForm.processing"
                            class="rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                        >
                            {{ passwordForm.processing ? 'Updating...' : 'Update password' }}
                        </button>
                    </div>
                </form>
            </section>

            <section class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold">Two-factor authentication</h2>
                        <p class="mt-1 text-sm text-stone-500">
                            {{ twoFactorEnabled ? '2FA is active on your account.' : 'Add an extra security step to your login.' }}
                        </p>
                    </div>

                    <button
                        v-if="!twoFactorEnabled"
                        type="button"
                        :disabled="enableForm.processing"
                        class="rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                        @click="enableTwoFactor"
                    >
                        {{ enableForm.processing ? 'Enabling...' : 'Enable 2FA' }}
                    </button>

                    <button
                        v-else
                        type="button"
                        :disabled="disableForm.processing"
                        class="rounded-lg border border-stone-300 px-4 py-2.5 text-sm font-medium text-stone-700 hover:bg-stone-100 disabled:cursor-not-allowed disabled:text-stone-400"
                        @click="disableTwoFactor"
                    >
                        {{ disableForm.processing ? 'Disabling...' : 'Disable 2FA' }}
                    </button>
                </div>

                <div v-if="!twoFactorEnabled && qrSvg" class="mt-5 grid gap-4 lg:grid-cols-[240px_1fr]">
                    <div class="rounded-xl border border-stone-200 bg-stone-50 p-4" v-html="qrSvg" />

                    <form class="space-y-3" @submit.prevent="confirmTwoFactorSetup">
                        <p class="text-sm text-stone-600">
                            Scan this QR code with your authenticator app, then enter a 6-digit code to confirm setup.
                        </p>
                        <input
                            v-model="confirmForm.code"
                            type="text"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-stone-500 focus:outline-none focus:ring-2 focus:ring-stone-200"
                            placeholder="123456"
                        >
                        <p v-if="confirmForm.errors.code" class="text-sm text-red-600">{{ confirmForm.errors.code }}</p>

                        <button
                            type="submit"
                            :disabled="confirmForm.processing"
                            class="rounded-lg bg-stone-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800 disabled:cursor-not-allowed disabled:bg-stone-400"
                        >
                            {{ confirmForm.processing ? 'Confirming...' : 'Confirm 2FA setup' }}
                        </button>
                    </form>
                </div>

                <div v-if="codes.length" class="mt-5 rounded-xl border border-stone-200 bg-stone-50 p-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="text-sm font-semibold">Recovery codes</h3>
                        <button
                            type="button"
                            :disabled="regenerateCodesForm.processing"
                            class="rounded-lg border border-stone-300 px-3 py-2 text-xs font-medium text-stone-700 hover:bg-stone-100 disabled:cursor-not-allowed disabled:text-stone-400"
                            @click="regenerateCodes"
                        >
                            {{ regenerateCodesForm.processing ? 'Regenerating...' : 'Regenerate codes' }}
                        </button>
                    </div>

                    <ul class="mt-3 grid gap-2 text-sm text-stone-700 sm:grid-cols-2">
                        <li v-for="code in codes" :key="code" class="rounded-lg border border-stone-200 bg-white px-3 py-2 font-mono">
                            {{ code }}
                        </li>
                    </ul>
                </div>

                <p class="mt-5 text-sm text-stone-500">
                    Need password confirmation first?
                    <Link :href="confirmPassword.url()" class="font-medium text-stone-800 hover:text-stone-900">
                        Confirm password
                    </Link>
                </p>
            </section>
        </div>
    </div>
</template>
