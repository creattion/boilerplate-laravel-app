<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, nextTick, watch } from 'vue';
import { Toaster, toast } from 'vue-sonner';

const toasts = computed(() => {
  const page = usePage();

  if (page.props.flash) {
    renderToasts(page.props.flash || []);
  }

  return null;
});

const renderToasts = (toastsSource) => {
  toastsSource.forEach((item) => {
    nextTick(() => {
      toast[item.level === 'danger' ? 'error' : item.level](
        item.title || item.message,
        {
          duration: item.duration,
          description: item.title ? item.message : '',
        },
      );
    });
  });
};

watch(toasts, () => {});
</script>

<template>
  <Toaster position="bottom-center" :close-button="true" :rich-colors="true" />
</template>
