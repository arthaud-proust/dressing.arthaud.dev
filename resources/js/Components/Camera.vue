<script setup lang="ts">
import VButton from '@/Components/Base/VButton.vue';
import { useCamera } from '@/composables/useCamera';
import { useCaptureVideoFrame } from '@/composables/useCaptureVideoFrame';
import { ArrowPathIcon, CameraIcon } from '@heroicons/vue/24/solid';
import { onBeforeUnmount, ref } from 'vue';

const emit = defineEmits<{
    photo: [content: Blob];
}>();

const cameraOutputRef = ref<HTMLVideoElement>();
const {
    isLoading,
    error,
    selectNextCamera,
    selectRearCamera,
    canSelectNextCamera,
    stopCameraStream,
    isSelectedCameraMirrored,
} = useCamera({
    onCamerasUpdated: () => {
        selectRearCamera();
    },
    onStream: (stream) => {
        if (cameraOutputRef.value) {
            cameraOutputRef.value.srcObject = stream;
        }
    },
});
const { captureFrame } = useCaptureVideoFrame(cameraOutputRef);

const nextCam = async () => {
    await selectNextCamera();
};

const takePhoto = async () => {
    const photoContent = await captureFrame(isSelectedCameraMirrored.value);

    if (photoContent) {
        emit('photo', photoContent);
    }
};

onBeforeUnmount(() => {
    stopCameraStream();
});
</script>

<template>
    <div class="relative w-fit overflow-hidden rounded-md bg-black">
        <div v-if="isLoading" class="inset-0 mx-auto object-cover"></div>

        <video
            v-show="!isLoading"
            ref="cameraOutputRef"
            :class="isSelectedCameraMirrored && '-scale-x-100'"
            autoplay
            muted
        ></video>

        <div
            class="absolute bottom-0 z-20 flex w-full flex-row items-end justify-center gap-4 p-4"
        >
            <div v-if="error" class="rounded-lg bg-red-100 p-4 text-red-600">
                {{ $t('impossible_daccder_la_camra') }}
            </div>
            <VButton icon v-if="!error" type="button" @click="takePhoto">
                <CameraIcon class="size-6" />
            </VButton>
            <VButton
                icon
                variant="secondary"
                v-if="!error && canSelectNextCamera"
                type="button"
                @click="nextCam"
            >
                <ArrowPathIcon class="size-6" />
            </VButton>
        </div>
    </div>
</template>
