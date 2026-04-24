<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import LMButton from "@/Components/LMButton.vue";

function signIn() {
    router.visit('/login');
}

function register() {
    router.visit('/register');
}
</script>
<template>
    <main class="min-h-screen bg-slate-950 text-slate-100">
        <section class="mx-auto flex max-w-4xl flex-col gap-6 px-6 py-16">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-400">
                The Living Margin
            </p>
            <p class="max-w-2xl text-slate-300">
                A Bible reading app community. Read the Bible, share your
                thoughts, see comments, studies and more down to even the word
                level. Join the community and start sharing your thoughts on the
                Bible today!
            </p>
            <div class="flex gap-4">
                <LMButton @click="signIn" :style="'primary'">Sign In</LMButton>
                <LMButton @click="register" :style="'secondary'">Register</LMButton>
            </div>
        </section>
    </main>
</template>
