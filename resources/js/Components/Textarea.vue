<script lang="ts" setup>
const model = defineModel<string>();

defineProps<{
  name: string;
  id?: string;
  description?: string;
  error?: string;
}>();
</script>

<template>
  <textarea
    :id="$props.id || $props.name"
    v-model="model"
    :class="[
      'focus:border-primary focus:shadow-outline-primary form-input block w-full rounded-md border-gray-300 bg-white text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
      $attrs.class,
    ]"
    :name="$props.name"
    v-bind="$attrs"
  ></textarea>

  <span
    v-if="$attrs.maxlength"
    class="mb-1 block text-[0.7rem] text-gray-500 dark:text-gray-400"
  >
    {{ model?.length || 0 }}/{{ $attrs.maxlength }} caracteres
  </span>

  <span
    v-if="description"
    class="mb-1 block text-[0.7rem] text-gray-500 dark:text-gray-400"
  >
    {{ description }}
  </span>

  <span v-if="error" class="mt-2 block text-xs text-red-500">
    {{ error }}
  </span>
</template>
