import { defineStore } from 'pinia'

export const useMainStore = defineStore('main', {
  state: () => ({
    // Define your state here
    counter: 0,
    user: null,
  }),
  getters: {
    // Define getters here
    doubleCounter: (state) => state.counter * 2,
  },
  actions: {
    // Define actions here
    increment() {
      this.counter++
    },
    setUser(user: any) {
      this.user = user
    },
  },
})