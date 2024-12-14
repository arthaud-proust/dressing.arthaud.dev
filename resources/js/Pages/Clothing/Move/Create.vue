<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import ClothingCard from '@/Components/Clothing/ClothingCard.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothingDto, DressingDto } from '@/types/generated';
import { ArrowRightIcon, CheckIcon } from '@heroicons/vue/24/outline';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    originDressing: DressingDto;
    destinationDressing: DressingDto;
    clothesByCategory: Record<number, Array<ClothingDto>>;
}>();

const clothesCategories = useClothesCategories();

const selectedClothesId = ref<Set<ClothingDto['id']>>(new Set());

const isSelected = (clothing: ClothingDto) =>
    selectedClothesId.value.has(clothing.id);

const toggleClothing = (clothing: ClothingDto) =>
    isSelected(clothing)
        ? selectedClothesId.value.delete(clothing.id)
        : selectedClothesId.value.add(clothing.id);

const send = () => {
    router.post(
        route('clothes.move.store', [
            props.originDressing,
            props.destinationDressing,
        ]),
        {
            clothes_id: [...selectedClothesId.value],
        },
    );
};
</script>

<template>
    <Head :title="$t('dplacer_des_vtements')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader
                :back-to="route('clothes.move.index')"
                :title="$t('dplacer_des_vtements')"
            >
                <template #title>
                    <VStretchedButton
                        :href="route('clothes.move.index')"
                        sr-text="Modifier l'origine ou la destination"
                    >
                        <div class="mt-2 flex items-center gap-2">
                            <VTag>{{ originDressing?.name ?? '?' }}</VTag>

                            <ArrowRightIcon class="size-5" />

                            <VTag>{{ destinationDressing?.name ?? '?' }}</VTag>
                        </div>
                    </VStretchedButton>
                </template>

                <VButton @click="send" :disabled="selectedClothesId.size === 0">
                    {{ $t('dplacer_n_vtements', selectedClothesId.size) }}
                </VButton>
            </VPageHeader>
        </template>

        <p class="text-sm text-neutral-500">
            {{ $t('etape_n_sur_total', { n: 3, total: 3 }) }}
        </p>
        <h3 class="text-xl">{{ $t('slectionner_les_vtements') }}</h3>

        <section
            class="mt-4"
            v-for="(clothes, categoryId) in clothesByCategory"
        >
            <h3 class="text-xl">
                {{ clothesCategories.name(categoryId) }} ({{ clothes.length }})
            </h3>
            <div class="mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8">
                <VStretchedButton
                    v-for="clothing in clothes"
                    :sr-text="$t('voir_le_dtail')"
                    @click="toggleClothing(clothing)"
                    class="w-32 shrink-0 overflow-hidden rounded-xl border-4"
                    :class="
                        isSelected(clothing)
                            ? 'border-amber-500'
                            : 'border-transparent'
                    "
                >
                    <ClothingCard :clothing="clothing" />
                    <div
                        class="absolute right-1 top-1 size-6 rounded-full border p-0.5"
                        :class="
                            isSelected(clothing)
                                ? 'border-amber-500 bg-amber-500 text-amber-100'
                                : 'border-neutral-200 bg-neutral-100'
                        "
                    >
                        <CheckIcon
                            v-if="isSelected(clothing)"
                            class="size-full"
                        />
                    </div>
                </VStretchedButton>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
