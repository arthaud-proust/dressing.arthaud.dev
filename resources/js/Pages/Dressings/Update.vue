<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import DressingColorSelector from '@/Components/Dressing/DressingColorSelector.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DressingDto } from '@/types/generated';
import { TrashIcon } from '@heroicons/vue/24/outline';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

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

const confirmingDressingDeletion = ref(false);
const confirmDressingDeletion = () => {
    confirmingDressingDeletion.value = true;
};
const deleteDressing = () => {
    router.delete(route('dressings.destroy', props.dressing));
};
const closeModal = () => {
    confirmingDressingDeletion.value = false;
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

                <VButton @click="confirmDressingDeletion" variant="danger">
                    <TrashIcon class="size-5" />
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

        <Modal :show="confirmingDressingDeletion" @close="closeModal">
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('supprimer_le_dressing', { name: dressing.name }) }}
            </h2>

            <p class="mt-2 font-bold text-gray-600">
                {{
                    $t(
                        'le_dressing_et_ses_n_vtements_seront_dfinitivement',
                        dressing.clothesCount,
                    )
                }}
            </p>

            <p class="mt-2 text-gray-600">
                {{ $t('si_vous_ne_souhaitez_pas_supprimer_ces_vtements_dp') }}
            </p>

            <div class="mt-6 flex justify-end">
                <VButton variant="tertiary" @click="closeModal">
                    {{ $t('annuler') }}
                </VButton>

                <VButton
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deleteDressing"
                    variant="danger"
                >
                    {{ $t('supprimer') }}
                </VButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
