<template>
    <textarea
        :disabled="disabled"
        :placeholder="placeholder"
        v-model="model"
        class="flex items-center justify-center gap-1 rounded-lg px-4 py-2 ring-offset-2 focus:outline-none focus:ring-4 disabled:pointer-events-none disabled:opacity-50"
    ></textarea>
</template>
<script setup lang="ts">
const props = defineProps<{
    disabled?: boolean;
    placeholder?: string;
}>();

const model = defineModel<string>({
    required: true,
});
</script>
