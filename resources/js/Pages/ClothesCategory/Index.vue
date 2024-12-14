<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import Modal from '@/Components/Modal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothesCategoryDto } from '@/types/generated';
import { PencilIcon, XMarkIcon } from '@heroicons/vue/24/solid';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    clothesCategories: Array<ClothesCategoryDto>;
}>();

type ModalType = 'create' | 'update' | 'delete';
const openedModal = ref<ModalType | null>(null);
const clothesCategoryForm = useForm({
    id: null,
    name: '',
} as {
    id: number | null;
    name: string;
});

const openModal = (modal: ModalType, clothesCategory?: ClothesCategoryDto) => {
    openedModal.value = modal;
    if (clothesCategory) {
        clothesCategoryForm.id = clothesCategory.id;
        clothesCategoryForm.name = clothesCategory.name;
    }
};

const closeModal = () => {
    openedModal.value = null;
    clothesCategoryForm.id = null;
    clothesCategoryForm.name = '';
};

const createClothesCategory = () => {
    clothesCategoryForm.post(route('clothes-categories.store'), {
        onSuccess: closeModal,
    });
};

const updateClothesCategory = () => {
    if (!clothesCategoryForm.id) {
        return;
    }
    clothesCategoryForm.put(
        route('clothes-categories.update', clothesCategoryForm.id),
        {
            onSuccess: closeModal,
        },
    );
};

const deleteClothesCategory = () => {
    if (!clothesCategoryForm.id) {
        return;
    }
    clothesCategoryForm.delete(
        route('clothes-categories.destroy', clothesCategoryForm.id),
        {
            onSuccess: closeModal,
        },
    );
};
</script>

<template>
    <Head :title="$t('catgories_de_vtements')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="mt-2 text-xl font-semibold leading-tight text-gray-800"
                >
                    {{ $t('catgories_de_vtements') }}
                </h2>

                <VButton @click="openModal('create')"
                    >{{ $t('creer') }}
                </VButton>
            </div>
        </template>

        <div class="mt-auto flex flex-col gap-2">
            <article
                v-for="clothesCategory in clothesCategories"
                class="flex items-center gap-2 rounded-lg bg-amber-50 p-4"
            >
                <h2 class="text-xl">{{ clothesCategory.name }}</h2>
                <VButton
                    class="ml-auto"
                    icon
                    small
                    @click="openModal('update', clothesCategory)"
                >
                    <PencilIcon class="size-5" />
                </VButton>
                <VButton
                    variant="danger"
                    icon
                    small
                    @click="openModal('delete', clothesCategory)"
                >
                    <XMarkIcon class="size-5" />
                </VButton>
            </article>
        </div>

        <Modal v-if="openedModal === 'create'" @close="closeModal">
            <form class="space-y-4" @submit.prevent="createClothesCategory">
                <h2 class="text-2xl">{{ $t('crer_une_catgorie') }}</h2>

                <VInput v-model="clothesCategoryForm.name" />

                <div class="flex gap-2">
                    <VButton class="grow" @click="closeModal" variant="tertiary"
                        >{{ $t('annuler') }}
                    </VButton>
                    <VButton class="grow" type="submit"
                        >{{ $t('creer') }}
                    </VButton>
                </div>
            </form>
        </Modal>

        <Modal v-if="openedModal === 'update'" @close="closeModal">
            <form class="space-y-4" @submit.prevent="updateClothesCategory">
                <h2 class="text-2xl">{{ $t('renommer_la_catgorie') }}</h2>

                <VInput v-model="clothesCategoryForm.name" />

                <div class="flex gap-2">
                    <VButton class="grow" @click="closeModal" variant="tertiary"
                        >{{ $t('annuler') }}
                    </VButton>
                    <VButton class="grow" type="submit"
                        >{{ $t('modifier') }}
                    </VButton>
                </div>
            </form>
        </Modal>

        <Modal v-if="openedModal === 'delete'" @close="closeModal">
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
