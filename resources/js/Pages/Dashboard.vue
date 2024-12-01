<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    dressings: Array<DressingDto>;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dressings
                </h2>
                <VButton :href="route('dressings.create')">Créer</VButton>
            </div>
        </template>

        <div class="mt-auto flex flex-col justify-end gap-2">
            <Link
                v-for="dressing in dressings"
                class="rounded-xl bg-amber-100 p-4"
                :href="route('dressings.show', { dressing })"
            >
                {{ dressing.name }}
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
