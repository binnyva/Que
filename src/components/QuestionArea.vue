<template>
  <div class="controls">
    <Controls :new-question="this.getNewQuestion" :set-tags="this.setTags" :tags="this.mainTags" :mode="this.mode" />
  </div>
  <div class="grid-container" v-on:click="screenClick()">
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
  private questionText = 'I have a question for you...'
  private tags: Array<string> = []
  private mainTags: Array<string> = []

  private fallbackQuestions = [
    'What were you really into when you were a kid?',
    'Would you rather Go canoeing or waterskiing?',
    'Have you ever lost a friend? If so, what happened?',
    'What scientific discovery would change the course of humanity overnight if it was discovered?',
    'After a long pursuit you realise someone is as keen on you as you are on them. What feelings does this bring up for you?',
    "How old were you when you learned Santa wasn't real? How did you find out?",
    'Do you always have to have the latest phone?',
    "What's your day-to-day mantra?",
    'A genie gives you three wishes! What are they?',
    'What is your favorite meal of the day?',
    'How could carousels be spiced up so they are more exciting?',
    'What was the last book you read? And When?',
    "Where would you like to be if you weren't here, and why?",
    'Have you always had the same political beliefs? Is there something that impacted them?',
    "What's the best way you or someone you know has gotten out of a ticket / trouble with the law?",
    'Has anything from your childhood made you preternaturally anxious?',
    'Who in your family would you describe as a "character"?',
    'What did you always wanted to try but never found the courage to do?',
    "Would you rather have the hiccups for the rest of your life, or always feel like you need to sneeze but can't?",
    "Where's the line between soup and cereal?",
    "What's something you've been meaning to try but just haven't gotten around to it?",
    "Where is the most interesting place you've been?",
    'If you had a family business, what would it be?',
    'If scientists could accurately predict who was more likely to commit crimes, what should society do with that information?',
    "What's the most interesting piece of art you've seen?",
    'When was the last time you stayed up through the entire night?',
    'In the past people were buried with the items they would need in the afterlife, what would you want buried with you so you could use it in the afterlife?',
    'Do athletes deserve the high salaries they receive? Why or why not?',
    'Would you rather watch a movie on your TV at home or on the big screen in the theater, and why?',
    'Who is that one person you can talk to about just anything?'
  ];

  private getNewQuestion (): void {
    this.getQuestion()
  }

  private setTags (tags: Array<string>) {
    this.tags = tags
  }

  private activeFallbackQuestion (): void {
    const randomIndex = Math.floor(Math.random() * this.fallbackQuestions.length)
    this.questionText = this.fallbackQuestions[randomIndex]
  }

  private firstLoad (): void {
    let defaultTag = ''
    if (this.mode === 'confessions') {
      defaultTag = 'confessions-game'
    }

    http.get('/api').then((response) => {
      if (response.data) {
        this.questionText = response.data.question

        if (this.mode === 'normal') {
          for (const i in response.data.tags) {
            this.mainTags.push(response.data.data.tags[i].name)
          }
        }
      }
    }).catch((error) => {
      console.error('Error fetching initial question:', error)

      this.activeFallbackQuestion()
    })
  }

  private getQuestion (): void {
    const tagList = this.tags
    if (this.mode === 'confessions') {
      tagList.push('confessions-game')
    }

    http.get('/api').then((response) => {
      if (response.data) {
        this.questionText = response.data.data.randomQuestion.question

        // Register a Google Analytics Event :TODO: This should be active. But doesn't work in local.
        // if (window.ga && ga.loaded) {
        //   ga('send', {
        //     hitType: 'event',
        //     eventCategory: 'Question',
        //     eventAction: 'New',
        //     eventLabel: 'Requested New Question'
        //   })
        // }
      }
    }).catch((error) => {
      console.error('Error fetching question:', error)
      this.activeFallbackQuestion()
    })
  }

  screenClick (): void {
    this.getNewQuestion()
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
