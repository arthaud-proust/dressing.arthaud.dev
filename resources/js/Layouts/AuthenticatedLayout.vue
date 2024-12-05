<script setup lang="ts">
import NoLayout from '@/Layouts/NoLayout.vue';
import {
    ArrowsRightLeftIcon,
    HomeIcon,
    UserIcon,
} from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <NoLayout class="pb-14">
        <template #header>
            <slot name="header"></slot>
        </template>
        <slot />

        <template #footer>
            <div class="fixed bottom-0 left-0 z-40 w-full border-t bg-white">
                <nav
                    class="mx-auto flex h-14 w-full max-w-lg items-center text-center text-xs"
                >
                    <Link
                        :href="route('dashboard')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-0.5"
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
                        :href="route('clothing.move.index')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-0.5"
                    >
                        <div
                            class="rounded-full px-4 py-1"
                            :class="
                                route().current('clothing.move.index') &&
                                'bg-amber-500/20'
                            "
                        >
                            <ArrowsRightLeftIcon class="size-5" />
                        </div>
                        <span>Déplacer</span>
                    </Link>
                    <Link
                        :href="route('profile.edit')"
                        class="flex h-full flex-1 flex-col items-center justify-center gap-0.5"
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
