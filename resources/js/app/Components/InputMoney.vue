<script lang="ts" setup>
import { InertiaForm } from '@inertiajs/vue3';
import { format, unformat, VMoneyOptions } from 'v-money3';
import { useTemplateRef } from 'vue';

const input = useTemplateRef('input');

defineExpose({
  focus: () => {
    input.value?.focus();
  },
});

const props = defineProps<{
  defaultValue?: string | number;
  name: string;
  id?: string;
  description?: string;
  error?: string;
  form?: InertiaForm<any>;
  customConfig?: Partial<VMoneyOptions>;
}>();

const config: VMoneyOptions = {
  prefix: 'R$ ',
  thousands: '.',
  decimal: ',',
  masked: false,
  precision: 2,
  disableNegative: false,
  disabled: false,
  min: null,
  max: null,
  allowBlank: true,
  modelModifiers: {
    number: false,
  },
  shouldRound: true,
  focusOnRight: false,
  ...props.customConfig,
};

const model = defineModel({
  get(value: string) {
    return format(value, config);
  },
  set(value) {
    if (!value) {
      return null;
    }

    return unformat(value, config);
  },
});
</script>

<template>
  <input
    :id="$props.id || $props.name"
    ref="input"
    v-model.lazy="model"
    v-money3="config"
    :class="[
      'focus:border-primary focus:shadow-outline-primary form-input block w-full rounded-md border-gray-300 bg-white text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
      $attrs.class,
    ]"
    :name="$props.name"
    autocomplete="off"
    v-bind="$attrs"
  />

  <span
    v-if="description"
    class="mb-1 block text-[0.72rem] text-gray-500 dark:text-gray-400"
  >
    {{ description }}
  </span>

  <span v-if="error" class="block text-xs text-red-500">
    {{ error }}
  </span>
</template>
