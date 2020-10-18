<template>
  <div class="controls"><Controls :new-question="this.getNewQuestion" :set-tags="this.setTags" :mode="this.mode" /></div>
  <div class="grid-container">
    <div class="space-1"></div>
    <div class="question"><Question :question-text="this.questionText" /></div>
    <div class="space-2"></div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import Question from './Question.vue'
import Controls from './Controls.vue'
import http from '../http'

@Options({
  components: {
    Question,
    Controls
  }
})

export default class QuestionArea extends Vue {
  private mode = 'normal'
  private questionText = 'Fetching a question for you...'
  private tags: Array<string> = []

  private getNewQuestion (): void {
    this.getQuestion()
  }

  private setTags (tags: Array<string>) {
    this.tags = tags
  }

  private getQuestion (): void {
    const tagList = this.tags
    if (this.mode === 'confessions') {
      tagList.push('confessions-game')
    }

    http.post('/graphql', {
      query: `{
          randomQuestion(tags: "${tagList.join(',')}") {
            id question
          }
        }`
    }).then((response) => {
      if (response.data) {
        this.questionText = response.data.data.randomQuestion.question
      }
    })
  }

  created () {
    this.getQuestion()

    const loc = document.location.href
    if (loc.indexOf('#confession') > 0) {
      this.mode = 'confessions'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.grid-container {
  height: 100vh;
  width:100%;
  display: grid;
  grid-template-columns: 20% 60% 20%;
  grid-template-areas:
    "space-1 question space-2"
}
.space-1 {
  grid-area: space-1;
}
.space-2 {
  grid-area: space-2;
}
.question {
  grid-area: question;
  align-self: center;
}
@media only screen and (max-width: 480px) {
  .grid-container {
    grid-template-columns: 10% 80% 10%;
  }
}
</style>
