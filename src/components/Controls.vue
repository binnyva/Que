<template>
  <div class="controls-area">
    <div id="filters" v-if="this.showFilterFlag">
      <ul>
        <TagChoice v-for="(tag, index) in this.tags" :key="index" :index="index" :tag="tag" :change="this.onTagSelect"></TagChoice>
      </ul>
    </div>
    <button v-on:click="toggleFilters()">Toggle Filters</button>
    <button v-on:click="getNewQuestion()">New Question</button>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import TagChoice from './TagChoice.vue'

@Options({
  components: {
    TagChoice
  },
  props: {
    newQuestion: Function,
    setTags: Function
  }
})

export default class Question extends Vue {
  newQuestion!: Function
  setTags!: Function
  showFilterFlag = false
  tags = ['deep', 'nostalgic']
  selectedTags: Array<string> = []

  private toggleFilters (): void {
    this.showFilterFlag = !this.showFilterFlag
  }

  private getNewQuestion (): void {
    this.newQuestion()
  }

  private onTagSelect (e: {target: HTMLInputElement}): void {
    const ele = e.target
    if (ele.checked) {
      this.selectedTags.push(ele.value)
    } else {
      this.selectedTags = this.selectedTags.filter((val) => val !== ele.value)
    }

    this.setTags(this.selectedTags)
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#filters {
  position: absolute;
  bottom: 30px;
  right: 160px;
}
#filters ul {
  list-style: none;
}
</style>
