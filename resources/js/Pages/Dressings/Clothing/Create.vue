<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VSelect from '@/Components/Base/VSelect.vue';
import VTextarea from '@/Components/Base/VTextarea.vue';
import Camera from '@/Components/Camera.vue';
import InputError from '@/Components/InputError.vue';
import VPageHeader from '@/Components/VPageHeader.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import NoLayout from '@/Layouts/NoLayout.vue';
import { DressingDto } from '@/types/generated';
import {
    ArrowRightIcon,
    CameraIcon,
    PlusIcon,
    XMarkIcon,
} from '@heroicons/vue/24/solid';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    dressing: DressingDto;
}>();

const clothesCategories = useClothesCategories();

const form = useForm({
    images: [] as Array<Blob>,
    description: '',
    clothes_category_id: clothesCategories.options[0].value,
});

const submit = () => {
    form.post(route('dressings.clothes.store', props.dressing));
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

        <div class="mt-auto flex gap-2 overflow-y-auto pb-2 pr-8">
            <div
                v-for="(blob, index) in form.images"
                class="relative h-20 shrink-0 overflow-hidden rounded-md"
            >
                <img
                    class="h-full w-full object-cover"
                    :src="urlFromBlob(blob)"
                    alt=""
                />
                <button
                    type="button"
                    class="absolute right-1 top-1 rounded-full bg-red-200/70 p-1"
                    @click="removeImage(index)"
                >
                    <XMarkIcon class="h-5 w-5" />
                </button>
            </div>
        </div>

        <form class="mt-4 flex flex-col gap-4" @submit.prevent="submit">
            <template v-if="step === 1">
                <Camera class="mx-auto" @photo="addImage" />

                <VButton @click="step = 2"
                    >{{
                        form.images.length > 0
                            ? $t('suivant')
                            : $t('continuer_sans_photo')
                    }}

                    <ArrowRightIcon class="size-5" />
                </VButton>
            </template>
            <template v-if="step === 2">
                <VButton @click="step = 1" variant="secondary">
                    <CameraIcon class="size-5" />
                    {{
                        form.images.length > 0
                            ? $t('prendre_dautres_photos')
                            : $t('prendre_des_photos')
                    }}
                </VButton>

                <div>
                    <label>{{ $t('catgorie') }}</label>
                    <VSelect
                        v-model="form.clothes_category_id"
                        :options="clothesCategories.options"
                        class="w-full"
                    />

                    <InputError
                        :message="form.errors.description"
                        class="mt-2"
                    />
                </div>

                <div>
                    <label
                        >{{ $t('description') }} ({{
                            form.images.length > 0 ? 'optionnel' : 'recommandé'
                        }})</label
                    >
                    <VTextarea
                        v-model="form.description"
                        :placeholder="$t('pull_gris')"
                        class="w-full"
                    />

                    <InputError
                        :message="form.errors.description"
                        class="mt-2"
                    />
                </div>

                <VButton
                    type="submit"
                    :disabled="form.processing"
                    :loading="form.processing"
                    >{{ $t('ajouter_le_vtement') }}
                    <PlusIcon class="size-5" />
                </VButton>
            </template>
        </form>
    </NoLayout>
</template>
