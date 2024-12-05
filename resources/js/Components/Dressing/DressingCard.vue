<script setup lang="ts">
import { DressingDto } from '@/types/generated';

defineProps<{
    dressing: DressingDto;
}>();
</script>
<template>
    <div class="flex flex-col rounded-xl bg-amber-100 p-4">
        <span class="text-amber-950">{{ $t('dressing') }}</span>
        <span class="text-2xl text-amber-800">{{ dressing.name }}</span>
        <span class="text-amber-950">{{
            $t('vetements', dressing.clothesCount)
        }}</span>
    </div>
</template>
