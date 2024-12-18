<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VInput from '@/Components/Base/VInput.vue';
import VSelect from '@/Components/Base/VSelect.vue';
import Camera from '@/Components/Camera.vue';
import InputError from '@/Components/InputError.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import NoLayout from '@/Layouts/NoLayout.vue';
import { DressingDto } from '@/types/generated';
import { PlusIcon, XMarkIcon } from '@heroicons/vue/24/solid';
import { Head, useForm } from '@inertiajs/vue3';
import { useStorage } from '@vueuse/core';
import { computed, ref } from 'vue';

const props = defineProps<{
    dressing: DressingDto;
}>();

const clothesCategories = useClothesCategories();

const storedClothesCategoryId = useStorage(
    'dressing.clothes.create',
    clothesCategories.options[0].value,
);

const form = useForm({
    images: [] as Array<Blob>,
    description: '',
    clothes_category_id: storedClothesCategoryId.value,
});

const clothesCategoryId = computed({
    get: () => form.clothes_category_id,
    set: (v) => {
        storedClothesCategoryId.value = v;
        form.clothes_category_id = v;
    },
});

const submit = () => {
    form.post(route('dressings.clothes.store', props.dressing), {
        preserveState: false,
    });
};

const addImage = (photo: Blob) => {
    form.images.push(photo);
};

const removeImage = (index: number) => {
    form.images.splice(index, 1);
};

const urlFromBlob = (blob: Blob) =>
    (window.URL || window.webkitURL).createObjectURL(blob);

const step = ref<1 | 2>(1);
</script>

<template>
    <Head :title="$t('dashboard')" />

    <NoLayout>
        <template #header>
            <VPageHeader
                :back-to="route('dressings.show', dressing)"
                :title="
                    $t('ajouter_un_vtement_au_dressing', {
                        dressing: dressing.name,
                    })
                "
            >
            </VPageHeader>
        </template>

        <form
            class="mx-auto flex h-min max-w-lg flex-col gap-4"
            @submit.prevent="submit"
        >
            <div>
                <label>{{ $t('catgorie') }}</label>
                <VSelect
                    v-model="clothesCategoryId"
                    :options="clothesCategories.options"
                    class="w-full"
                />

                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div>
                <label>{{ $t('description') }} ({{ $t('optionnel') }})</label>
                <VInput
                    v-model="form.description"
                    :placeholder="$t('pull_gris')"
                    class="w-full"
                />

                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="flex max-h-[40dvh] justify-center">
                <template v-if="form.images.length">
                    <div
                        v-for="(blob, index) in form.images"
                        class="flex justify-center"
                    >
                        <div class="relative h-full overflow-hidden rounded-md">
                            <img
                                class="h-full object-contain"
                                :src="urlFromBlob(blob)"
                                alt=""
                            />
                            <VButton
                                icon
                                small
                                class="absolute right-1 top-1"
                                variant="danger"
                                @click="removeImage(index)"
                            >
                                <XMarkIcon class="h-5 w-5" />
                            </VButton>
                        </div>
                    </div>
                </template>
                <Camera v-else class="mx-auto" @photo="addImage" />
            </div>

            <VButton
                type="submit"
                :disabled="form.processing"
                :loading="form.processing"
                >{{ $t('ajouter_le_vtement') }}
                <PlusIcon class="size-5" />
            </VButton>
        </form>
    </NoLayout>
</template>
