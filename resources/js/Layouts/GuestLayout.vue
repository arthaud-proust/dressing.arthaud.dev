<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100 pt-6 sm:pt-0"
    >
        <div>
            <Link href="/" class="text-3xl font-bold">
                {{ $t('site_title') }}
            </Link>
        </div>

        <div
            class="mt-8 w-full overflow-hidden bg-white px-6 pb-4 pt-6 shadow-md sm:max-w-md sm:rounded-xl"
        >
            <slot />
        </div>
    </div>
</template>
