<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import DressingCard from '@/Components/Dressing/DressingCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { ChartBarIcon, PlusIcon, TagIcon } from '@heroicons/vue/24/outline';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    dressings: Array<DressingDto>;
}>();
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $t('dressings') }}
                </h2>

                <div class="flex flex-wrap gap-2">
                    <VButton class="ms-auto" :href="route('dressings.create')">
                        <PlusIcon class="size-5" />
                        {{ $t('dressing') }}
                    </VButton>

                    <VButton
                        :href="route('clothes-categories.index')"
                        variant="secondary"
                    >
                        <TagIcon class="size-5" />
                        {{ $t('catgories') }}
                    </VButton>

                    <VButton :href="route('overview')" variant="tertiary">
                        <ChartBarIcon class="size-5" />
                        <span class="max-md:sr-only">{{
                            $t('vue_densemble')
                        }}</span>
                    </VButton>
                </div>
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
