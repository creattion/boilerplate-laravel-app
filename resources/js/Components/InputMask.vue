<script lang="ts" setup>
import type { MaskaDetail } from 'maska';
import { ref, watch } from 'vue';

const props = withDefaults(
  defineProps<{
    id?: string;
    name: string;
    mask: string;
    error?: string;
    raw?: boolean;
    modelValue?: string;
  }>(),
  {
    raw: true,
  },
);

const emits = defineEmits(['update:modelValue']);

const maskedValue = ref(props.modelValue);
const unmaskedValue = ref('');

defineExpose({ unmaskedValue });

watch(
  () => props.modelValue,
  (value) => {
    maskedValue.value = value;
  },
);

const emit = (val: CustomEvent<MaskaDetail>) => {
  if (props.raw) {
    emits('update:modelValue', val.detail.unmasked);
  } else {
    emits('update:modelValue', val.detail.masked);
  }
};
</script>

<template>
  <input
    :id="id || name"
    v-model="maskedValue"
    v-maska
    :class="[
      'focus:shadow-outline-purple form-input mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:border-purple-400 focus:shadow-purple-400 focus:outline-none focus:ring-purple-500 disabled:cursor-not-allowed disabled:opacity-50',
      'dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
      { 'border-red-500': error },
      $attrs.class,
    ]"
    :data-maska="mask"
    :name="name"
    v-bind="$attrs"
    @maska="emit"
  />
  <span v-if="error" class="mt-2 block text-xs text-red-500">
    {{ error }}
  </span>
</template>
