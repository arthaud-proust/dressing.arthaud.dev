import { useDevicesList } from '@vueuse/core';
import { computed, ref } from 'vue';

export const useCamera = ({
    onStream,
}: {
    onStream: (stream: MediaStream | null) => void;
}) => {
    const cameraIndex = ref<number>(-1);
    const { videoInputs: cameras } = useDevicesList();
    const isLoading = ref(false);
    const error = ref<any>();
    let stream = null as MediaStream | null;

    const camera = computed<MediaDeviceInfo | undefined>(
        () => cameras.value[cameraIndex.value],
    );

    const startCameraStream = () =>
        new Promise<void>((resolve, reject) => {
            stopCameraStream();

            isLoading.value = true;

            const constraints: MediaStreamConstraints = {
                audio: false,
                video: {
                    deviceId: camera.value?.deviceId,
                },
            };

            navigator.mediaDevices
                .getUserMedia(constraints)
                .then((mediaStream) => {
                    stream = mediaStream;
                    onStream(mediaStream);
                    resolve();
                })
                .catch((e) => {
                    error.value = e;
                    console.error(e);
                    reject(e);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        });

    const stopCameraStream = () =>
        stream?.getTracks().forEach((track) => track.stop());

    const selectCamera = async (index: number) => {
        if (index < 0 || cameras.value.length <= index) {
            cameraIndex.value = 0;
        } else {
            cameraIndex.value = index;
        }

        await startCameraStream();
    };

    const selectNextCamera = () => selectCamera(cameraIndex.value + 1);

    const canSelectNextCamera = computed(() => cameras.value.length > 1);

    const selectRearCamera = async () => {
        const rearCameraIndex = cameras.value.findIndex(
            (device) =>
                device.label?.includes('rear') ||
                device.label?.includes('back'),
        );
        await selectCamera(rearCameraIndex);
    };

    return {
        canSelectNextCamera,
        selectCamera,
        selectRearCamera,
        selectNextCamera,
        startCameraStream,
        stopCameraStream,
        isLoading,
        error,
    };
};
