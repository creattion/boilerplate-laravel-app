<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';
import VueSelect, { Option } from 'vue3-select-component';
import ErrorValidation from './ErrorValidation.vue';

let debounceTimeout: ReturnType<typeof setTimeout> | null = null;

defineProps<{
  error?: string;
}>();

const model = defineModel<string | number>();
const cityIsLoading = ref(false);
const cities = ref<Option<number>[]>([]);

const search = (search: string) => {
  if (!search) {
    return;
  }

  cityIsLoading.value = true;

  if (debounceTimeout) {
    clearTimeout(debounceTimeout);
  }

  debounceTimeout = setTimeout(() => {
    axios
      .get(route('admin.cities.search-json'), {
        params: { q: search },
      })
      .then(({ data }) => {
        cities.value = data.data.map((c: any) => {
          return {
            label: c.label,
            value: c.id,
          };
        });
      })
      .finally(() => {
        cityIsLoading.value = false;
      });
  }, 500);
};

const searchCity = (id: number | string) => {
  axios
    .get(route('admin.cities.search-json'), { params: { q: id } })
    .then(({ data }) => {
      cities.value = data.data.map((c: any) => {
        return {
          label: c.label,
          value: c.id,
        };
      });
    });
};

onMounted(() => {
  if (model.value) {
    searchCity(model.value);
  }
});
</script>

<template>
  <VueSelect
    v-model="model"
    :class="{ 'has-error': error }"
    :is-loading="cityIsLoading"
    :options="cities"
    input-id="city_id"
    placeholder="Digite para pesquisar uma cidade"
    @search="search"
  >
    <template #no-options> Nenhuma cidade encontrada </template>
  </VueSelect>

  <ErrorValidation :error="error" />
</template>

<style>
.vue-select.has-error .control {
  @apply border-red-500 !important;
}
</style>
