<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import {
  ChevronLeft,
  ChevronRight,
  ChevronsLeft,
  ChevronsRight,
} from 'lucide-vue-next';

defineProps<{
  data: Partial<App.Paginate<object>>;
}>();
</script>

<template>
  <div
    class="grid border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400"
  >
    <span class="col-span-3 flex items-center">
      Exibindo {{ data.from || 0 }}-{{ data.to || 0 }} de
      {{ data.total }} registros
    </span>
    <span class="col-span-2"></span>
    <!-- Pagination -->
    <span class="col-span-4 mt-2 flex sm:mt-auto sm:justify-end">
      <nav aria-label="Table navigation">
        <ul class="inline-flex items-center gap-2">
          <li>
            <Link
              :class="{
                'disabled pointer-events-none opacity-50': !data.links?.[0].url,
              }"
              :disabled="!data.links?.[0].url"
              :href="data.links?.[0].url || ''"
              aria-label="Previous"
              class="focus:shadow-outline-purple flex rounded-md rounded-l-lg py-1 focus:outline-none"
              title="Primeira página"
            >
              <ChevronsLeft />
            </Link>
          </li>
          <li v-for="link of data.links" :key="link.label">
            <Link
              :class="{
                'disabled pointer-events-none opacity-50': !link.url,
                'bg-primary-600 border-primary-600 border border-r-0 text-white transition-colors duration-150':
                  link.active,
              }"
              :disabled="!link.url"
              :href="link.url || ''"
              :title="`Ir para página ${link.label}`"
              class="focus:shadow-outline-primary rounded-md px-3 py-1 focus:outline-none"
            >
              <span
                v-if="
                  !link.label.includes('Próximo') &&
                  !link.label.includes('Anterior')
                "
                v-html="link.label"
              ></span>
              <ChevronRight v-if="link.label.includes('Próximo')" />
              <ChevronLeft v-if="link.label.includes('Anterior')" />
            </Link>
          </li>
          <li>
            <Link
              :class="{
                'disabled pointer-events-none opacity-50':
                  !data.links?.[data.links?.length - 1].url,
              }"
              :disabled="!data.links?.[data.links?.length - 1].url"
              :href="data.links?.[data.links?.length - 1].url || ''"
              aria-label="Previous"
              class="focus:shadow-outline-purple flex rounded-md rounded-l-lg py-1 focus:outline-none"
              title="Última página"
            >
              <ChevronsRight />
            </Link>
          </li>
        </ul>
      </nav>
    </span>
  </div>
</template>
