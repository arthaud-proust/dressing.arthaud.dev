<script setup lang="ts">
import VToast, { type Toast } from '@/Components/Base/VToast.vue';
import { FlashMessageDto } from '@/types/generated';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';

const page = usePage();

const toasts = ref<Map<string, Toast>>(new Map());

const addToastFromMessage = (
    message: FlashMessageDto | undefined,
    type: Toast['type'],
) => {
    if (message) {
        toasts.value.set(message.id, {
            type: 'success',
            content: message.content,
        });
    }
};
const removeToast = (id: string) => {
    toasts.value.delete(id);
};

onMounted(() => {
    addToastFromMessage(page.props.flash.success, 'success');
    addToastFromMessage(page.props.flash.error, 'error');
});
watch(
    () => page.props.flash.success,
    (message) => {
        addToastFromMessage(message, 'success');
    },
);

watch(
    () => page.props.flash.error,
    (message) => {
        addToastFromMessage(message, 'error');
    },
);
</script>
<template>
    <Teleport to="body">
        <div
            class="fixed left-4 right-4 top-4 z-50 flex flex-col gap-2"
            v-if="toasts.size"
        >
            <VToast
                v-for="[id, toast] in toasts.entries()"
                :key="id"
                :content="toast.content"
                :type="toast.type"
                @close="removeToast(id)"
            />
        </div>
    </Teleport>
</template>
