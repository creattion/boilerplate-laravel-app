<script setup lang="ts">
import Toasts from '@/Components/Toasts.vue';
</script>

<template>
  <div class="flex min-h-screen items-center bg-gray-50 p-6">
    <div
      class="mx-auto h-full max-w-lg flex-1 overflow-hidden rounded-lg bg-white shadow-xl"
    >
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <slot />
      </div>
    </div>
  </div>

  <Toasts />
</template>
