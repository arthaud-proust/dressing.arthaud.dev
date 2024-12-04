<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import ClothingDetails from '@/Components/Clothing/ClothingDetails.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ClothingCategory, ClothingDto, DressingDto } from '@/types/generated';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/solid';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    dressing: DressingDto;
    clothingListByCategory: Record<ClothingCategory, Array<ClothingDto>>;
}>();

const selectedClothing = ref<ClothingDto | null>(null);
</script>

<template>
    <Head :title="$t('dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-wrap items-center justify-between gap-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ $t('dressing_name', { name: dressing.name }) }}
                </h2>

                <div class="flex flex-wrap gap-2">
                    <VButton
                        :href="route('dressings.clothing.create', dressing)"
                    >
                        {{ $t('ajouter_un_vtement') }}
                    </VButton>

                    <VButton
                        :href="route('dressings.edit', dressing)"
                        variant="secondary"
                    >
                        {{ $t('modifier') }}
                    </VButton>
                </div>
            </div>
        </template>

        <section
            class="mt-4"
            v-for="(clothingList, category) in clothingListByCategory"
        >
            <h3 class="text-xl">
                {{ $t(`clothing_category.${category}`) }} ({{
                    clothingList.length
                }})
            </h3>
            <div class="mt-2 flex items-start gap-2 overflow-y-auto pb-4 pr-8">
                <article
                    class="relative w-32 shrink-0 overflow-hidden rounded-lg bg-neutral-50"
                    v-for="clothing in clothingList"
                >
                    <div class="flex gap-1">
                        <img
                            v-for="imageUrl in clothing.imageUrls"
                            :src="imageUrl"
                            alt=""
                            class="rounded-md"
                        />
                        <div
                            v-if="clothing.imageUrls.length === 0"
                            class="w-full rounded-md bg-neutral-100 p-6"
                        >
                            <QuestionMarkCircleIcon
                                class="mx-auto size-12 text-neutral-200"
                            />
                        </div>
                    </div>

                    <p
                        class="p-2 text-center text-xs text-neutral-500"
                        v-if="
                            clothing.description ||
                            clothing.imageUrls.length === 0
                        "
                    >
                        {{ clothing.description }}
                        <template v-if="clothing.imageUrls.length === 0">
                            {{ $t('aucune_description') }}
                        </template>
                    </p>

                    <button
                        @click="selectedClothing = clothing"
                        class="absolute inset-0"
                    >
                        <span class="sr-only">{{ $t('voir_le_dtail') }}</span>
                    </button>
                </article>
            </div>
        </section>
        <ClothingDetails
            v-if="selectedClothing"
            :clothing="selectedClothing"
            @close="selectedClothing = null"
        />
    </AuthenticatedLayout>
</template>
