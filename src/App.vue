<template>
  <QuestionArea />
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import QuestionArea from './components/QuestionArea.vue'

@Options({
  components: {
    QuestionArea
  }
})
export default class App extends Vue {}
</script>

<style>
body {
  height: 100vh;
  margin: 0;
  padding: 0;
}

/* Theming */
body { background: #eee; color: #2c3e50; }

@media (prefers-color-scheme: dark) {
  body { color: #2c3e50; background: #eee; }
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
