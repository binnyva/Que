<template>
  <div class="controls-area">
      <button v-on:click="getNewQuestion()">New Question</button>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
  props: {
    newQuestion: Function
  }
})

export default class Question extends Vue {
  newQuestion!: Function

  private getNewQuestion (): void {
    console.log('Fetching New Question')
    this.newQuestion()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
