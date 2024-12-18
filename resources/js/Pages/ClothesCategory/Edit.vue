<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothesCategoryDto, DressingDto } from '@/types/generated';
import { TrashIcon } from '@heroicons/vue/24/outline';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    clothesCategory: ClothesCategoryDto;
    clothesMinByDressing: Record<string, number>;
    dressings: Array<DressingDto>;
}>();

const form = useForm({
    name: props.clothesCategory.name,
    clothesMinByDressing: props.clothesMinByDressing,
});

const submit = () => {
    form.put(route('clothes-categories.update', props.clothesCategory));
};

const confirmingDeletion = ref(false);
const confirmDeletion = () => {
    confirmingDeletion.value = true;
};
const deleteClothesCategory = () => {
    router.delete(route('clothes-categories.destroy', props.clothesCategory));
};
const closeModal = () => {
    confirmingDeletion.value = false;
};
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader
                :back-to="route('clothes-categories.index')"
                :title="
                    $t('modifier_la_catgorie_name', {
                        name: clothesCategory.name,
                    })
                "
            >
                <VButton @click="confirmDeletion" variant="danger">
                    <TrashIcon class="size-5" />
                    {{ $t('supprimer') }}
                </VButton>
            </VPageHeader>
        </template>

        <form
            class="mx-auto mt-auto flex w-full max-w-lg flex-col gap-8"
            @submit.prevent="submit"
        >
            <div>
                <label>{{ $t('nom') }}</label>
                <VInput v-model="form.name" class="w-full" />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <p class="mb-2">{{ $t('minimum_de_vtement_par_dressing') }}</p>

                <div class="grid grid-cols-2 gap-2">
                    <div v-for="(min, dressingId) in form.clothesMinByDressing">
                        <label class="text-sm">{{
                            dressings.find(
                                (d) => d.id === Number.parseInt(dressingId),
                            )?.name
                        }}</label>
                        <VInput
                            class="w-full"
                            type="number"
                            v-model="form.clothesMinByDressing[dressingId]"
                        />
                    </div>
                </div>
            </div>

            <VButton
                type="submit"
                :disabled="form.processing"
                :loading="form.processing"
            >
                {{ $t('modifier_la_catgorie') }}
            </VButton>
        </form>

        <Modal v-if="confirmingDeletion" @close="closeModal">
            <form class="space-y-4" @submit.prevent="deleteClothesCategory">
                <h2 class="text-2xl">{{ $t('supprimer_la_catgorie') }}</h2>

                <div class="font-bold">
                    <p>{{ $t('tous_les_vtements_associs_seront_conservs') }}</p>
                    <p>{{ $t('il_seront_marqus_comme_noncatgoris') }}</p>
                </div>

                <div class="flex gap-2">
                    <VButton class="grow" @click="closeModal" variant="tertiary"
                        >{{ $t('annuler') }}
                    </VButton>
                    <VButton class="grow" variant="danger" type="submit"
                        >{{ $t('supprimer') }}
                    </VButton>
                </div>
            </form>
        </Modal>
    </AuthenticatedLayout>
</template>
