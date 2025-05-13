<script setup lang="ts">
import { cn } from '@/lib/utils';
import { Label, type LabelProps } from 'reka-ui';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<LabelProps & { class?: HTMLAttributes['class'], optional?: boolean }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <Label
    data-slot="label"
    v-bind="delegatedProps"
    :optional="optional"
    :class="
      cn(
        'flex items-center gap-2 text-sm leading-none font-medium select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50',
        props.class,
      )
    "
  >
    <slot />
    <p class="text-red-500" v-if="!optional">*</p>
  </Label>
</template>
