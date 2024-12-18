<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import Modal from '@/Components/Modal.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothesCategoryDto } from '@/types/generated';
import { PencilIcon, PlusIcon } from '@heroicons/vue/24/solid';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    clothesCategories: Array<ClothesCategoryDto>;
}>();

const isModalCreateOpened = ref(false);
const clothesCategoryForm = useForm({
    name: '',
});

const openModalCreate = () => (isModalCreateOpened.value = true);
const closeModalCreate = () => (isModalCreateOpened.value = false);

const createClothesCategory = () => {
    clothesCategoryForm.post(route('clothes-categories.store'), {
        onSuccess: closeModalCreate,
    });
};
</script>

<template>
    <Head :title="$t('catgories_de_vtements')" />

    <AuthenticatedLayout>
        <template #header>
            <VPageHeader
                :back-to="route('dashboard')"
                :title="$t('catgories_de_vtements')"
            >
                <VButton @click="openModalCreate">
                    <PlusIcon class="size-5" />
                    {{ $t('creer') }}
                </VButton>
            </VPageHeader>
        </template>

        <div class="mx-auto mt-auto flex w-full max-w-lg flex-col gap-2 py-16">
            <article
                v-for="clothesCategory in clothesCategories"
                class="flex items-center gap-2 rounded-lg bg-amber-50 p-4"
            >
                <h2 class="text-xl">{{ clothesCategory.name }}</h2>
                <VButton
                    :href="route('clothes-categories.edit', clothesCategory)"
                    class="ml-auto"
                    icon
                    small
                >
                    <PencilIcon class="size-5" />
                </VButton>
            </article>
        </div>

        <Modal v-if="isModalCreateOpened" @close="closeModalCreate">
            <form class="space-y-4" @submit.prevent="createClothesCategory">
                <h2 class="text-2xl">{{ $t('crer_une_catgorie') }}</h2>

                <VInput v-model="clothesCategoryForm.name" />

                <div class="flex gap-2">
                    <VButton
                        class="grow"
                        @click="closeModalCreate"
                        variant="tertiary"
                        >{{ $t('annuler') }}
                    </VButton>
                    <VButton
                        class="grow"
                        type="submit"
                        :loading="clothesCategoryForm.processing"
                        :disabled="clothesCategoryForm.processing"
                        >{{ $t('creer') }}
                    </VButton>
                </div>
            </form>
        </Modal>
    </AuthenticatedLayout>
</template>
