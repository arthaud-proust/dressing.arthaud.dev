<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import VSelect from '@/Components/Base/VSelect.vue';
import VTextarea from '@/Components/Base/VTextarea.vue';
import Camera from '@/Components/Camera.vue';
import InputError from '@/Components/InputError.vue';
import NoLayout from '@/Layouts/NoLayout.vue';
import { ClothingCategory, DressingDto } from '@/types/generated';
import {
    ArrowRightIcon,
    CameraIcon,
    PlusIcon,
    XMarkIcon,
} from '@heroicons/vue/20/solid';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

const props = defineProps<{
    dressing: DressingDto;
    clothingCategories: Array<ClothingCategory>;
}>();

const { t } = useI18n();

const clothingCategoriesOptions = computed(() =>
    props.clothingCategories.map((value) => ({
        value,
        label: t(`clothing_category.${value}`),
    })),
);

const form = useForm({
    images: [] as Array<Blob>,
    description: '',
    category: props.clothingCategories[0],
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
            <Link :href="route('dressings.show', dressing)"
                >{{ $t('retour') }}
            </Link>

            <h2 class="mt-2 text-xl font-semibold leading-tight text-gray-800">
                {{
                    $t('ajouter_un_vtement_au_dressing', {
                        dressing: dressing.name,
                    })
                }}
            </h2>
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
                        v-model="form.category"
                        :options="clothingCategoriesOptions"
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

                <VButton type="submit"
                    >{{ $t('ajouter_le_vtement') }}
                    <PlusIcon class="size-5" />
                </VButton>
            </template>
        </form>
    </NoLayout>
</template>
