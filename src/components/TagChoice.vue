<template>
  <li>
    <input type="checkbox" v-bind:id="`tag-${index}`" v-bind:value="tag" v-on:change="this.change" :checked="this.checked" />
    <label v-bind:for="`tag-${index}`">{{ tag }}</label>
  </li>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
  props: {
    tag: String,
    index: Number,
    change: Function,
    checked: Boolean
  }
})

export default class TagChoice extends Vue {
  tag!: string
  index!: number
  change!: Function
  checked!: boolean
}
</script>
