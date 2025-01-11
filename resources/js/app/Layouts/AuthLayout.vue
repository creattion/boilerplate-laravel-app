<script setup lang="ts">
import Toasts from '@app/Components/Toasts.vue';
</script>

<template>
  <div class="flex min-h-screen items-center bg-gray-50 p-6 dark:bg-gray-900">
    <div
      class="mx-auto h-full max-w-4xl flex-1 overflow-hidden rounded-lg bg-white shadow-xl dark:bg-gray-800"
    >
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <slot />
      </div>
    </div>
  </div>

  <Toasts />
</template>
