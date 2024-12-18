<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline';
import { useAnimate } from '@vueuse/core';
import { onMounted, ref, watch } from 'vue';

export type Toast = {
    type: 'success' | 'error';
    content: string;
};
const props = defineProps<Toast>();

const TIMEOUT_MS = 2_000;

const emit = defineEmits<{
    close: [];
}>();

const progressBar = ref<HTMLDivElement>();

const { play, playState } = useAnimate(
    progressBar,
    { width: 0 },
    { immediate: false, duration: TIMEOUT_MS },
);

watch(playState, (newPlayState) => {
    if (newPlayState === 'finished') {
        emit('close');
    }
});

onMounted(() => {
    play();
});
</script>
<template>
    <div
        class="relative flex max-w-lg items-center gap-2 overflow-hidden rounded-lg px-4 py-2 shadow-lg"
        :class="{
            'bg-green-100 text-green-900': type === 'success',
            'bg-red-100 text-red-900': type === 'error',
        }"
    >
        <CheckCircleIcon class="size-7" />
        {{ content }}
        <VButton
            class="ml-auto after:absolute after:inset-0"
            icon
            small
            variant="ghost"
            @click="emit('close')"
        >
            <XMarkIcon
                class="size-5"
                :class="{
                    'text-green-900': type === 'success',
                    'text-red-900': type === 'error',
                }"
            />
        </VButton>

        <div class="absolute bottom-0 left-0 right-0">
            <div ref="progressBar" class="h-0.5 w-full bg-green-800"></div>
        </div>
    </div>
</template>
