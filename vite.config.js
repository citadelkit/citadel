import { defineConfig } from "vite";
import path from "path";
import postcss from "@vituum/vite-plugin-postcss";
import inject from "@rollup/plugin-inject";


export default defineConfig({
    resolve: {
        alias: {
            "~": path.resolve(__dirname, "node_modules"),
            '@support': path.resolve(__dirname, "support")
        }
    },
    plugins: [
        inject({
            include: ['**/*.js', '**/*.ts'],
            feather: 'feather-icons'
        }),
        postcss()
    ],
    server: {
        host: "localhost",
        port: 5174,
        origin: "http://localhost:5174", // Allows external access
        hmr: {
            host: "localhost", // Ensure HMR (Hot Module Replacement) works
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
