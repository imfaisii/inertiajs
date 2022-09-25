<template>
    <Head title="Welcome"></Head>

    <div class="text-center mt-5">
        <h3>Welcome Component</h3>
        <Link class="btn btn-primary" :href="route('posts.index')">
            Go to Posts
        </Link>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>