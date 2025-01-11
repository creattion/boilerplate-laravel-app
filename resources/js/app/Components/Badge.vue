<script lang="ts" setup>
export type TypeBadge =
  | 'green'
  | 'blue'
  | 'red'
  | 'yellow'
  | 'primary'
  | 'gray'
  | 'purple'
  | 'amber'
  | 'lime'
  | 'cyan'
  | 'violet'
  | 'pink'
  | 'orange'
  | 'indigo'
  | 'slate';

withDefaults(
  defineProps<{
    text?: string | number;
    type?: TypeBadge;
  }>(),
  {
    type: 'gray',
  },
);
</script>

<template>
  <span
    :class="{
      'border border-green-200 bg-green-50 text-green-600 dark:bg-green-700 dark:text-green-100':
        type === 'green',
      'border border-blue-200 bg-blue-50 text-blue-600 dark:bg-blue-700 dark:text-blue-100':
        type === 'blue',
      'border border-red-200 bg-red-50 text-red-600 dark:bg-red-700 dark:text-red-100':
        type === 'red',
      'border border-yellow-200 bg-yellow-50 text-yellow-600 dark:bg-yellow-700 dark:text-yellow-100':
        type === 'yellow',
      'text-primary bg-primary-50 dark:bg-primary border-primary border dark:text-purple-100':
        type === 'primary',
      'border border-gray-200 bg-gray-50 text-gray-600 dark:bg-gray-700 dark:text-gray-50':
        type === 'gray',
      'border border-purple-200 bg-purple-50 text-purple-600 dark:bg-purple-700 dark:text-purple-100':
        type === 'purple',
      'border border-amber-200 bg-amber-50 text-amber-600 dark:bg-amber-700 dark:text-amber-100':
        type === 'amber',
      'border border-lime-200 bg-lime-50 text-lime-600 dark:bg-lime-700 dark:text-lime-100':
        type === 'lime',
      'border border-cyan-200 bg-cyan-50 text-cyan-600 dark:bg-cyan-700 dark:text-cyan-100':
        type === 'cyan',
      'border border-violet-200 bg-violet-50 text-violet-600 dark:bg-violet-700 dark:text-violet-100':
        type === 'violet',
      'border border-pink-200 bg-pink-50 text-pink-600 dark:bg-pink-700 dark:text-pink-100':
        type === 'pink',
      'border border-slate-200 bg-slate-50 text-slate-600 dark:bg-slate-700 dark:text-slate-100':
        type === 'slate',
      'border border-orange-200 bg-orange-50 text-orange-600 dark:bg-orange-700 dark:text-orange-100':
        type === 'orange',
      'border border-indigo-200 bg-indigo-50 text-indigo-600 dark:bg-indigo-700 dark:text-indigo-100':
        type === 'indigo',
    }"
    class="block w-fit rounded-full px-2 py-1 text-center text-xs font-semibold leading-tight"
  >
    {{ text }}
    <slot />
  </span>
</template>
