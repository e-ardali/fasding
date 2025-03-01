
import { defineConfig } from 'vite'
import { resolve } from 'path'
import liveReload from 'vite-plugin-live-reload'

export default defineConfig({

    plugins: [
        liveReload([
            __dirname + '/**/*.php',
        ]),
    ],

    base: "./",
    publicDir: './dist',
    build: {
        manifest: true,
        rollupOptions: {

            input: resolve(__dirname, 'src/js/app.js'),

            output: {
                dir: 'dist',
                entryFileNames: 'build/bundle-[hash].js',
                assetFileNames: 'build/bundle-[hash].css',
            }
        }
    }

})