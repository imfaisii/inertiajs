<script setup>
import { Link } from "@inertiajs/inertia-vue3"
defineProps({
    posts: Array,
});
</script>

<template>
    <div class="row p-5">
        <Link class="btn btn-info text-light" :href="route('welcome')">Go Back</Link>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Body</th>
                    <th scope="col">Status</th>
                    <th scope="col">Post By</th>
                    <th scope="col">Dated</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(post, key) in posts" v-bind:key="key">
                    <th scope="row">{{ post.id }}</th>
                    <td>{{ post.body }}</td>
                    <td>
                        <span class="badge" v-bind:class="
                            post.status == 'active'
                                ? 'bg-success'
                                : 'bg-danger'
                        ">{{ post.status }}</span>
                    </td>
                    <td>{{ post.user.name }}</td>
                    <td>{{ post.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
