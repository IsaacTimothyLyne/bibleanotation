<script setup lang="ts">
import DiscussionPanel from '@/Components/discussionpanel.vue';
import readinglayout from '@/layouts/readinglayout.vue';
import { ref } from 'vue';

const isDiscussionPanelOpen = ref(false);

function toggleDiscussionPanel() {
    isDiscussionPanelOpen.value = !isDiscussionPanelOpen.value;
}

</script>

<template>
    <div class="mx-auto max-w-3xl">
        <div class="mb-8">
            <p class="text-sm text-stone-500">WEB Translation</p>
            <h1 class="mt-1 text-3xl font-semibold tracking-tight">
                John 1
            </h1>
        </div>

        <article class="space-y-5 text-lg leading-8 text-stone-900">
            <p class="rounded-xl p-3 hover:bg-white hover:shadow-sm">
                <sup class="mr-2 text-xs font-semibold text-stone-400">1</sup>
                In the beginning was the Word, and the Word was with God, and the Word was God.
            </p>

            <p class="rounded-xl p-3 hover:bg-white hover:shadow-sm">
                <sup class="mr-2 text-xs font-semibold text-stone-400">2</sup>
                The same was in the beginning with God.
            </p>

            <p class="rounded-xl p-3 hover:bg-white hover:shadow-sm">
                <sup class="mr-2 text-xs font-semibold text-stone-400">3</sup>
                All things were made through him. Without him, nothing was made that has been made.
            </p>
        </article>
    </div>
</template>
