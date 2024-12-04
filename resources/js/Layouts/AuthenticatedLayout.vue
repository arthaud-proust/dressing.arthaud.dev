<script setup lang="ts">
import NoLayout from '@/Layouts/NoLayout.vue';
import { HomeIcon, PlusIcon, UserIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <NoLayout class="pb-16">
        <template #header>
            <slot name="header"></slot>
        </template>
        <slot />

        <template #footer>
            <div class="fixed bottom-0 left-0 w-full border-t bg-white">
                <nav
                    class="mx-auto flex h-16 w-full max-w-lg items-center text-xs"
                >
                    <Link
                        :href="route('dashboard')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                    >
                        <div
                            class="rounded-full px-4 py-1"
                            :class="
                                route().current('dashboard') &&
                                'bg-amber-500/20'
                            "
                        >
                            <HomeIcon class="size-5" />
                        </div>
                        <span>{{ $t('dressings') }}</span>
                    </Link>
                    <Link
                        :href="route('dashboard')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                    >
                        <div
                            class="rounded-full px-4 py-1"
                            :class="
                                route().current('dashboard') &&
                                'bg-amber-500/20'
                            "
                        >
                            <PlusIcon class="size-5" />
                        </div>
                        <span>{{ $t('ajouter') }}</span>
                    </Link>
                    <Link
                        :href="route('profile.edit')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-1"
                    >
                        <div
                            class="rounded-full px-4 py-1"
                            :class="
                                route().current('profile.edit') &&
                                'bg-amber-500/20'
                            "
                        >
                            <UserIcon class="size-5" />
                        </div>
                        <span>{{ $t('profil') }}</span>
                    </Link>
                </nav>
            </div>
        </template>
    </NoLayout>
</template>
