<script setup lang="ts">
import { ClothingDto } from '@/types/generated';
import { DialogTitle } from '@headlessui/vue';

import VButton from '@/Components/Base/VButton.vue';
import VTag from '@/Components/Base/VTag.vue';
import Modal from '@/Components/Modal.vue';
import { useClothesCategories } from '@/composables/useClothesCategories';
import { TagIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/solid';
import { router } from '@inertiajs/vue3';
import 'swiper/css';
import 'swiper/css/pagination';
import { Mousewheel, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { ref } from 'vue';

const props = defineProps<{
    clothing: ClothingDto;
}>();

const emit = defineEmits<{
    close: [];
}>();

const clothesCategories = useClothesCategories();

const pagination = {
    clickable: true,
};

const confirmDeleteClothing = ref(false);
const deleteClothing = () => {
    if (!confirmDeleteClothing.value) {
        confirmDeleteClothing.value = true;
        return;
    }

    confirmDeleteClothing.value = false;
    router.delete(route('clothes.destroy', props.clothing));
    emit('close');
};
</script>
<template>
    <Modal @close="emit('close')">
        <Swiper
            v-if="clothing.imageUrls.length > 0"
            :modules="[Pagination, Mousewheel]"
            :pagination="pagination"
            mousewheel
            class="rounded-lg md:rounded-xl"
        >
            <SwiperSlide v-for="imageUrl in clothing.imageUrls">
                <img
                    :src="imageUrl"
                    alt=""
                    class="mx-auto rounded-lg md:rounded-xl"
                />
            </SwiperSlide>
        </Swiper>
        <div
            v-else
            class="flex aspect-video w-full items-center justify-center rounded-lg bg-neutral-100 md:rounded-xl"
        >
            <QuestionMarkCircleIcon class="mx-auto size-1/4 text-neutral-200" />
        </div>

        <div class="mt-4 flex items-start justify-between">
            <div>
                <DialogTitle
                    as="h3"
                    class="text-xl font-medium leading-6 text-gray-900"
                >
                    {{ $t('detail_du_vetement') }}
                </DialogTitle>
                <VTag class="mt-2">
                    <TagIcon class="size-5" />
                    {{ clothesCategories.name(clothing.clothes_category_id) }}
                </VTag>
            </div>

            <VButton @click="deleteClothing" variant="danger" class="">
                <TrashIcon class="size-5" />
                <span v-if="confirmDeleteClothing">
                    ({{ $t('confirmer') }})
                </span>
            </VButton>
        </div>

        <p
            class="mt-2 text-neutral-500"
            v-if="clothing.description || clothing.imageUrls.length === 0"
        >
            {{ clothing.description }}
            <template v-if="clothing.imageUrls.length === 0">
                {{ $t('aucune_description') }}
            </template>
        </p>

        <VButton
            @click="emit('close')"
            variant="tertiary"
            class="mt-4 w-full max-w-sm"
        >
            {{ $t('fermer') }}
        </VButton>
    </Modal>
</template>
<style lang="postcss">
.swiper-pagination-bullet {
    @apply h-1 w-7 rounded-full bg-white;
}

.swiper-pagination-bullet-active {
    @apply bg-amber-200;
}
</style>
