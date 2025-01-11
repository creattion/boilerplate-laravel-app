<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
  href: string;
  active?: boolean;
  class?: string;
}>();
</script>

<template>
  <li class="relative px-6 py-3">
    <span
      v-if="active"
      class="bg-primary absolute inset-y-0 left-0 w-1 rounded-br-lg rounded-tr-lg"
      aria-hidden="true"
    ></span>

    <Link
      v-bind="$attrs"
      :class="[{ 'text-primary': active }, $props.class]"
      class="hover:text-primary-hover inline-flex w-full items-center text-sm font-semibold text-gray-500 transition-colors duration-150 hover:no-underline dark:hover:text-gray-200"
      :href="href"
    >
      <slot />
    </Link>
  </li>
</template>
