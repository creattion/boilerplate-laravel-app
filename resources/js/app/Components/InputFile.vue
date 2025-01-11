<script lang="ts" setup>
const model = defineModel();

defineProps<{
  id?: string;
  name: string;
  description?: string;
  error?: string;
}>();

const handleFile = (event: Event) => {
  const target = event.target as HTMLInputElement;

  model.value = target.files;
};
</script>

<template>
  <input
    :id="id || name"
    :class="[
      'block w-full cursor-pointer rounded-lg border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-gray-50 file:px-4 file:py-2 focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:file:bg-neutral-700 dark:file:text-neutral-400',
      { 'border-red-500': error },
      $attrs.class,
    ]"
    :name="name"
    type="file"
    v-bind="$attrs"
    @change="handleFile"
  />
  <span v-if="description" class="mb-1 block text-[0.72rem] text-gray-500">
    {{ description }}
  </span>
  <span v-if="error" class="mt-2 block text-xs text-red-500">
    {{ error }}
  </span>
</template>
