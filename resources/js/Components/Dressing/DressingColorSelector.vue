<script setup lang="ts">
import { DressingColor } from '@/types/generated';
import { CheckCircleIcon } from '@heroicons/vue/24/outline';

const color = defineModel<DressingColor>({
    required: true,
});

const colorFromDressingColor = (dressingColor: DressingColor) => {
    switch (dressingColor) {
        case DressingColor.RED:
            return 'bg-red-500 text-red-900 ring-red-900';
        case DressingColor.AMBER:
            return 'bg-amber-500 text-amber-900 ring-amber-900';
        case DressingColor.LIME:
            return 'bg-lime-500 text-lime-900 ring-lime-900';
        case DressingColor.EMERALD:
            return 'bg-emerald-500 text-emerald-900 ring-emerald-900';
        case DressingColor.CYAN:
            return 'bg-cyan-500 text-cyan-900 ring-cyan-900';
        case DressingColor.BLUE:
            return 'bg-blue-500 text-blue-900 ring-blue-900';
        case DressingColor.VIOLET:
            return 'bg-violet-500 text-violet-900 ring-violet-900';
        case DressingColor.FUCHSIA:
            return 'bg-fuchsia-500 text-fuchsia-900 ring-fuchsia-900';
    }
};
</script>
<template>
    <div class="flex gap-2">
        <button
            v-for="value in Object.values(DressingColor)"
            type="button"
            :aria-selected="color === value"
            class="flex flex-1 items-center justify-center rounded-lg p-2 ring-offset-2 aria-selected:ring-2"
            :class="colorFromDressingColor(value)"
            @click="color = value"
        >
            <CheckCircleIcon v-if="color === value" class="size-8" />
        </button>
    </div>
</template>
