import { defineConfig } from "vite";
import path from 'path';
import jquery from "jquery";

export default defineConfig({
    resolve: {
        alias: {
            '~': path.resolve(__dirname, "node_modules"),
            '@plugins': path.resolve(__dirname, './resources/plugins'),
            'jQuery': jquery
        }
    },
    build: {
        outDir: "src/public/",
        rollupOptions: {
            input: {
                main: 'src/resources/js/index.js', // Entry utama
            },
            output: {
                entryFileNames: 'citadel.js', // Nama file hasil bundling
                chunkFileNames: 'chunks/citadel-[hash].js', // File chunk
                assetFileNames: 'assets/citadel-[hash].[ext]', // File asset
                manualChunks: undefined,
            }
        },
    },
});