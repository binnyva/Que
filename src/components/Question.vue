<template>
  <div class="question-area">
      <h3 class="question-text">{{ questionText }}</h3>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
  props: {
    questionText: String
  }
})

export default class Question extends Vue {
  questionText!: string
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.question-area {
    align-self: center;
}
.question-text {
    font-size: 5em;
    margin: auto 0;
    text-align: center;
}

/* :TODO: Diffent font/color for different type of questions. Grey for philosaphical, comic-sans for funny, etc */
</style>
