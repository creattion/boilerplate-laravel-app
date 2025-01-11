<script lang="ts" setup>
import { useTemplateRef } from 'vue';

const model = defineModel<string | number>();

const input = useTemplateRef('input');

defineExpose({
  focus: () => {
    input.value?.focus();
  },
});

withDefaults(
  defineProps<{
    id?: string;
    name: string;
    description?: string;
    error?: string;
    onlyErrorBorder?: boolean;
  }>(),
  {
    onlyErrorBorder: false,
  },
);
</script>

<template>
  <input
    :id="id || name"
    ref="input"
    v-model="model"
    :class="[
      'focus:border-primary focus:shadow-outline-primary form-input block w-full rounded-md border-gray-300 bg-white text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
      { 'border-red-500': error },
      $attrs.class,
    ]"
    :name="name"
    v-bind="$attrs"
  />

  <span
    v-if="$attrs.maxlength"
    class="block text-[0.7rem] text-gray-500 dark:text-gray-400"
  >
    {{ String(model)?.length || 0 }}/{{ $attrs.maxlength }} caracteres
  </span>

  <span
    v-if="description"
    class="block text-[0.72rem] text-gray-500 dark:text-gray-400"
    v-html="description"
  >
  </span>

  <span v-if="error && !onlyErrorBorder" class="block text-xs text-red-500">
    {{ error }}
  </span>
</template>
