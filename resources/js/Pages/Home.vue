<script setup lang="ts">

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
    </section>

    <!-- Discussion / Notes Panel -->
    <aside class="hidden border-l border-stone-200 bg-white p-4 xl:block">
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
    </aside>
  </div>
</template>
