<script setup lang="ts">
import VStretchedButton from '@/Components/Base/VStretchedButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import DressingCard from '@/Components/Dressing/DressingCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { ArrowRightIcon } from '@heroicons/vue/20/solid';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<{
    dressings: Array<DressingDto>;
}>();

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
            <h2 class="mt-2 text-xl font-semibold leading-tight text-gray-800">
                {{ $t('dplacer_des_vtements') }}
            </h2>
            <div class="mt-2 flex items-center gap-2">
                <VTag>{{ originDressing?.name ?? '?' }}</VTag>

                <ArrowRightIcon class="size-5" />

                <VTag>{{ destinationDressing?.name ?? '?' }}</VTag>
            </div>
        </template>

        <template v-if="!originDressing">
            <p class="mt-auto text-sm text-neutral-500">Étape 1/3</p>
            <h3 class="text-xl">Dressing d'origine</h3>

            <div class="mt-4 flex flex-col justify-end gap-2">
                <VStretchedButton
                    v-for="dressing in dressings"
                    :sr-text="dressing.name"
                    @click="selectOrigin(dressing)"
                >
                    <DressingCard :dressing="dressing" />
                </VStretchedButton>
            </div>
        </template>
        <template v-else>
            <p class="mt-auto text-sm text-neutral-500">Étape 2/3</p>
            <h3 class="text-xl">Dressing de destination</h3>

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
    </AuthenticatedLayout>
</template>
