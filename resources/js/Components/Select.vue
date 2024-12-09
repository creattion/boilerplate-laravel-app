<script lang="ts" setup>
import { InertiaForm } from '@inertiajs/vue3';

const model = defineModel();

defineProps<{
  name: string;
  id?: string;
  description?: string;
  form?: InertiaForm<any>;
}>();
</script>

<template>
  <select
    :id="$props.id || $props.name"
    v-model="model"
    :class="[
      'focus:border-primary w-full rounded-md border-gray-300 text-sm focus:ring-0 focus:ring-opacity-50',
      'dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
      $attrs.class,
    ]"
    :name="$props.name"
    v-bind="$attrs"
  >
    <slot />
  </select>

  <span
    v-if="description"
    class="block text-[0.72rem] text-gray-500 dark:text-gray-400"
  >
    {{ description }}
  </span>

  <span v-if="form?.errors?.[$props.name]" class="block text-xs text-red-500">
    {{ form?.errors?.[$props.name] }}
  </span>
</template>
