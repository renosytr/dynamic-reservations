declare module '*.vue' {
  import type { DefineComponent } from 'vue';
  const component: DefineComponent<Record<string, unknown>, Record<string, unknown>, any>;
  export default component;
}

interface ImportMeta {
  readonly env: Record<string, string>;
  glob<T = unknown>(
    pattern: string,
    options?: { eager?: boolean }
  ): Record<string, (() => Promise<T>) | T>;
  globEager<T = unknown>(pattern: string, options?: { eager: true }): Record<string, T>;
}
