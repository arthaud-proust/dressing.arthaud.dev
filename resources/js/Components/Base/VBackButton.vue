<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import { ArrowLeftIcon } from '@heroicons/vue/16/solid';

defineProps<{
    href?: string;
    disabled?: boolean;
}>();
</script>
<template>
    <VButton :href="href" variant="ghost" small :padded="false">
        <ArrowLeftIcon class="size-4" />

        <slot>
            {{ $t('retour') }}
        </slot>
    </VButton>
</template>
