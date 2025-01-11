<script lang="ts" setup>
const model = defineModel<unknown>();

defineProps<{
  id?: string | number;
  name: string;
  error?: string;
  description?: string;
}>();
</script>

<template>
  <label class="flex w-fit cursor-pointer items-center dark:text-gray-400">
    <input
      :id="String(id || name)"
      v-model="model"
      :class="$attrs.class"
      :name="name"
      class="text-primary focus:border-primary-300 focus:ring-primary-200 cursor-pointer rounded border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 focus:ring-offset-0"
      type="checkbox"
      v-bind="$attrs"
    />
    <span class="ml-2 text-sm">
      <slot />
    </span>
  </label>

  <span v-if="description" class="mb-1 block text-[0.72rem] text-gray-500">
    {{ description }}
  </span>

  <span v-if="error" class="mt-2 block text-xs text-red-500">
    {{ error }}
  </span>
</template>
