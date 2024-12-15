import { useDevicesList } from '@vueuse/core';
import { computed, ref, watch } from 'vue';

export const useCamera = ({
    onCamerasUpdated,
    onStream,
}: {
    onCamerasUpdated?: (cameras: Array<MediaDeviceInfo>) => void;
    onStream?: (stream: MediaStream | null) => void;
}) => {
    const cameraIndex = ref<number>(-1);
    const { videoInputs: cameras } = useDevicesList({
        requestPermissions: true,
    });
    const isLoading = ref(false);
    const error = ref<any>();
    let stream = null as MediaStream | null;

    watch(cameras, (c) => {
        console.log(c);
        onCamerasUpdated && onCamerasUpdated(c);
    });

    const selectedCamera = computed<MediaDeviceInfo | undefined>(
        () => cameras.value[cameraIndex.value],
    );

    const startCameraStream = () =>
        new Promise<void>((resolve, reject) => {
            stopCameraStream();

            isLoading.value = true;

            const constraints: MediaStreamConstraints = {
                audio: false,
                video: {
                    deviceId: selectedCamera.value?.deviceId,
                },
            };

            navigator.mediaDevices
                .getUserMedia(constraints)
                .then((mediaStream) => {
                    stream = mediaStream;
                    onStream && onStream(mediaStream);
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

    const isRearCamera = (camera?: MediaDeviceInfo) =>
        camera &&
        (camera.label?.includes('rear') || camera.label?.includes('back'));

    const selectRearCamera = async () =>
        await selectCamera(cameras.value.findIndex(isRearCamera));

    const isSelectedCameraMirrored = computed(
        () => !isRearCamera(selectedCamera.value),
    );
    return {
        canSelectNextCamera,
        selectCamera,
        selectRearCamera,
        selectNextCamera,
        startCameraStream,
        stopCameraStream,
        isLoading,
        error,
        isSelectedCameraMirrored,
    };
};
