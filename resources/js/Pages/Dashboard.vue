<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import DressingCard from '@/Components/Dressing/DressingCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

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
            <VStretchedButton
                v-for="dressing in dressings"
                :sr-text="dressing.name"
                :href="route('dressings.show', { dressing })"
            >
                <DressingCard :dressing="dressing" />
            </VStretchedButton>
        </div>
    </AuthenticatedLayout>
</template>
