<script setup>
import { Link, useForm } from "@inertiajs/inertia-vue3"
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    users: {
        type: Object
    },
    flash: {
        type: Object
    }
});

const users = props.users;

const form = useForm({
    body: null,
    status: null,
    user_id: null,
});

const submit = () => {
    form.post(route('posts.store'), {
        onSuccess: function () {
            $("#newPostModal").modal('hide')
            setTimeout(() => {
                $(".alert").fadeOut();
            }, 2000);
        },
    });
};

</script>

<template>
    <div class="row p-5">
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPostModal">New Post</button>
            <Link class="btn btn-info text-light back-btn" :href="route('welcome')">Go Back</Link>
        </div>
        <div v-if="$page.props.flash.message" class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{$page.props.flash.message}}</strong>
        </div>
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
                <tr v-for="(post, key) in $page.props.posts" v-bind:key="key">
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

    <!-- Modal -->
    <div class="modal fade" id="newPostModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="submit">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Enter Body</label>
                            <textarea class="form-control" v-model="form.body"></textarea>
                            <InputError class="mt-2" :message="form.errors.body" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" v-model="form.status">
                                <option value="" selected>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <select class="form-control" v-model="form.user_id">
                                <option value="" selected>Select User</option>
                                <option v-for="user in users" :value="user.id" v-bind:key="user.id">
                                    {{user.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.user_id" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
.back-btn {
    margin-left: 2px;
}
</style>