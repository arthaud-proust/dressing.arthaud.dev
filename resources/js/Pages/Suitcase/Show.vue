<script setup lang="ts">
import VAlert from '@/Components/Base/VAlert.vue';
import VButton from '@/Components/Base/VButton.vue';
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import ClothingCard from '@/Components/Clothing/ClothingCard.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import {
    ClothesCountByCategoryId,
    useClothingCategoriesBalance,
} from '@/composables/useClothingCategoriesBalance';
import NoLayout from '@/Layouts/NoLayout.vue';
import {
    ClothesCategoryDto,
    ClothingDto,
    DressingDto,
} from '@/types/generated';
import {
    ArrowLeftIcon,
    ArrowRightIcon,
    CheckIcon,
    ExclamationTriangleIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline';
import { Head, Link, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<{
    originDressing: DressingDto;
    destinationDressing: DressingDto;
    clothesCountByCategoryInDestination: ClothesCountByCategoryId;
    clothesMinByCategoryInDestination: ClothesCountByCategoryId;
    clothesByCategoryAtOrigin: Record<
        ClothesCategoryDto['id'],
        Array<ClothingDto>
    >;
}>();

const clothesCategories = useClothesCategories();

const availableByCategory = computed(
    () =>
        Object.fromEntries(
            Object.entries(props.clothesByCategoryAtOrigin).map(
                ([category, clothes]) => [category, clothes.length],
            ),
        ) as ClothesCountByCategoryId,
);

const {
    computeSelectedClothesId,
    incompleteCategories,
    missingCountForCategory,
    canCategoryBeCompleted,
    toggleClothingSelection,
    isClothingSelected,
    selectedCountForCategory,
    isCategoryCompletedWithSelection,
    percentageOfMinNotDefined,
} = useClothingCategoriesBalance({
    min: props.clothesMinByCategoryInDestination,
    current: props.clothesCountByCategoryInDestination,
    available: availableByCategory,
});

const send = () => {
    router.post(
        route('clothes.move.store', [
            props.originDressing,
            props.destinationDressing,
        ]),
        {
            clothes_id: computeSelectedClothesId(),
        },
    );
};

const nextStep = () => {
    if (step.value === 'start') {
        step.value = 0;
    } else if (step.value === incompleteCategories.value.length - 1) {
        step.value = 'end';
    } else if (step.value !== 'end') {
        step.value++;
    }
};
const previousStep = () => {
    if (step.value === 'end') {
        step.value = incompleteCategories.value.length - 1;
    } else if (step.value === 0) {
        step.value = 'start';
    } else if (step.value !== 'start') {
        step.value--;
    }
};

const step = ref<'start' | number | 'end'>('start');

const stepClothingInfos = computed(() => {
    if (step.value === 'start' || step.value === 'end') {
        return null;
    }

    const category = incompleteCategories.value[step.value];
    if (!category) {
        throw new Error('undefined category');
    }

    return {
        step: step.value + 1,
        totalSteps: incompleteCategories.value.length,
        category,
        clothes: props.clothesByCategoryAtOrigin[category],
        canBeCompleted: canCategoryBeCompleted(category),
        missingCount: missingCountForCategory(category),
    };
});
</script>

<template>
    <Head :title="$t('dplacer_des_vtements')" />

    <NoLayout>
        <template #header>
            <div class="mb-4 flex text-sm">
                <button
                    v-if="step !== 'start'"
                    @click="previousStep"
                    class="-m-2 flex items-center gap-1 p-2"
                >
                    <ArrowLeftIcon class="size-4" />
                    {{ $t('prcdent') }}
                </button>
                <Link
                    :href="route('suitcase.index')"
                    class="-m-2 ml-auto flex items-center gap-1 p-2"
                >
                    <span class="sr-only">{{ $t('quitter') }}</span>
                    <XMarkIcon class="size-5" />
                </Link>
            </div>

            <template v-if="step === 'start' || step === 'end'">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $t('faire_ma_valise') }}
                </h2>

                <VStretchedButton
                    :href="route('suitcase.index')"
                    :sr-text="$t('modifier_lorigine_ou_la_destination')"
                >
                    <div class="mt-2 flex items-center gap-2">
                        <VTag>{{ originDressing.name }}</VTag>

                        <ArrowRightIcon class="size-5" />

                        <VTag>{{ destinationDressing.name }}</VTag>
                    </div>
                </VStretchedButton>
            </template>

            <template v-if="stepClothingInfos">
                <p class="text-sm text-neutral-500">
                    {{
                        $t('etape_n_sur_total', {
                            n: stepClothingInfos.step,
                            total: stepClothingInfos.totalSteps,
                        })
                    }}
                </p>
                <h3 class="text-xl">
                    {{
                        $t('slectionne_n_clothing', {
                            n: stepClothingInfos.missingCount,
                            clothing: clothesCategories
                                .name(stepClothingInfos.category)
                                .toLowerCase(),
                        })
                    }}
                </h3>
                <VAlert
                    v-if="!stepClothingInfos.canBeCompleted"
                    type="warning"
                    class="mt-2"
                >
                    <p>
                        {{
                            $t(
                                'il_ny_a_pas_assez_de_clothing_dans_ce_dressing',
                                {
                                    clothing: clothesCategories
                                        .name(stepClothingInfos.category)
                                        .toLowerCase(),
                                },
                            )
                        }}
                    </p>
                    <p class="mt-2">
                        {{
                            $t(
                                'peuttre_que_tu_nas_pas_tout_ajout_sur_lapplication',
                            )
                        }}
                    </p>
                </VAlert>
            </template>
        </template>

        <div class="mx-auto mt-auto flex w-full max-w-lg flex-col">
            <template v-if="step === 'start'">
                <VAlert
                    v-if="percentageOfMinNotDefined > 90"
                    type="info"
                    class="mb-8"
                >
                    <p>
                        {{
                            $t(
                                'tu_peux_modifier_le_minimum_de_vtement_pour_chaque',
                            )
                        }}
                    </p>
                    <VButton
                        small
                        variant="info"
                        :href="route('dressings.edit', destinationDressing)"
                        class="mt-2"
                    >
                        {{ $t('modifier') }}
                    </VButton>
                </VAlert>

                <template v-if="incompleteCategories.length">
                    <h3 class="mt-auto text-xl">
                        {{ $t('ce_quil_faut_mettre_dans_ta_valise') }}
                    </h3>

                    <ul
                        class="mt-4 list-inside list-disc space-y-2 rounded-lg bg-neutral-50 px-4 py-2"
                    >
                        <li v-for="category in incompleteCategories">
                            <span
                                :class="
                                    canCategoryBeCompleted(category) ||
                                    'font-bold text-orange-600'
                                "
                            >
                                <ExclamationTriangleIcon
                                    v-if="!canCategoryBeCompleted(category)"
                                    class="me-1 inline size-5 stroke-2 align-text-bottom"
                                />
                                <span
                                    >{{ missingCountForCategory(category) }}
                                    {{ clothesCategories.name(category) }}</span
                                >
                                <span v-if="!canCategoryBeCompleted(category)">
                                    ({{
                                        $t(
                                            'tu_nen_as_que_n',
                                            clothesByCategoryAtOrigin[category]
                                                ?.length ?? 0,
                                        )
                                    }})
                                </span>
                            </span>
                        </li>
                    </ul>

                    <VButton class="mt-4" @click="nextStep">
                        {{ $t('je_commence_ma_valise') }}
                    </VButton>
                </template>
                <template v-else>
                    <h3 class="mt-auto text-xl">
                        {{ $t('tu_as_dj_tout_ce_quil_faut_lbas') }}
                    </h3>

                    <ul
                        class="mt-4 list-inside list-disc space-y-2 rounded-lg bg-neutral-50 px-4 py-2"
                    >
                        <li
                            v-for="[category, count] in Object.entries(
                                clothesCountByCategoryInDestination,
                            )"
                        >
                            {{ count }}
                            {{
                                clothesCategories.name(
                                    Number.parseInt(category),
                                )
                            }}
                        </li>
                    </ul>

                    <VButton
                        class="mt-4"
                        :href="route('dressings.show', destinationDressing)"
                    >
                        {{ $t('voir_le_dressing') }}
                    </VButton>
                </template>
            </template>
            <template v-else-if="step === 'end'">
                <h3 class="mt-auto text-xl">
                    {{ $t('ce_quil_doit_y_avoir_dans_ta_valise') }}
                </h3>

                <ul class="ms-1 mt-2 list-inside list-disc">
                    <li v-for="category in incompleteCategories">
                        <span
                            :class="
                                canCategoryBeCompleted(category) ||
                                'font-bold text-orange-600'
                            "
                        >
                            {{ selectedCountForCategory(category) }}
                            {{ clothesCategories.name(category) }}
                        </span>
                    </li>
                </ul>

                <VButton class="mt-4" @click="send">
                    {{ $t('jai_fini_ma_valise') }}
                    <CheckIcon class="size-5" />
                </VButton>
            </template>
            <template v-else-if="stepClothingInfos">
                <div class="mt-2 grid grid-cols-2 gap-2 pb-8">
                    <VStretchedButton
                        v-for="clothing in stepClothingInfos.clothes"
                        :sr-text="$t('voir_le_dtail')"
                        @click="toggleClothingSelection(clothing)"
                        class="shrink-0 overflow-hidden rounded-xl border-4"
                        :class="
                            isClothingSelected(clothing)
                                ? 'border-amber-500'
                                : 'border-transparent'
                        "
                    >
                        <ClothingCard :clothing="clothing" />
                        <div
                            class="absolute right-1 top-1 size-6 rounded-full border p-0.5"
                            :class="
                                isClothingSelected(clothing)
                                    ? 'border-amber-500 bg-amber-500 text-amber-100'
                                    : 'border-neutral-200 bg-neutral-100'
                            "
                        >
                            <CheckIcon
                                v-if="isClothingSelected(clothing)"
                                class="size-full"
                            />
                        </div>
                    </VStretchedButton>
                </div>

                <div class="sticky bottom-0 z-20 mt-auto w-full pb-4">
                    <VButton
                        v-if="!stepClothingInfos.clothes?.length"
                        class="w-full"
                        @click="nextStep"
                    >
                        {{ $t('suivant') }}
                        <ArrowRightIcon class="size-5" />
                    </VButton>
                    <VButton
                        v-else
                        :disabled="
                            !isCategoryCompletedWithSelection(
                                stepClothingInfos.category,
                            )
                        "
                        class="w-full"
                        @click="nextStep"
                    >
                        {{ $t('cest_dans_ma_valise') }}
                        <CheckIcon class="size-5" />
                    </VButton>
                </div>
            </template>
        </div>
    </NoLayout>
</template>
