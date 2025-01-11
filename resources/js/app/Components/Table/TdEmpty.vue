<script lang="ts" setup>
withDefaults(
  defineProps<{
    colspan?: number;
    message?: string;
  }>(),
  {
    colspan: 40,
    message: 'Nenhum registro encontrado.',
  },
);
</script>

<template>
  <tr
    class="text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700"
  >
    <td :colspan="colspan" class="px-4 py-3 text-center">{{ message }}</td>
  </tr>
</template>
