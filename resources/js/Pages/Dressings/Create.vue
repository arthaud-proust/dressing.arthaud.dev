<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import DressingColorSelector from '@/Components/Dressing/DressingColorSelector.vue';
import InputError from '@/Components/InputError.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingColor } from '@/types/generated';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    color: DressingColor.AMBER,
});

const submit = () => {
    form.post(route('dressings.store'));
};
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader
                :back-to="route('dashboard')"
                :title="$t('crer_un_dressing')"
            />
        </template>

        <form
            class="mx-auto mt-auto flex w-full max-w-lg flex-col gap-4"
            @submit.prevent="submit"
        >
            <div>
                <label>{{ $t('nom') }}</label>
                <VInput v-model="form.name" class="w-full" />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <label>{{ $t('couleur') }}</label>
                <DressingColorSelector class="mt-1" v-model="form.color" />
            </div>

            <VButton
                type="submit"
                :loading="form.processing"
                :disabled="form.processing"
                >{{ $t('crer_le_dressing') }}
            </VButton>
        </form>
    </AuthenticatedLayout>
</template>
