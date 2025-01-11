<script setup lang="ts">
import { rootDomain } from '@/common/Utils';
import Button from '@app/Components/Button.vue';
import Input from '@app/Components/Input.vue';
import Label from '@app/Components/Label.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const loading = ref(false);
const { app } = usePage().props;
const domain = rootDomain(window.location.hostname);

const submit = () => {};
</script>

<template>
  <Head title="Entrar" />

  <div class="h-32 md:h-auto md:w-1/2">
    <img
      aria-hidden="true"
      class="h-full w-full object-cover dark:hidden"
      src="https://lh3.googleusercontent.com/p/AF1QipNGC_hR-gJ9upArUWh9LwJDAb3uKpF3BwPqD6M8=s680-w680-h510"
      alt="Office"
    />
    <img
      aria-hidden="true"
      class="hidden h-full w-full object-cover dark:block"
      src="https://windmill-dashboard.vercel.app/assets/img/login-office-dark.jpeg"
      alt="Office"
    />
  </div>
  <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
    <form @submit.prevent="submit" class="w-full">
      <h1
        class="mb-4 text-center text-xl font-semibold text-gray-700 dark:text-gray-200 md:text-start"
      >
        Entrar no sistema <strong>{{ app.name }}</strong>
      </h1>

      <div class="mb-4 block">
        <Label for="email">E-mail</Label>
        <Input name="email" :placeholder="`seu-email@${domain}`" />
      </div>

      <div class="mb-4 block">
        <Label for="password">Senha</Label>
        <Input name="password" placeholder="***************" type="password" />
      </div>

      <!-- You should use a button here, as the anchor is only used for the example  -->
      <Button class="mt-4 w-full" type="submit">
        {{ loading ? 'Entrando...' : 'Entrar' }}
      </Button>

      <hr class="my-8" />

      <p class="mt-4 text-center md:text-start">
        <Link :href="route('app.password.request')" class="text-sm font-medium">
          Esqueceu sua senha?
        </Link>
      </p>
    </form>
  </div>
</template>
