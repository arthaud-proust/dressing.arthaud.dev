<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import ClothingCard from '@/Components/Clothing/ClothingCard.vue';
import ClothingDetails from '@/Components/Clothing/ClothingDetails.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothingDto, DressingDto } from '@/types/generated';
import { PencilIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    dressing: DressingDto;
    clothesByCategory: Record<number, Array<ClothingDto>>;
}>();

const selectedClothing = ref<ClothingDto | null>(null);
const clothesCategories = useClothesCategories();
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
                        <PlusIcon class="size-5" />
                        {{ $t('vtement') }}
                    </VButton>

                    <VButton
                        :href="route('dressings.edit', dressing)"
                        variant="secondary"
                    >
                        <PencilIcon class="size-5" />
                        {{ $t('modifier') }}
                    </VButton>
                </div>
            </div>
        </template>

        <section
            class="mt-4"
            v-for="(clothes, categoryId) in clothesByCategory"
        >
            <h3 class="text-xl">
                {{ clothesCategories.name(categoryId) }} ({{ clothes.length }})
            </h3>
            <div class="mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8">
                <VStretchedButton
                    class="w-32 shrink-0"
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
