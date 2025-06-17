<template>
  <div class="question-area">
      <h3 class="question-text">{{ questionText }}</h3>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import { Watch } from 'vue-property-decorator'

@Options({
  props: {
    questionText: String
  }
})

export default class Question extends Vue {
  questionText!: string

  @Watch('questionText')
  onQuestionTextChanged (newQ: string, oldQ: string) {
    console.log(newQ, oldQ)
  }
}
</script>

<style scoped>
.question-area {
    align-self: center;
}
.question-text {
    font-size: 4em;
    margin: auto 0;
    text-align: center;
}

@media only screen and (max-width: 480px) {
  .question-text {
    font-size: 2.5em;
  }
}

/* :TODO: Diffent font/color for different type of questions. Grey for philosaphical, comic-sans for funny, etc ? */
</style>
