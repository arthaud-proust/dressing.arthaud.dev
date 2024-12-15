<template>
    <component
        :is="href ? (external ? 'a' : Link) : 'button'"
        :type="href ? undefined : type"
        :disabled="disabled"
        :href="disabled ? undefined : href"
        class="flex items-center justify-center gap-2 font-bold ring-offset-2 focus:outline-none disabled:brightness-100 disabled:contrast-[0.85] disabled:saturate-50 sm:focus:ring-4"
        :class="[roundedClasses, paddingClasses, marginClasses, colorClasses]"
    >
        <slot />

        <SpinnerIcon v-if="loading" class="size-5 animate-spin" />
    </component>
</template>
<script setup lang="ts">
import SpinnerIcon from '@/Components/Icon/Outline/SpinnerIcon.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        href?: string;
        type?: 'button' | 'submit';
        variant?:
            | 'primary'
            | 'secondary'
            | 'tertiary'
            | 'ghost'
            | 'danger'
            | 'success';
        disabled?: boolean;
        loading?: boolean;
        external?: boolean;
        icon?: boolean;
        small?: boolean;
        padded?: boolean;
    }>(),
    {
        type: 'button',
        variant: 'primary',
        padded: true,
    },
);

const roundedClasses = computed(() => {
    if (props.icon) return 'rounded-full';
    return props.small ? 'rounded-md' : 'rounded-lg';
});

const paddingClasses = computed(() => {
    if (props.icon) return props.small ? 'p-2' : 'p-3';
    return props.small ? 'px-2 py-1' : 'px-4 py-2';
});

const marginClasses = computed(() => {
    if (props.padded) return;
    if (props.icon) return props.small ? '-m-2' : '-m-3';
    return props.small ? '-mx-2 -my-1' : '-mx-4 -my-2';
});

const colorClasses = computed(() => {
    if (props.variant === 'primary') {
        return 'bg-amber-500 disabled:hover:bg-amber-500 ring-amber-700 hover:bg-amber-600 text-amber-50';
    }

    if (props.variant === 'secondary') {
        return 'bg-amber-100/80 disabled:hover:bg-amber-100/80 ring-amber-700 hover:bg-amber-100 text-amber-800';
    }

    if (props.variant === 'tertiary') {
        return 'bg-neutral-100 disabled:hover:bg-neutral-100 ring-neutral-400 hover:bg-neutral-200 text-neutral-800';
    }

    if (props.variant === 'ghost') {
        return 'bg-transparent disabled:hover:bg-transparent ring-neutral-400 hover:bg-neutral-100 text-neutral-500';
    }

    if (props.variant === 'danger') {
        return 'bg-red-100 disabled:hover:bg-red-100 ring-red-300 hover:bg-red-200 text-red-900';
    }

    if (props.variant === 'success') {
        return 'bg-green-500 disabled:hover:bg-green-500 ring-green-700 hover:bg-green-600 text-green-50';
    }
});
</script>
