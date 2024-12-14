<script setup lang="ts">
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';
import { ChevronUpIcon } from '@heroicons/vue/24/solid';
import { computed } from 'vue';

const props = defineProps<{
    discrete?: boolean;
}>();

const buttonClasses = computed(() => {
    if (props.discrete) {
        return '-my-2';
    }

    return 'px-4 bg-amber-100 text-amber-900 hover:bg-amber-200 ';
});
</script>
<template>
    <div>
        <Disclosure v-slot="{ open }">
            <DisclosureButton
                class="flex w-full items-center justify-between rounded-lg py-2 text-left focus:outline-none focus-visible:ring focus-visible:ring-amber-500/75"
                :class="[buttonClasses]"
            >
                <slot name="button" />

                <ChevronUpIcon
                    :class="[
                        open ? 'rotate-180 transform' : '',
                        discrete &&
                            'rounded-md border border-amber-100 bg-amber-50 p-1',
                    ]"
                    class="box-content size-5 text-amber-600"
                />
            </DisclosureButton>
            <DisclosurePanel class="pb-2 pt-4" :class="!discrete && 'px-4'">
                <slot />
            </DisclosurePanel>
        </Disclosure>
    </div>
</template>
