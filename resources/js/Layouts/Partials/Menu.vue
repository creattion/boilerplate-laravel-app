<script setup lang="ts">
import { House, LogOut } from 'lucide-vue-next';
import MenuLink from './MenuLink.vue';

const emit = defineEmits(['closeSideMenu']);
</script>

<template>
  <ul class="mt-6" v-bind="$attrs">
    <MenuLink
      :href="route('login')"
      :active="route().current('login')"
      @click="emit('closeSideMenu')"
    >
      <House />
      <span class="ml-2">Início</span>
    </MenuLink>

    <MenuLink
      class="outline-none focus:outline-none"
      :href="route('logout')"
      as="button"
      method="post"
      @click="emit('closeSideMenu')"
    >
      <LogOut />
      <span class="ml-2">Sair</span>
    </MenuLink>
  </ul>
</template>
