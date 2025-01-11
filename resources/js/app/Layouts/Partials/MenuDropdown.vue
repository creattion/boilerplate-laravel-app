<script setup lang="ts">
import { ChevronDown } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

const props = defineProps<{
  active?: boolean;
  class?: string;
}>();

const opened = ref(false);

const togglePagesMenu = () => {
  opened.value = !opened.value;
};

onMounted(() => {
  if (props.active) {
    opened.value = true;
  }
});
</script>

<template>
  <li class="relative px-6 py-3">
    <span
      v-if="active"
      class="bg-primary absolute inset-y-0 left-0 w-1 rounded-br-lg rounded-tr-lg"
      aria-hidden="true"
    ></span>

    <button
      class="inline-flex w-full items-center justify-between text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
      @click="togglePagesMenu"
      aria-haspopup="true"
    >
      <span :class="['inline-flex items-center', { 'text-primary': active }]">
        <slot />
      </span>
      <ChevronDown
        :class="[
          'h-4 w-4 transition-transform',
          { 'text-primary': active },
          opened ? 'rotate-180' : 'rotate-0',
        ]"
      />
    </button>
    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <template v-if="opened">
        <ul
          class="mt-2 space-y-2 overflow-hidden rounded-md bg-gray-50 p-2 text-sm font-medium text-gray-500 shadow-inner dark:bg-gray-900 dark:text-gray-400"
          aria-label="submenu"
        >
          <slot name="menu" />
        </ul>
      </template>
    </transition>
  </li>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.1s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
