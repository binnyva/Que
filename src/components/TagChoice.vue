<template>
  <li>
    <input
      type="checkbox"
      v-bind:id="`tag-${index}`"
      v-bind:value="tag"
      v-on:change="this.change"
      :checked="this.checked"
    />
    <label v-bind:for="`tag-${index}`">{{ tag }}</label>
  </li>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'TagChoice',
  props: {
    tag: {
      type: String,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
    change: {
      type: Function,
      required: true,
    },
    checked: {
      type: Boolean,
      default: false,
    },
  },
})
</script>
