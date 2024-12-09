<script lang="ts" setup>
import VueDatePicker from '@vuepic/vue-datepicker';

const model = defineModel<string | Date>();

withDefaults(
  defineProps<{
    id?: string;
    name: string;
    description?: string;
    error?: string;
    onlyErrorBorder?: boolean;
    minutesGridIncrement?: number;
    minutesIncrement?: number;
    showNowButton?: boolean;
    startTime?: { hours: number; minutes: number };
    format?: string;
  }>(),
  {
    onlyErrorBorder: false,
    minutesGridIncrement: 15,
    minutesIncrement: 15,
    showNowButton: true,
    startTime: () => ({ hours: new Date().getHours(), minutes: 0 }),
    format: 'dd/MM/yyyy HH:mm',
  },
);
</script>

<template>
  <VueDatePicker
    v-model="model"
    :class="[{ 'border-red-500': error }, $attrs.class]"
    :format="format"
    :minutes-grid-increment="minutesGridIncrement"
    :minutes-increment="minutesIncrement"
    :name="id || name"
    :show-now-button="showNowButton"
    :start-time="startTime"
    cancel-text="Cancelar"
    locale="pt-br"
    now-button-label="Agora"
    select-text="Ok"
    v-bind="$attrs"
  />

  <span
    v-if="description"
    class="block text-[0.72rem] text-gray-500 dark:text-gray-400"
  >
    {{ description }}
  </span>

  <span v-if="error && !onlyErrorBorder" class="block text-xs text-red-500">
    {{ error }}
  </span>
</template>
