<script lang="ts" setup>
import Toasts from '@/Components/Toasts.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Modal } from '../../../vendor/emargareten/inertia-modal/dist/inertia-modal';
import ASide from './Partials/ASide.vue';
import Header from './Partials/Header.vue';
import Menu from './Partials/Menu.vue';

const name = computed(() => usePage().props.app.name);
const isSideMenuOpen = ref(false);

const toggleSideMenu = () => {
  isSideMenuOpen.value = !isSideMenuOpen.value;
};

const closeSideMenu = () => {
  isSideMenuOpen.value = false;
};
</script>

<template>
  <div
    :class="{ 'overflow-hidden': isSideMenuOpen }"
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    @keydown.esc="closeSideMenu"
  >
    <ASide :key-route="String(route().current())" />

    <Transition name="backdrop">
      <div
        v-show="isSideMenuOpen"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        @click="closeSideMenu"
      ></div>
    </Transition>
    <Transition name="aside">
      <aside
        v-show="isSideMenuOpen"
        class="fixed inset-y-0 z-20 mt-16 w-64 flex-shrink-0 overflow-y-auto bg-white md:hidden dark:bg-gray-800"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <Link
            href="#"
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
          >
            {{ name }}
          </Link>

          <Menu
            :key="String(route().current())"
            @closeSideMenu="closeSideMenu"
          />
        </div>
      </aside>
    </Transition>

    <div class="flex flex-1 flex-col">
      <Header @toggleSideMenu="toggleSideMenu" />

      <main class="h-full overflow-y-auto pb-16">
        <div class="container mx-auto grid flex-col px-6">
          <slot />
        </div>
      </main>
    </div>
  </div>

  <Toasts />
  <Modal />
</template>

<style>
.backdrop-enter-active,
.backdrop-leave-active {
  @apply transition duration-150 ease-in-out;
}

.backdrop-enter-from,
.backdrop-leave-to {
  @apply opacity-0;
}

.aside-enter-active {
  @apply transition duration-100 ease-in-out;
}

.aside-leave-active {
  @apply transition duration-100 ease-in-out;
}

.aside-enter-from {
  @apply -translate-x-20 transform opacity-0;
}

.aside-leave-to {
  @apply -translate-x-40 transform opacity-100;
}
</style>
