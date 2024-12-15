<script setup lang="ts">
import {
    CheckCircleIcon,
    ExclamationCircleIcon,
    ExclamationTriangleIcon,
    InformationCircleIcon,
} from '@heroicons/vue/24/outline';

const props = defineProps<{
    type: 'info' | 'success' | 'warning' | 'danger';
}>();
</script>
<template>
    <div
        class="flex gap-2 rounded-lg p-3"
        :class="{
            'bg-blue-50 text-blue-800': type === 'info',
            'bg-green-50 text-green-800': type === 'success',
            'bg-orange-50 text-orange-800': type === 'warning',
            'bg-red-50 text-red-800': type === 'danger',
        }"
    >
        <InformationCircleIcon
            v-if="type === 'info'"
            class="mt-0.5 size-5 shrink-0"
        />
        <CheckCircleIcon
            v-if="type === 'success'"
            class="mt-0.5 size-5 shrink-0"
        />
        <ExclamationCircleIcon
            v-else-if="type === 'warning'"
            class="mt-0.5 size-5 shrink-0"
        />
        <ExclamationTriangleIcon
            v-else-if="type === 'danger'"
            class="mt-0.5 size-5 shrink-0"
        />
        <div>
            <slot />
        </div>
    </div>
</template>
