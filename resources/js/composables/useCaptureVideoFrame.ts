import { Ref } from 'vue';

export const useCaptureVideoFrame = (
    videoElementRef: Ref<HTMLVideoElement | undefined>,
) => {
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    const captureFrame = async () =>
        new Promise<Blob | null>((resolve, reject) => {
            if (!videoElementRef.value) {
                return reject('No video element');
            }

            const videoMediaProvider = videoElementRef.value.srcObject;
            if (!(videoMediaProvider instanceof MediaStream)) {
                return reject('Video srcObject is not a MediaStream');
            }
            const stream = videoMediaProvider
                .getVideoTracks()[0]
                ?.getSettings();
            if (!stream.width || !stream.height) {
                return reject('No stream size');
            }

            if (!context) {
                return reject('No context 2d for canvas');
            }

            canvas.height = stream.height;
            canvas.width = stream.width;

            context.translate(canvas.width, 0);
            context.scale(-1, 1);

            context.drawImage(
                videoElementRef.value,
                0,
                0,
                stream.width,
                stream.height,
                0,
                0,
                stream.width,
                stream.height,
            );

            canvas.toBlob((image) => resolve(image));
        });

    return { captureFrame };
};
