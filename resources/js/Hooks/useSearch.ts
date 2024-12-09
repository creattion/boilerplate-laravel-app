import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

export default function useSearch<T>(route: string) {
  const params = new URLSearchParams(window.location.search);
  const paramsFilters = Object.fromEntries(params.entries());
  const filterable = ref<T>(paramsFilters as T);
  const filtering = ref(false);

  const filter = () => {
    filtering.value = true;
    router.get(route, filterable.value, {
      replace: true,
      preserveState: true,
      onFinish: () => {
        filtering.value = false;
      },
    });
  };

  const resetFilter = () => {
    filterable.value = {};
    filter();
  };

  return {
    filterable,
    filtering,
    filter,
    resetFilter,
  };
}
