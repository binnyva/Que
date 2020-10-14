<template>
  <li>
    <input type="checkbox" v-bind:id="`tag-${index}`" v-bind:value="tag" v-on:change="this.change" />
    <label v-bind:for="`tag-${index}`">{{ tag }}</label>
  </li>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
  props: {
    tag: String,
    index: Number,
    change: Function
  }
})

export default class TagChoice extends Vue {
  tag!: string
  index!: number
  change!: Function
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
