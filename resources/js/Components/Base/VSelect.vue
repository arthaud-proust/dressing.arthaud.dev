<template>
    <select
        :disabled="disabled"
        v-model="model"
        class="flex items-center justify-center gap-1 rounded-lg px-4 py-2 ring-offset-2 focus:outline-none focus:ring-4 disabled:pointer-events-none disabled:opacity-50"
    >
        <option v-for="option in options" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
<script setup lang="ts" generic="T">
export type Option<T> = {
    label: string;
    value: T;
};

const props = defineProps<{
    options: Array<Option<T>>;
    disabled?: boolean;
}>();

const model = defineModel<T>();
</script>
