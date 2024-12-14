<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import { TagIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <section class="space-y-2">
        <header>
            <h2 class="text-lg font-medium text-gray-900"> {{ $t('preferences') }}</h2>

            <p class="mt-1 text-sm text-gray-600">
               {{ $t('personnaliser_les_categories_de_vos_vetements_pour_tous_vos_dressings') }}
            </p>
        </header>
        <VButton class="w-fit" :href="route('clothes-categories.index')" variant="primary">
            <TagIcon class="size-5" />
            {{ $t('catgories') }}
        </VButton>
    </section>
</template>
