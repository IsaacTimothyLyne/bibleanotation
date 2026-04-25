<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { logout } from '@/routes'
import { security } from '@/routes/settings'

const page = usePage<{
  auth: {
    user: {
      id: number
      name: string
      email: string
    } | null
  }
}>()

const user = computed(() => page.props.auth?.user)

const navItems = [
  {
    label: 'Bible',
    href: '/bible',
  },
  {
    label: 'Studies',
    href: '/studies',
  },
  {
    label: 'Threads',
    href: '/threads',
  },
  {
    label: 'Notes',
    href: '/notes',
  },
]
</script>

<template>
  <div class="h-screen overflow-hidden bg-stone-50 text-stone-950">
    <div class="flex h-full">
      <!-- Left Sidebar -->
      <aside class="hidden h-full w-64 shrink-0 overflow-y-auto border-r border-stone-200 bg-white lg:flex lg:flex-col">
        <div class="border-b border-stone-200 px-5 py-4">
          <Link href="/bible" class="block">
            <h1 class="text-lg font-semibold tracking-tight">
              VerseLayer
            </h1>
            <p class="mt-1 text-xs text-stone-500">
              Scripture, notes, and discussion
            </p>
          </Link>
        </div>

        <nav class="flex-1 space-y-1 px-3 py-4">
          <Link
            v-for="item in navItems"
            :key="item.href"
            :href="item.href"
            class="block rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100 hover:text-stone-950"
          >
            {{ item.label }}
          </Link>
        </nav>

        <div class="border-t border-stone-200 px-4 py-4">
          <div v-if="user" class="text-sm">
            <p class="font-medium text-stone-900">
              {{ user.name }}
            </p>
            <Link :href="security.url()" class="text-xs text-stone-500 hover:text-stone-900">
              Security settings
            </Link>

            <Link
              :href="logout.url()"
              method="post"
              as="button"
              class="mt-2 block text-xs text-stone-500 hover:text-stone-900"
            >
              Log out
            </Link>
          </div>

          <div v-else class="flex gap-2">
            <Link
              href="/login"
              class="rounded-lg px-3 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100"
            >
              Login
            </Link>

            <Link
              href="/register"
              class="rounded-lg bg-stone-900 px-3 py-2 text-sm font-medium text-white hover:bg-stone-800"
            >
              Sign up
            </Link>
          </div>
        </div>
      </aside>

      <!-- Main Area -->
      <div class="flex h-full min-w-0 flex-1 flex-col overflow-hidden">
        <!-- Top Bar -->
        <header class="sticky top-0 z-20 border-b border-stone-200 bg-white/90 backdrop-blur">
          <div class="flex h-14 items-center justify-between px-4 lg:px-6">
            <div class="flex items-center gap-3">
              <Link href="/bible" class="lg:hidden">
                <span class="text-base font-semibold">VerseLayer</span>
              </Link>

              <div class="hidden text-sm text-stone-500 md:block">
                Read. Study. Discuss.
              </div>
            </div>

            <div class="flex items-center gap-2">
              <Link
                href="/search"
                class="rounded-lg px-3 py-2 text-sm text-stone-600 hover:bg-stone-100 hover:text-stone-950"
              >
                Search
              </Link>

              <Link
                href="/notes"
                class="rounded-lg px-3 py-2 text-sm text-stone-600 hover:bg-stone-100 hover:text-stone-950"
              >
                My Notes
              </Link>
            </div>
          </div>
        </header>

        <!-- Page Content -->
        <main class="min-w-0 flex-1 overflow-y-auto">
          <slot />
        </main>
      </div>
    </div>
  </div>
</template>
