<script setup lang="ts">
import { HomeIcon, PlusIcon, UserIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="relative flex min-h-dvh flex-col pb-16">
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <div
            class="mx-auto flex h-full w-full max-w-7xl grow flex-col px-4 py-6 sm:px-6 lg:px-8"
        >
            <slot />
        </div>

        <div class="fixed bottom-0 left-0 w-full border-t bg-white">
            <nav class="mx-auto flex h-16 w-full max-w-lg items-center text-xs">
                <Link
                    :href="route('dashboard')"
                    class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                >
                    <div
                        class="rounded-full px-4 py-1"
                        :class="
                            route().current('dashboard') && 'bg-amber-500/20'
                        "
                    >
                        <HomeIcon class="size-5" />
                    </div>
                    <span>Dressings</span>
                </Link>
                <Link
                    :href="route('dashboard')"
                    class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                >
                    <div
                        class="rounded-full px-4 py-1"
                        :class="
                            route().current('dashboard') && 'bg-amber-500/20'
                        "
                    >
                        <PlusIcon class="size-5" />
                    </div>
                    <span>Ajouter</span>
                </Link>
                <Link
                    :href="route('profile.edit')"
                    class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                >
                    <div
                        class="rounded-full px-4 py-1"
                        :class="
                            route().current('profile.edit') && 'bg-amber-500/20'
                        "
                    >
                        <UserIcon class="size-5" />
                    </div>
                    <span>Profil</span>
                </Link>
            </nav>
        </div>
    </div>
</template>
