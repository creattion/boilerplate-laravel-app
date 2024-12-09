<template>
  <td :class="['px-4 py-3', $attrs.class]" v-bind="$attrs">
    <slot />
  </td>
</template>
