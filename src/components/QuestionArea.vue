<template>
  <div class="controls"><Controls :new-question="this.getNewQuestion" :set-tags="this.setTags" :tags="this.mainTags" :mode="this.mode" /></div>
  <div class="grid-container">
    <div class="space-1"></div>
    <div class="question">
      <div class="question-area"><h3 class="question-text">{{ questionText }}</h3></div>
      <!-- <Question :question-text="this.questionText"></Question> -->
    </div>
    <div class="space-2"></div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
// import Question from './Question.vue'
import Controls from './Controls.vue'
import http from '../http'

@Options({
  components: {
    // Question,
    Controls
  }
})

export default class QuestionArea extends Vue {
  private mode = 'normal'
  private questionText = 'Fetching a question for you...'
  private tags: Array<string> = []
  private mainTags: Array<string> = []

  private getNewQuestion (): void {
    this.getQuestion()
  }

  private setTags (tags: Array<string>) {
    this.tags = tags
  }

  private firstLoad (): void {
    let defaultTag = ''
    if (this.mode === 'confessions') {
      defaultTag = 'confessions-game'
    }

    http.post('/graphql', {
      query: `{
          randomQuestion(tags: "${defaultTag}") {
            question
          }
          tags {
            name
          }
        }`
    }).then((response) => {
      if (response.data) {
        this.questionText = response.data.data.randomQuestion.question

        if (this.mode === 'normal') {
          for (const i in response.data.data.tags) {
            this.mainTags.push(response.data.data.tags[i].name)
          }
        }
      }
    })
  }

  private getQuestion (): void {
    const tagList = this.tags
    if (this.mode === 'confessions') {
      tagList.push('confessions-game')
    }

    http.post('/graphql', {
      query: `{ randomQuestion(tags: "${tagList.join(',')}") { question }}`
    }).then((response) => {
      if (response.data) {
        this.questionText = response.data.data.randomQuestion.question

        // Register a Google Analytics Event
        if(window.ga && ga.loaded) {
          ga("send", {
            hitType: "event",
            eventCategory: "Question",
            eventAction: "New",
            eventLabel: "Requested New Question",
          })
        }
      }
    })
  }

  created () {
    this.firstLoad()

    const loc = document.location.href
    if (loc.indexOf('#confession') > 0) {
      this.mode = 'confessions'
    }

    if (this.mode === 'confessions') {
      this.mainTags = ['career', 'family', 'money', 'sex', 'relationship']
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

/* This should be in Question.vue */
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
</style>
