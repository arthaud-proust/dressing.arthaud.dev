<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    dressing: DressingDto;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dressing {{ dressing.name }}
                </h2>
                <VButton :href="route('dressings.edit', dressing)"
                    >Modifier
                </VButton>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
