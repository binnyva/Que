<template>
  <div class="grid-container">
    <div class="space-1"></div>
    <div class="question"><Question :question-text="this.questionText" /></div>
    <div class="space-2"></div>
    <div class="controls"><Controls :new-question="this.getNewQuestion" :set-tags="this.setTags" /></div>
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
  private questionText = 'Fetching a question for you...'
  private tags: Array<string> = []

  private getNewQuestion (): void {
    this.getQuestion()
  }

  private setTags (tags: Array<string>) {
    this.tags = tags
  }

  private getQuestion (): void {
    http.post('/graphql', {
      query: `{
          randomQuestion(tags: "${this.tags.join(',')}") {
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
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.grid-container {
  height: 100vh;
  width:100%;
  display: grid;
  grid-template-rows: 80% auto;
  grid-template-columns: 20% 60% 20%;
  grid-template-areas:
    "space-1 question space-2"
    "controls controls controls";
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
.controls {
  grid-area: controls;
  justify-self: end;
  align-self: end;
  padding: 0 10px 10px 0;
}
</style>
