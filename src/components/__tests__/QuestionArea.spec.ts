import { describe, it, expect } from 'vitest'

import { mount } from '@vue/test-utils'
import QuestionArea from '../QuestionArea.vue'

describe('QuestionArea', () => {
  it('renders properly', () => {
    const wrapper = mount(QuestionArea)
    expect(wrapper.text()).toContain('Que')
  })
})
