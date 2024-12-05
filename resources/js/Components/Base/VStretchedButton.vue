<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        srText: string;
        href?: string;
        external?: boolean;
        type?: string;
        disabled?: boolean;
    }>(),
    {
        type: 'button',
    },
);

const emit = defineEmits<{
    click: [];
}>();
</script>
<template>
    <div class="relative">
        <slot />

        <component
            :is="href ? (external ? 'a' : Link) : 'button'"
            :disabled="disabled"
            :href="disabled ? undefined : href"
            class="absolute inset-0 z-10"
            :type="type"
            @click="emit('click')"
        >
            <span class="sr-only">{{ srText }}</span>
        </component>
    </div>
</template>
