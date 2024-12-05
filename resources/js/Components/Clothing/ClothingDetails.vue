<script setup lang="ts">
import { ClothingDto } from '@/types/generated';
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';

import VButton from '@/Components/Base/VButton.vue';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/solid';
import 'swiper/css';
import 'swiper/css/pagination';
import { Mousewheel, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';

const props = defineProps<{
    clothing: ClothingDto;
}>();

const emit = defineEmits<{
    close: [];
}>();

const pagination = {
    clickable: true,
};
</script>
<template>
    <TransitionRoot appear show as="template">
        <Dialog as="div" @close="emit('close')" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-end justify-center p-2 text-center md:p-4"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="relative w-full max-w-2xl transform flex-col items-start overflow-hidden rounded-2xl bg-white p-4 text-left align-middle shadow-xl transition-all md:rounded-3xl md:p-6"
                        >
                            <Swiper
                                v-if="clothing.imageUrls.length > 0"
                                :modules="[Pagination, Mousewheel]"
                                :pagination="pagination"
                                mousewheel
                                class="rounded-lg md:rounded-xl"
                            >
                                <SwiperSlide
                                    v-for="imageUrl in clothing.imageUrls"
                                >
                                    <img
                                        :src="imageUrl"
                                        alt=""
                                        class="rounded-lg md:rounded-xl"
                                    />
                                </SwiperSlide>
                            </Swiper>
                            <div
                                v-else
                                class="flex aspect-video w-full items-center justify-center rounded-lg bg-neutral-100 md:rounded-xl"
                            >
                                <QuestionMarkCircleIcon
                                    class="mx-auto size-1/4 text-neutral-200"
                                />
                            </div>

                            <DialogTitle
                                as="h3"
                                class="mt-4 text-xl font-medium leading-6 text-gray-900"
                            >
                                {{ $t('detail_du_vetement') }}
                            </DialogTitle>

                            <p
                                class="mt-2 inline-flex rounded-lg bg-neutral-100 px-3 py-1"
                            >
                                {{
                                    $t(`clothing_category.${clothing.category}`)
                                }}
                            </p>

                            <p
                                class="mt-2 text-neutral-500"
                                v-if="
                                    clothing.description ||
                                    clothing.imageUrls.length === 0
                                "
                            >
                                {{ clothing.description }}
                                <template
                                    v-if="clothing.imageUrls.length === 0"
                                >
                                    {{ $t('aucune_description') }}
                                </template>
                            </p>

                            <VButton
                                @click="emit('close')"
                                variant="tertiary"
                                class="mt-2 w-full"
                            >
                                {{ $t('fermer') }}
                            </VButton>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
<style lang="postcss">
.swiper-pagination-bullet {
    @apply h-1 w-7 rounded-full bg-white;
}

.swiper-pagination-bullet-active {
    @apply bg-amber-200;
}
</style>
