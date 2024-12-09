<script lang="ts" setup>
import BlotFormatter2 from '@enzedonline/quill-blot-formatter2';
import '@enzedonline/quill-blot-formatter2/dist/css/quill-blot-formatter2.css';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import ErrorValidation from './ErrorValidation.vue';

withDefaults(
  defineProps<{
    error?: string;
    placeholder?: string;
  }>(),
  {
    placeholder: 'Digite o texto',
  },
);

const model = defineModel<string>();
</script>

<template>
  <quill-editor
    v-model:content="model"
    content-type="html"
    lang="pt-BR"
    style="background: #fff"
    theme="snow"
    toolbar="full"
    :modules="[{ name: 'BlotFormatter2', module: BlotFormatter2 }]"
    :placeholder="placeholder"
  ></quill-editor>

  <ErrorValidation :error="error" />
</template>
