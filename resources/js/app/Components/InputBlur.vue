<script lang="ts" setup>
import axios from 'axios';
import { CircleCheck } from 'lucide-vue-next';
import { ref, useTemplateRef } from 'vue';
import { toast } from 'vue-sonner';

let timeout: ReturnType<typeof setTimeout>;

const loading = ref(false);
const success = ref(false);

const input = useTemplateRef('input');

defineExpose({
  focus: () => {
    input.value?.focus();
  },
});

const props = defineProps<{
  id?: string;
  name: string;
  description?: string;
  url: string;
  params: object;
  modelValue?: string | number | null;
}>();

const model = defineModel();
const defaultValue = ref<string | number | null | undefined>(props.modelValue);

const submit = async () => {
  if (String(defaultValue.value) === String(model.value)) {
    return;
  }

  clearTimeout(timeout);

  loading.value = true;

  try {
    await axios.patch(props.url, {
      [props.name]: model.value,
      ...props.params,
    });

    success.value = true;
    defaultValue.value = String(model.value);

    if (model.value === '') {
      model.value = null;
    }

    timeout = setTimeout(() => {
      success.value = false;
      clearTimeout(timeout);
    }, 3000);
  } catch (err) {
    if (axios.isAxiosError(err)) {
      toast.error(err?.response?.data.message);
    }

    model.value = props.modelValue;
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
      v-model="model"
      :class="[
        'hover:border-primary-600 focus:border-primary focus:shadow-outline-primary form-input block w-full rounded-md border-gray-300 bg-white text-sm shadow-sm read-only:cursor-not-allowed read-only:bg-gray-100 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400',
        { 'border-green-400': success },
        $attrs.class,
      ]"
      :disabled="loading"
      :name="name"
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

  <span
    v-if="description"
    class="mb-1 block text-[0.72rem] text-gray-500 dark:text-gray-400"
  >
    {{ description }}
  </span>
</template>
