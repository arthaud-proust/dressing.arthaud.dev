<template>
    <input
        :type="type"
        :disabled="disabled"
        v-model="model"
        class="flex items-center justify-center gap-1 rounded-lg border border-neutral-300 px-3 py-2 ring-neutral-400 ring-offset-2 focus:outline-none focus:ring-4 disabled:pointer-events-none disabled:opacity-50"
    />
</template>
<script setup lang="ts">
const props = withDefaults(
    defineProps<{
        type?: 'text' | 'password' | 'number' | 'email';
        disabled?: boolean;
    }>(),
    {
        type: 'text',
    },
);

const model = defineModel<string | number>({
    required: true,
});
</script>
