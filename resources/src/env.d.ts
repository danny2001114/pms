/// <reference types="vite/client" />

declare global {
  interface Window {
    axios: any;
  }
}

declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  const component: DefineComponent<{}, {}, any>
  export default component
}