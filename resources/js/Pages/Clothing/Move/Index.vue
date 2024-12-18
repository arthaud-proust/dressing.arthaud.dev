<script setup lang="ts">
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import DressingCard from '@/Components/Dressing/DressingCard.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<{
    dressings: Array<DressingDto>;
}>();

const originDressings = computed(() =>
    props.dressings.filter((dressing) => dressing.clothesCount > 0),
);

const destinationDressings = computed(() =>
    props.dressings.filter(
        (dressing) => dressing.id !== originDressing.value?.id,
    ),
);

const originDressing = ref<DressingDto | null>(null);
const destinationDressing = ref<DressingDto | null>(null);

const selectOrigin = (dressing: DressingDto) =>
    (originDressing.value = dressing);
const selectDestination = (dressing: DressingDto) => {
    destinationDressing.value = dressing;
    router.visit(
        route('clothes.move.create', [
            originDressing.value,
            destinationDressing.value,
        ]),
    );
};
</script>

<template>
    <Head :title="$t('dplacer_des_vtements')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader :title="$t('dplacer_des_vtements')">
                <template #title>
                    <VStretchedButton
                        @click="originDressing = null"
                        sr-text="Modifier l'origine ou la destination"
                    >
                        <div class="mt-2 flex items-center gap-2">
                            <VTag>{{ originDressing?.name ?? '?' }}</VTag>

                            <ArrowRightIcon class="size-5" />

                            <VTag>{{ destinationDressing?.name ?? '?' }}</VTag>
                        </div>
                    </VStretchedButton>
                </template>
            </VPageHeader>
        </template>

        <div class="mx-auto mt-auto w-full max-w-lg">
            <template v-if="!originDressing">
                <p class="text-sm text-neutral-500">
                    {{ $t('etape_n_sur_total', { n: 1, total: 3 }) }}
                </p>
                <h3 class="text-xl">{{ $t('dressing_dorigine') }}</h3>

                <div class="mt-4 flex flex-col justify-end gap-2">
                    <VStretchedButton
                        v-for="dressing in originDressings"
                        :sr-text="dressing.name"
                        @click="selectOrigin(dressing)"
                    >
                        <DressingCard :dressing="dressing" />
                    </VStretchedButton>
                </div>
            </template>
            <template v-else>
                <p class="text-sm text-neutral-500">
                    {{ $t('etape_n_sur_total', { n: 2, total: 3 }) }}
                </p>
                <h3 class="text-xl">{{ $t('dressing_de_destination') }}</h3>

                <div class="mt-4 flex flex-col justify-end gap-2">
                    <VStretchedButton
                        v-for="dressing in destinationDressings"
                        :sr-text="dressing.name"
                        @click="selectDestination(dressing)"
                    >
                        <DressingCard :dressing="dressing" />
                    </VStretchedButton>
                </div>
            </template>
        </div>
    </AuthenticatedLayout>
</template>
