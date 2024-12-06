<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import DressingColorSelector from '@/Components/Dressing/DressingColorSelector.vue';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    dressing: DressingDto;
}>();

const form = useForm({
    name: props.dressing.name,
    color: props.dressing.color,
});

const submit = () => {
    form.put(route('dressings.update', props.dressing));
};
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{
                        $t('modifier_le_dressing_name', { name: dressing.name })
                    }}
                </h2>

                <VButton
                    :href="route('dressings.destroy', dressing)"
                    method="delete"
                    as="button"
                    variant="danger"
                >
                    {{ $t('supprimer') }}
                </VButton>
            </div>
        </template>

        <form class="mt-auto flex flex-col gap-4" @submit.prevent="submit">
            <div>
                <label>{{ $t('nom') }}</label>
                <VInput v-model="form.name" class="w-full" />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <label>{{ $t('couleur') }}</label>
                <DressingColorSelector class="mt-1" v-model="form.color" />
            </div>

            <VButton type="submit">{{ $t('modifier_le_dressing') }}</VButton>
        </form>
    </AuthenticatedLayout>
</template>
