<script setup lang="ts">
import { ClothingDto } from '@/types/generated';
import { QuestionMarkCircleIcon } from '@heroicons/vue/24/solid';
import { ref } from 'vue';

const props = defineProps<{
    clothing: ClothingDto;
}>();

const noImages = props.clothing.thumbUrls.length === 0;
const imageError = ref(false);
</script>
<template>
    <article class="relative w-full overflow-hidden rounded-lg bg-neutral-50">
        <div class="flex gap-1">
            <template v-if="!imageError">
                <img
                    v-for="imageUrl in clothing.thumbUrls"
                    @error="imageError = true"
                    :src="imageUrl"
                    alt=""
                    class="rounded-md"
                />
            </template>
            <div
                v-if="noImages || imageError"
                class="w-full rounded-md bg-neutral-100 p-6"
            >
                <QuestionMarkCircleIcon
                    class="mx-auto size-12 text-neutral-200"
                />
            </div>
        </div>

        <p
            class="p-2 text-center text-xs text-neutral-500"
            v-if="clothing.description || noImages"
        >
            {{ clothing.description }}
            <template v-if="noImages">
                {{ $t('aucune_description') }}
            </template>
        </p>
    </article>
</template>
