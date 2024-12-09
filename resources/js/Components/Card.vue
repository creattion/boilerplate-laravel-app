<script setup lang="ts">
defineProps<{
  title: string;
  value: number | string;
  color: 'red' | 'green' | 'blue' | 'orange' | 'gray';
}>();
</script>

<template>
  <div
    class="shadow-xs flex items-center rounded-lg bg-white p-4 dark:bg-gray-800"
  >
    <div
      class="mr-4 rounded-full p-3"
      :class="`text-${color}-500 bg-${color}-100 dark:text-${color}-100 dark:bg-${color}-500`"
    >
      <slot name="icon" />
    </div>
    <div>
      <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        {{ title }}
      </p>
      <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
        {{ value }}
      </p>
    </div>
  </div>
</template>
