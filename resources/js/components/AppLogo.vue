<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { SharedData } from '@/types';
import { usePage } from '@inertiajs/vue3';

const name = usePage<SharedData>().props.name;
</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md">
        <AppLogoIcon />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 leading-none font-semibold">{{ name }}</span>
    </div>
</template>
