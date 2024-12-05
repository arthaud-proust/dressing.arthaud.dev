<script setup lang="ts">
import { ClothingDto } from '@/types/generated';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/solid';

defineProps<{
    clothing: ClothingDto;
}>();
</script>
<template>
    <article
        class="relative w-32 shrink-0 overflow-hidden rounded-lg bg-neutral-50"
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
            v-if="clothing.description || clothing.imageUrls.length === 0"
        >
            {{ clothing.description }}
            <template v-if="clothing.imageUrls.length === 0">
                {{ $t('aucune_description') }}
            </template>
        </p>
    </article>
</template>
