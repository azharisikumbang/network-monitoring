<script setup lang="ts">
import { Network } from 'lucide-vue-next';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div>
        <Network class="text-primary h-5 w-5" />
    </div>
</template>
