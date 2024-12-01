<template>
    <input
        :type="type"
        :disabled="disabled"
        v-model="model"
        class="flex items-center justify-center gap-1 rounded-lg px-4 py-2 font-bold ring-offset-2 focus:outline-none focus:ring-4 disabled:pointer-events-none disabled:opacity-50"
    />
</template>
<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        href?: string;
        type?: 'text' | 'password' | 'number' | 'email';
        disabled?: boolean;
    }>(),
    {
        type: 'text',
        variant: 'primary',
    },
);

const model = defineModel();
</script>
