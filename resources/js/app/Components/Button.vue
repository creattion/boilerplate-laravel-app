<script lang="ts" setup>
export type ButtonVariants =
  | 'primary'
  | 'secondary'
  | 'dark'
  | 'black'
  | 'green'
  | 'red'
  | 'blue'
  | 'yellow'
  | 'orange'
  | 'gray'
  | 'white'
  | 'outline'
  | 'slate'
  | 'zinc'
  | 'amber'
  | 'sky'
  | 'purple'
  | 'pink'
  | 'indigo';

withDefaults(
  defineProps<{
    type?: HTMLButtonElement['type'];
    loading?: boolean;
    variant?: ButtonVariants;
  }>(),
  {
    type: 'submit',
    variant: 'primary',
  },
);
</script>

<template>
  <button
    :class="[
      {
        'bg-primary active:bg-primary hover:bg-primary-hover focus:shadow-outline-primary text-white':
          variant === 'primary',
        'focus:shadow-outline-gray bg-gray-400 text-white hover:bg-gray-500 active:bg-gray-600':
          variant === 'secondary',
        'focus:shadow-outline-green bg-green-600 text-white hover:bg-green-700 active:bg-green-600':
          variant === 'green',
        'focus:shadow-outline-red bg-red-600 text-white hover:bg-red-700 active:bg-red-600':
          variant === 'red',
        'focus:shadow-outline-blue bg-blue-600 text-white hover:bg-blue-700 active:bg-blue-600':
          variant === 'blue',
        'focus:shadow-outline-yellow bg-yellow-600 text-white hover:bg-yellow-700 active:bg-yellow-600':
          variant === 'yellow',
        'focus:shadow-outline-orange bg-orange-600 text-white hover:bg-orange-700 active:bg-orange-600':
          variant === 'orange',
        'focus:shadow-outline-gray bg-gray-800 text-white hover:bg-gray-900 active:bg-gray-800':
          variant === 'dark' || variant === 'black',
        'focus:shadow-outline-gray bg-gray-600 text-white hover:bg-gray-700 active:bg-gray-600':
          variant === 'gray',
        'focus:shadow-outline-white bg-white text-gray-800 hover:bg-gray-100 active:bg-white':
          variant === 'white',
        'border border-gray-300 hover:bg-gray-50 dark:border-gray-700':
          variant === 'outline',
        'focus:shadow-outline-slate bg-slate-600 text-white hover:bg-slate-700 active:bg-slate-600':
          variant === 'slate',
        'focus:shadow-outline-zinc bg-zinc-600 text-white hover:bg-zinc-700 active:bg-zinc-600':
          variant === 'zinc',
        'focus:shadow-outline-amber bg-amber-600 text-white hover:bg-amber-700 active:bg-amber-600':
          variant === 'amber',
        'focus:shadow-outline-sky bg-sky-600 text-white hover:bg-sky-700 active:bg-sky-600':
          variant === 'sky',
        'focus:shadow-outline-purple bg-purple-600 text-white hover:bg-purple-700 active:bg-purple-600':
          variant === 'purple',
        'focus:shadow-outline-pink bg-pink-600 text-white hover:bg-pink-700 active:bg-pink-600':
          variant === 'pink',
        'focus:shadow-outline-indigo bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-600':
          variant === 'indigo',
      },
      $props.class,
    ]"
    :disabled="loading"
    :type="type"
    class="flex items-center justify-center gap-2 rounded-md px-4 py-2 text-center text-sm font-medium uppercase leading-5 transition-colors duration-150 focus:outline-none disabled:cursor-not-allowed disabled:opacity-70"
    v-bind="$attrs"
  >
    <svg
      v-if="loading"
      fill="white"
      height="18"
      viewBox="0 0 24 24"
      width="18"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        class="spinner-loading"
        d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z"
      />
    </svg>
    <slot />
  </button>
</template>

<style>
.spinner-loading {
  transform-origin: center;
  animation: spinner-loading 0.75s infinite linear;
}
@keyframes spinner-loading {
  100% {
    transform: rotate(360deg);
  }
}
</style>
