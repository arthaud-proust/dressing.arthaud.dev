<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    dressing: DressingDto;
}>();

const form = useForm({
    name: props.dressing.name,
});

const submit = () => {
    form.put(route('dressings.update', props.dressing));
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Modifier le dressing {{ dressing.name }}
                </h2>

                <VButton
                    :href="route('dressings.destroy', dressing)"
                    method="delete"
                    as="button"
                    variant="danger"
                >
                    Supprimer
                </VButton>
            </div>
        </template>

        <form class="mt-auto flex flex-col gap-4" @submit.prevent="submit">
            <div>
                <label>Nom</label>
                <VInput v-model="form.name" class="w-full" />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <VButton type="submit">Modifier le dressing</VButton>
        </form>
    </AuthenticatedLayout>
</template>
