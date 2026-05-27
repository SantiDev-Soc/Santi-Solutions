import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vite.dev/config/
export default defineConfig({
  plugins: [vue()],
  server: {
    host: true,         // Permite que Docker exponga el puerto
    port: 3000,         // El puerto que configuramos en el compose
    strictPort: true,
    watch: {
      usePolling: true, // NECESARIO para que detecte cambios hechos en Windows
    },
  },
})
