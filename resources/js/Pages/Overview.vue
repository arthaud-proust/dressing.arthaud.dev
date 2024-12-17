<script setup lang="ts">
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
    ClothesCategoryOverviewDto,
    DressingColor,
    DressingDto,
    DressingOverviewDto,
} from '@/types/generated';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    categories: Array<ClothesCategoryOverviewDto>;
}>();

const sortedByClothesCountDesc = (dressings: Array<DressingOverviewDto>) =>
    dressings.toSorted(
        (a: DressingOverviewDto, b: DressingOverviewDto) =>
            b.clothesCount - a.clothesCount,
    );

const colorClasses = (dressing: DressingDto) => {
    switch (dressing.color) {
        case DressingColor.RED:
            return {
                container: 'bg-red-100 text-red-950',
                title: 'text-red-800',
            };
        case DressingColor.AMBER:
            return {
                container: 'bg-amber-100 text-amber-950',
                title: 'text-amber-800',
            };
        case DressingColor.LIME:
            return {
                container: 'bg-lime-100 text-lime-950',
                title: 'text-lime-800',
            };
        case DressingColor.EMERALD:
            return {
                container: 'bg-emerald-100 text-emerald-950',
                title: 'text-emerald-800',
            };
        case DressingColor.CYAN:
            return {
                container: 'bg-cyan-100 text-cyan-950',
                title: 'text-cyan-800',
            };
        case DressingColor.BLUE:
            return {
                container: 'bg-blue-100 text-blue-950',
                title: 'text-blue-800',
            };
        case DressingColor.VIOLET:
            return {
                container: 'bg-violet-100 text-violet-950',
                title: 'text-violet-800',
            };
        case DressingColor.FUCHSIA:
            return {
                container: 'bg-fuchsia-100 text-fuchsia-950',
                title: 'text-fuchsia-800',
            };
    }
};
</script>
<template>
    <Head :title="$t('vue_densemble')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader
                :back-to="route('dashboard')"
                :title="$t('vue_densemble')"
            />
        </template>

        <div class="my-8 grid grid-cols-1 gap-20 md:grid-cols-2">
            <article
                v-for="{ clothesCount, category, dressings } in categories"
            >
                <h2 class="mb-2 text-xl">
                    {{ category.name }} ({{ clothesCount }})
                </h2>

                <ul class="flex flex-row gap-1 py-6">
                    <li
                        v-for="(
                            { dressing, clothesCount }, index
                        ) in sortedByClothesCountDesc(dressings)"
                        class="relative"
                        :style="{ flex: clothesCount + 1 }"
                    >
                        <div
                            class="flex items-center justify-center rounded-md p-1 text-lg"
                            :class="colorClasses(dressing).container"
                        >
                            {{ clothesCount }}
                        </div>
                        <span
                            class="absolute min-w-full whitespace-nowrap p-0.5 text-center text-sm"
                            :class="[
                                {
                                    'bottom-full': index % 2 === 0,
                                    'right-0': index === dressings.length - 1,
                                },
                                colorClasses(dressing).title,
                            ]"
                        >
                            {{ dressing.name }}
                        </span>
                    </li>
                </ul>
            </article>
        </div>
    </AuthenticatedLayout>
</template>
