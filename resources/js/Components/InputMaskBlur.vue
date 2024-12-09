<script lang="ts" setup>
import axios from 'axios';
import { CircleCheck } from 'lucide-vue-next';
import { ref, useTemplateRef } from 'vue';
import { toast } from 'vue-sonner';

let timeout: ReturnType<typeof setTimeout>;

const input = useTemplateRef('input');

defineExpose({
  focus: () => {
    input.value?.focus();
  },
});

const props = defineProps<{
  defaultValue?: string | number;
  id?: string;
  name: string;
  description?: string;
  mask: string;
  class?: string;
  form?: any;
  url: string;
  params: object;
}>();

const loading = ref(false);
const success = ref(false);
const maskedValue = ref<string | number | null | undefined>(props.defaultValue);

const submit = async () => {
  if (String(props.defaultValue) === String(maskedValue.value)) {
    return;
  }

  clearTimeout(timeout);

  loading.value = true;

  try {
    await axios.patch(props.url, {
      [props.name]: maskedValue.value,
      ...props.params,
    });

    success.value = true;

    if (maskedValue.value === '') {
      maskedValue.value = null;
    }

    timeout = setTimeout(() => {
      success.value = false;
      clearTimeout(timeout);
    });
  } catch (err) {
    if (axios.isAxiosError(err)) {
      toast.error(err?.response?.data.message);
    }

    maskedValue.value = String(props.defaultValue);
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <div class="relative w-fit">
    <input
      :id="id || name"
      ref="input"
      v-model="maskedValue"
      v-maska
      :class="[
        'hover:border-primary-600 focus:border-primary focus:shadow-outline-primary form-input block w-full rounded-md border-gray-300 bg-white text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50',
        $props.class,
        { 'border-green-400': success },
      ]"
      :data-maska="mask"
      :disabled="loading"
      :name="$props.name"
      autocomplete="off"
      v-bind="$attrs"
      @blur="submit"
    />

    <CircleCheck
      v-show="!loading && success"
      class="absolute right-2 top-1/2 h-4 w-4 -translate-y-1/2 transform text-green-600 transition-all"
    />

    <svg
      v-if="loading"
      class="fill-primary absolute right-2 top-1/2 -translate-y-1/2 transform transition-all"
      height="18"
      viewBox="0 0 24 24"
      width="18"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        class="spinner-loading"
        d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z"
      />
    </svg>
  </div>

  <span v-if="description" class="mb-1 block text-[0.72rem] text-gray-500">
    {{ description }}
  </span>
</template>
