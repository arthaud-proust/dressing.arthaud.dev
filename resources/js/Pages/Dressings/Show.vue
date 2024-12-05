<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import ClothingCard from '@/Components/Clothing/ClothingCard.vue';
import ClothingDetails from '@/Components/Clothing/ClothingDetails.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothingCategory, ClothingDto, DressingDto } from '@/types/generated';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    dressing: DressingDto;
    clothesByCategory: Record<ClothingCategory, Array<ClothingDto>>;
}>();

const selectedClothing = ref<ClothingDto | null>(null);
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $t('dressing_name', { name: dressing.name }) }}
                </h2>

                <div class="flex flex-wrap gap-2">
                    <VButton
                        :href="route('dressings.clothes.create', dressing)"
                    >
                        {{ $t('ajouter_un_vtement') }}
                    </VButton>

                    <VButton
                        :href="route('dressings.edit', dressing)"
                        variant="secondary"
                    >
                        {{ $t('modifier') }}
                    </VButton>
                </div>
            </div>
        </template>

        <section class="mt-4" v-for="(clothes, category) in clothesByCategory">
            <h3 class="text-xl">
                {{ $t(`clothing_category.${category}`) }} ({{ clothes.length }})
            </h3>
            <div class="mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8">
                <VStretchedButton
                    v-for="clothing in clothes"
                    :sr-text="$t('voir_le_dtail')"
                    @click="selectedClothing = clothing"
                >
                    <ClothingCard :clothing="clothing" />
                </VStretchedButton>
            </div>
        </section>
        <ClothingDetails
            v-if="selectedClothing"
            :clothing="selectedClothing"
            @close="selectedClothing = null"
        />
    </AuthenticatedLayout>
</template>
