<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    dressings: Array<DressingDto>;
}>();
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $t('dressings') }}
                </h2>
                <VButton :href="route('dressings.create')"
                    >{{ $t('creer') }}
                </VButton>
            </div>
        </template>

        <div class="mt-auto flex flex-col justify-end gap-2">
            <Link
                v-for="dressing in dressings"
                class="flex flex-col rounded-xl bg-amber-100 p-4"
                :href="route('dressings.show', { dressing })"
            >
                <span class="text-amber-950">{{ $t('dressing') }}</span>
                <span class="text-2xl text-amber-800">{{ dressing.name }}</span>
                <span class="text-amber-950">{{
                    $t('vetements', dressing.clothingCount)
                }}</span>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
