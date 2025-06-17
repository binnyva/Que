<template>
  <div class="controls-area">
    <div id="tags-area">
      <div id="filters" v-if="showFilterFlag">
        <ul>
          <TagChoice
            v-for="(tag, index) in tags"
            :key="index"
            :index="index"
            :tag="tag"
            :change="onTagSelect"
            :checked="checkedTags[tag]"
          ></TagChoice>
        </ul>
      </div>

      <span class="fab tags" v-if="askedQuestion > 20">
        <span class="fab-text" v-on:click="toggleFilters()"><span class="fab-q">T</span>ags</span>
      </span>
    </div>

    <span class="fab que">
      <span class="fab-text" v-on:click="getNewQuestion()"><span class="fab-q">Q</span>ue</span>
    </span>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import TagChoice from './TagChoice.vue'

export default defineComponent({
  name: 'AppControls',
  components: {
    TagChoice,
  },
  props: {
    newQuestion: {
      type: Function,
      required: true,
    },
    setTags: {
      type: Function,
      required: true,
    },
    mode: {
      type: String,
      default: 'normal',
    },
    tags: {
      type: Array<string>,
      default: [],
    },
  },
  data() {
    return {
      askedQuestion: 0,
      showFilterFlag: false,
      selectedTags: [] as Array<string>,
      checkedTags: {} as { [key: string]: boolean },
    }
  },
  methods: {
    toggleFilters() {
      this.showFilterFlag = !this.showFilterFlag
    },

    getNewQuestion() {
      this.askedQuestion++
      this.newQuestion()
    },

    onTagSelect(e: { target: HTMLInputElement }): void {
      const ele = e.target
      if (ele.checked) {
        this.selectedTags.push(ele.value)
        this.checkedTags[ele.value] = true
      } else {
        this.selectedTags = this.selectedTags.filter((val) => val !== ele.value)
        this.checkedTags[ele.value] = false
      }

      this.setTags(this.selectedTags)
    },
  },
})
</script>

<style scoped>
.fab {
  position: absolute;
  bottom: 10px;
  display: block;
  width: 7rem;
  height: 3.5rem;
  background-color: var(--color-mid);
  border-radius: 15%;
  box-shadow:
    0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12),
    0 3px 1px -2px rgba(0, 0, 0, 0.2);
}
.fab .fab-text {
  display: inline-block;
  width: 7rem;
  height: 3.5rem;
  font-size: 1em;
  color: var(--color-light);
  line-height: 3.5rem;
  text-align: center;
}
@media only screen and (max-width: 480px) {
  .fab {
    width: 3.5rem !important;
    border-radius: 50% !important;
  }
  .fab-text {
    width: 3.5rem !important;
  }
}
.fab .fab-q {
  font-size: 2em;
}
.fab.que {
  right: 10px;
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
  background-color: var(--color-mid);
  border-radius: 10px;
  padding: 5px 5px 62px 5px;
  transition: ease-in-out;
  animation: expand 0.4s ease;
}
#filters ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.tags {
  animation: fade-in 0.7s ease;
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

@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>
