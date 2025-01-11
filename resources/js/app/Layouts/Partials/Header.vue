<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { LogOut } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const emit = defineEmits(['toggleSideMenu']);
const isProfileMenuOpen = ref(false);
const isNotificationsMenuOpen = ref(false);

const user = computed(() => usePage().props.auth?.user);

const toggleSideMenu = () => {
  emit('toggleSideMenu');
};

const toggleProfileMenu = () => {
  isProfileMenuOpen.value = !isProfileMenuOpen.value;

  setTimeout(() => {
    if (isProfileMenuOpen.value) {
      document.addEventListener('click', closeProfileMenu);
    } else {
      document.removeEventListener('click', closeProfileMenu);
    }
  }, 500);
};

const closeProfileMenu = () => {
  isProfileMenuOpen.value = false;
  document.removeEventListener('click', closeProfileMenu);
};

const toggleNotificationsMenu = () => {
  isNotificationsMenuOpen.value = !isNotificationsMenuOpen.value;

  setTimeout(() => {
    if (isNotificationsMenuOpen.value) {
      document.addEventListener('click', closeNotificationsMenu);
    } else {
      document.removeEventListener('click', closeNotificationsMenu);
    }
  }, 500);
};

const closeNotificationsMenu = () => {
  isNotificationsMenuOpen.value = false;
  document.removeEventListener('click', closeNotificationsMenu);
};
</script>

<template>
  <header class="z-10 bg-white py-4 shadow-md dark:bg-gray-800">
    <div
      class="text-primary container mx-auto flex h-full items-center justify-between px-6"
    >
      <button
        class="focus:shadow-outline-purple -ml-1 mr-5 rounded-md p-1 focus:outline-none md:hidden"
        @click="toggleSideMenu"
        aria-label="Menu"
      >
        <svg
          class="h-6 w-6"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>

      <div class="flex flex-1 items-center gap-4 lg:mr-32">
        <div class="relative w-fit"></div>
      </div>
      <ul class="flex flex-shrink-0 items-center space-x-6">
        <li class="relative">
          <button
            class="focus:shadow-outline-purple relative rounded-md align-middle focus:outline-none"
            @click="toggleNotificationsMenu"
            @keydown.esc="closeNotificationsMenu"
            aria-label="Notifications"
            aria-haspopup="true"
          >
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
              ></path>
            </svg>
            <!-- Notification badge -->
            <span
              aria-hidden="true"
              class="absolute right-0 top-0 inline-block h-3 w-3 -translate-y-1 translate-x-1 transform rounded-full border-2 border-white bg-red-600 dark:border-gray-800"
            ></span>
          </button>
          <Transition name="fade">
            <ul
              v-show="isNotificationsMenuOpen"
              @click="closeNotificationsMenu"
              @keydown.esc="closeNotificationsMenu"
              class="absolute right-0 mt-2 w-56 space-y-2 rounded-md border border-gray-100 bg-white p-2 text-gray-600 shadow-md dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300"
              aria-label="submenu"
            >
              <li class="flex">
                <a
                  class="inline-flex w-full items-center justify-between rounded-md px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="#"
                >
                  <span>Messages</span>
                  <span
                    class="inline-flex items-center justify-center rounded-full bg-red-100 px-2 py-1 text-xs font-bold leading-none text-red-600 dark:bg-red-600 dark:text-red-100"
                  >
                    13
                  </span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex w-full items-center justify-between rounded-md px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="#"
                >
                  <span>Sales</span>
                  <span
                    class="inline-flex items-center justify-center rounded-full bg-red-100 px-2 py-1 text-xs font-bold leading-none text-red-600 dark:bg-red-600 dark:text-red-100"
                  >
                    2
                  </span>
                </a>
              </li>
              <li class="flex">
                <a
                  class="inline-flex w-full items-center justify-between rounded-md px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  href="#"
                >
                  <span>Alerts</span>
                </a>
              </li>
            </ul>
          </Transition>
        </li>
        <!-- Profile menu -->
        <li class="relative">
          <button
            class="focus:shadow-outline-purple rounded-full align-middle focus:outline-none"
            @click="toggleProfileMenu"
            @keydown.esc="closeProfileMenu"
            aria-label="Account"
            aria-haspopup="true"
          >
            <img
              class="h-8 w-8 rounded-full object-cover"
              :src="`https://ui-avatars.com/api/?name=${user?.name}`"
              alt=""
              aria-hidden="true"
            />
          </button>
          <Transition name="fade">
            <ul
              v-show="isProfileMenuOpen"
              @click="closeProfileMenu"
              @keydown.esc="closeProfileMenu"
              class="absolute right-0 mt-2 w-56 space-y-2 rounded-md border border-gray-100 bg-white p-2 text-gray-600 shadow-md dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300"
              aria-label="submenu"
            >
              <li class="flex">
                <Link
                  class="inline-flex w-full items-center rounded-md px-2 py-1 text-sm font-semibold transition-colors duration-150 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                  :href="route('logout')"
                  method="post"
                  as="button"
                >
                  <LogOut class="mr-3 h-4 w-4" />
                  <span>Sair</span>
                </Link>
              </li>
            </ul>
          </Transition>
        </li>
      </ul>
    </div>
  </header>
</template>
