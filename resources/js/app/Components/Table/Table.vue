<script lang="ts" setup>
import TdEmpty from './TdEmpty.vue';

defineProps<{
  messageEmpty?: string;
  colspanEmpty?: number;
  showEmpty?: boolean;
}>();
</script>

<template>
  <div class="w-full overflow-x-auto rounded-lg border">
    <table class="w-full text-sm">
      <thead>
        <tr
          class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
        >
          <slot name="thead" />
        </tr>
      </thead>

      <tbody class="divide-y bg-white dark:divide-gray-700 dark:bg-gray-800">
        <slot />

        <TdEmpty
          v-if="showEmpty"
          :colspan="colspanEmpty"
          :message="messageEmpty"
        />
      </tbody>
    </table>

    <slot name="pagination" />
  </div>
</template>
