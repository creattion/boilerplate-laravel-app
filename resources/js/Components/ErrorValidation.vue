<script lang="ts" setup>
defineProps<{
  error?: string;
}>();
</script>

<template>
  <span v-if="error" class="block text-xs text-red-500">
    {{ error }}
  </span>
</template>
