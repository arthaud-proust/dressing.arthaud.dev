<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import ClothingCard from '@/Components/Clothing/ClothingCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothingCategory, ClothingDto, DressingDto } from '@/types/generated';
import { CheckIcon } from '@heroicons/vue/16/solid';
import { ArrowRightIcon } from '@heroicons/vue/20/solid';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    originDressing: DressingDto;
    destinationDressing: DressingDto;
    clothesByCategory: Record<ClothingCategory, Array<ClothingDto>>;
}>();

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
            <h2 class="mt-2 text-xl font-semibold leading-tight text-gray-800">
                {{ $t('dplacer_des_vtements') }}
            </h2>

            <div class="mt-2 flex items-center gap-2">
                <VTag>{{ originDressing?.name ?? '?' }}</VTag>

                <ArrowRightIcon class="size-5" />

                <VTag>{{ destinationDressing?.name ?? '?' }}</VTag>
            </div>

            <VButton class="mt-2" @click="send">
                {{ $t('dplacer_n_vtements', selectedClothesId.size) }}
            </VButton>
        </template>

        <p class="text-sm text-neutral-500">Étape 3/3</p>
        <h3 class="text-xl">Sélectionner les vêtements</h3>

        <section
            class="mt-4"
            v-for="(clothingList, category) in clothesByCategory"
        >
            <h3 class="text-xl">
                {{ $t(`clothing_category.${category}`) }} ({{
                    clothingList.length
                }})
            </h3>
            <div class="mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8">
                <VStretchedButton
                    v-for="clothing in clothingList"
                    :sr-text="$t('voir_le_dtail')"
                    @click="toggleClothing(clothing)"
                    class="shrink-0 overflow-hidden rounded-xl border-4"
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
