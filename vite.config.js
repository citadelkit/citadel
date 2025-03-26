import { defineConfig } from "vite";
import path from "path";
import jquery from "jquery";
import postcss from "@vituum/vite-plugin-postcss";

export default defineConfig({
    resolve: {
        alias: {
            "~": path.resolve(__dirname, "node_modules"),
            "@plugins": path.resolve(__dirname, "./resources/plugins"),
            "jQuery": jquery,
        }
    },
    plugins: [
        postcss()
    ],
    server: {
        origin: "http://localhost:5174", // Allows external access
        hmr: {
            host: "localhost" // Ensure HMR (Hot Module Replacement) works
        },
        watch: {
            usePolling: true // Ensures file changes are detected
        }
    },
    build: {
        manifest: true,
        outDir: "dist", // ⬅️ Fix: Build output should go here (not `src/public/`)
        rollupOptions: {
            input: {
                main: "resources/js/index.js", 
                style: "resources/css/main.scss"
            },
            output: {
                entryFileNames: "assets/[name]-[hash].js", // ⬅️ Keep hashes for caching
                chunkFileNames: "assets/chunks/[name]-[hash].js",
                assetFileNames: "assets/[name]-[hash].[ext]" // ⬅️ Keep hashes
            }
        }
    }
});
