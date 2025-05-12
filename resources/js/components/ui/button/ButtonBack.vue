<script setup lang="ts">
import Button from './Button.vue';

const backButton = () => window.history.back();
</script>

<template>
  <Button variant="destructive" as="a" @click="backButton">
    <slot />
  </Button>
</template>
