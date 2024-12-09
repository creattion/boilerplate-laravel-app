<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';

defineProps<{
  href: string;
  active?: boolean;
}>();
</script>

<template>
  <li
    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
  >
    <Link
      :class="['block w-full text-gray-500', { 'text-primary': active }]"
      :href="href"
    >
      <slot />
    </Link>
  </li>
</template>

<style scoped></style>
