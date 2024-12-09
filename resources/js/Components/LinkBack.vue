<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronLeft } from 'lucide-vue-next';
import { computed } from 'vue';

const urlBack = computed(() => usePage().props.app.back_url);

withDefaults(
  defineProps<{
    text?: string;
    url?: string;
  }>(),
  {
    text: 'Voltar',
  },
);
</script>

<template>
  <Link
    class="focus:shadow-outline-gray flex items-center justify-center gap-2 rounded-lg border border-transparent bg-gray-600 px-4 py-2 text-center text-sm font-medium uppercase leading-5 text-white transition-colors duration-150 hover:bg-gray-700 focus:outline-none active:bg-gray-600 disabled:opacity-70"
    as="button"
    type="button"
    v-if="url || urlBack"
    :href="url || urlBack"
    v-bind="$attrs"
  >
    <ChevronLeft class="h-4 w-4" />
    {{ text }}
  </Link>
</template>
