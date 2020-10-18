<template>
  <div class="controls-area">
    <div id="tags-area">
      <div id="filters" v-if="this.showFilterFlag">
        <ul>
          <TagChoice v-for="(tag, index) in this.tags" :key="index" :index="index" :tag="tag" :change="this.onTagSelect"></TagChoice>
        </ul>
      </div>

      <span class="fab tags">
        <span class="fab-text" v-on:click="toggleFilters()"><span class="fab-q">T</span>ags</span>
      </span>
    </div>

    <span class="fab que">
      <span class="fab-text" v-on:click="getNewQuestion()"><span class="fab-q">Q</span>ue</span>
    </span>
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
    setTags: Function,
    mode: String
  }
})

export default class Question extends Vue {
  newQuestion!: Function
  setTags!: Function
  mode: string
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

  created () {
    if (this.mode === 'confessions') {
      this.tags = ['career', 'family', 'money', 'sex', 'relationship']
    }
  }
}
</script>

<style scoped>
.fab {
  position: absolute;
  bottom: 10px;
  display: block;
  width: 56px;
  height: 56px;
  background-color: #29B6F6;
  border-radius: 50%;
}
.fab .fab-text {
  display: inline-block;
  width: 56px;
  height: 56px;
  font-size: 1em;
  color: #fff;
  line-height: 56px;
  text-align: center;
}
.fab .fab-q {
  font-size: 2em;
}
.fab.que {
  right: 10px;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
}
.fab.tags {
  left: 10px;
}
.fab.tags .fab-q {
  font-size: 1.5em;
}
#filters {
  position: absolute;
  bottom: 8px;
  left: 10px;
  background-color: #29B6F6;
  border-radius: 10px;
  padding: 5px 5px 62px 5px;
  transition: ease-in-out;
  animation: expand 0.4s ease;
}
#filters ul {
  list-style: none;
  margin:0;
  padding:0;
}

@keyframes expand {
    0% {
        width: 0;
        height: 0;
    }
    100% {
        width: auto;
        height: auto;
    }
}
</style>
