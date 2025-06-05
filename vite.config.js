// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { globSync } from "glob";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...globSync("resources/js/**/*.js"),
                ...globSync("resources/css/**/*.css")
            ],
            refresh: true
        })
    ],
    build: {
        // ... other build options
        cssMinify: false // Disable CSS minification
    }
});
