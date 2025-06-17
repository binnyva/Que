<template>
  <QuestionArea />
</template>

<script lang="ts">
import QuestionArea from './components/QuestionArea.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'App',
  components: {
    QuestionArea,
  },
})
</script>

<style>
body {
  height: 100vh;
  margin: 0;
  padding: 0;
}

:root {
  --color-dark: #2c3e50;
  --color-dark-transparent: rgba(44, 62, 80, 1);
  --color-light: #c3d6ed;
  --color-light-transparent: rgba(195, 214, 237, 1);
  --color-mid: #3a73ad;
  --color-light-transparent: rgba(58, 115, 173, 1);
}

/* Theming */

@media (prefers-color-scheme: dark) {
  :root {
    --color-light: #2c3e50;
    --color-light-transparent: rgba(44, 62, 80, 1);
    --color-dark: #c3d6ed;
    --color-dark-transparent: rgba(195, 214, 237, 1);
  }
}

body {
  background: var(--color-dark);
  color: var(--color-light);
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
