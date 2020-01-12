<template>
<div>
    <div class="field-grouped">
        <div class="field is-inline-block-desktop">
            <div class="control">
                <input
                    class="input"
                    :class="{ 'missing-details' : fieldHadError('email') }"
                    type="email"
                    placeholder="Email"
                    v-model="user.email"
                >
            </div>
        </div>
        <div class="field is-inline-block-desktop">
            <div class="control">
                <input
                    class="input"
                    :class="{ 'missing-details' : fieldHadError('password') }"
                    type="password"
                    placeholder="Password"
                    v-model="user.password"
                >
            </div>
        </div>
        <div class="field is-inline-block-desktop">
            <div class="control">
                <button
                    class="button is-primary"
                    @click.prevent="login"
                >
                    Login
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { EventBus } from "../helpers/event-bus.js";

export default {
    name: "Login",
    data() {
        return {
            errors: [],
            message: null,
            user: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        fieldHadError(field) {
            return Object.keys(this.errors).length > 0 &&
                Object.keys(this.errors).indexOf(field) !== -1;
        },
        login() {
            this.errors = [];
            EventBus.$emit("error", null);

            window.axios
                .post("/api/login", this.user)
                .then((response) => {
                    const user = response.data.data;

                    EventBus.$emit("set-user", user);
                    this.$parent.toggleDropDown();
                }).catch((e) => {
                    if (e.response.status === 404) {
                        EventBus.$emit("error", e.response.data.message);
                    } else {
                        this.errors = e.response.data.errors;
                    }
                })
        }
    }
}
</script>

<style scoped>
.missing-details {
    border: #ff3860 solid 2px;
}

.is-grouped {
    float: right;
}
</style>
