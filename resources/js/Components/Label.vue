<script lang="ts" setup>
defineProps<{
  required?: boolean;
  class?: string;
}>();
</script>

<template>
  <label :class="$props.class" class="mb-1 block text-sm" v-bind="$attrs">
    <span class="font-bold text-gray-700 dark:text-gray-300">
      <slot />
      <span v-if="required" class="text-red-500"> *</span>
    </span>
  </label>
</template>
