<script setup lang="ts">
import { ref } from 'vue';
import Discussionpanel from '@/Components/discussionpanel.vue';

const isOpen = ref(false);

</script>

<template>
  <div class="grid min-h-[calc(100vh-3.5rem)] grid-cols-1 lg:grid-cols-[280px_1fr_420px]">
    <!-- Bible Navigation -->
    <aside class="hidden border-r border-stone-200 bg-white p-4 lg:block">
      <h2 class="text-sm font-semibold text-stone-900">
        Bible
      </h2>

      <div class="mt-4 space-y-2">
        <button class="w-full rounded-lg bg-stone-100 px-3 py-2 text-left text-sm">
          Genesis
        </button>
        <button class="w-full rounded-lg px-3 py-2 text-left text-sm hover:bg-stone-100">
          Exodus
        </button>
        <button class="w-full rounded-lg px-3 py-2 text-left text-sm hover:bg-stone-100">
          John
        </button>
        <button class="w-full rounded-lg px-3 py-2 text-left text-sm hover:bg-stone-100">
          Romans
        </button>
      </div>
    </aside>

    <!-- Reading Pane -->
    <section class="min-w-0 bg-stone-50 px-6 py-8">
      <slot />
    </section>
    <Discussionpanel :isOpen="isOpen"/>
  </div>
</template>
