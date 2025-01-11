<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Menu from './Menu.vue';

const name = computed(() => usePage().props.app.name);

defineProps<{
  keyRoute: string;
}>();
</script>

<template>
  <aside
    class="z-20 hidden w-64 flex-shrink-0 overflow-y-auto bg-white shadow-md md:block dark:bg-gray-800"
  >
    <div class="py-4 text-gray-500">
      <Link
        class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
        href="/"
      >
        {{ name }}
      </Link>

      <Menu :key="keyRoute" />
    </div>
  </aside>
</template>
