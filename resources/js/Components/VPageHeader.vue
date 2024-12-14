<template>
    <div
        class="flex flex-wrap justify-between gap-2 max-md:flex-col md:items-center"
    >
        <div class="flex gap-2" v-if="$slots.before || backTo">
            <VBackButton v-if="backTo" :href="backTo" />

            <slot name="before" />
        </div>

        <div v-if="$slots.title || title">
            <h2
                v-if="title"
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                {{ title }}
            </h2>

            <slot name="title" />
        </div>

        <div class="flex gap-2" v-if="$slots.default">
            <slot />
        </div>
    </div>
</template>
<script setup lang="ts">
import VBackButton from '@/Components/Base/VBackButton.vue';

const props = defineProps<{
    backTo?: string;
    title?: string;
}>();
</script>
