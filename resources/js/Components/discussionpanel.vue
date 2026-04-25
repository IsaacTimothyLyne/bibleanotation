<script setup lang="ts">

const props = defineProps<{
    isOpen: boolean;
}>();
</script>
<template>
    <aside v-if="props.isOpen" class="hidden border-l border-stone-200 bg-white p-4 xl:block">
      <div class="mb-4">
        <p class="text-xs uppercase tracking-wide text-stone-400">
          Selected
        </p>
        <h2 class="mt-1 text-lg font-semibold">
          John 1:1
        </h2>
      </div>

      <div class="space-y-3">
        <button class="w-full rounded-lg bg-stone-900 px-3 py-2 text-sm font-medium text-white">
          Add comment
        </button>

        <button class="w-full rounded-lg border border-stone-200 px-3 py-2 text-sm font-medium text-stone-700">
          Add private note
        </button>
      </div>

      <div class="mt-6 space-y-4">
        <div class="rounded-xl border border-stone-200 p-4">
          <p class="text-sm font-medium">Public discussion</p>
          <p class="mt-2 text-sm leading-6 text-stone-600">
            People are discussing the meaning of “the Word” and how this connects to creation.
          </p>
        </div>

        <div class="rounded-xl border border-stone-200 p-4">
          <p class="text-sm font-medium">Your notes</p>
          <p class="mt-2 text-sm leading-6 text-stone-600">
            No private notes yet.
          </p>
        </div>
      </div>
    </aside>\
</template>
