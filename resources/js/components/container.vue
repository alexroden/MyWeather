<template>
    <div class="container has-text-centered">
        <article
            v-if="message !== null"
            class="message is-danger"
        >
            <div class="message-header">
                <p>Oops</p>
                <button
                    class="delete"
                    aria-label="delete"
                    @click.prevent="message = null"
                ></button>
            </div>
            <div class="message-body">
                {{ message }}
            </div>
        </article>
        <forecast
            v-if="authenticated"
            :user="user"
        ></forecast>
        <sign-up v-else></sign-up>
    </div>
</template>

<script>
import { EventBus } from "../helpers/event-bus.js";

import Forecast from "./forecast";
import SignUp from "./sign-up";

export default {
    name: "Container",
    props: {
        auth: {
            default: () => ({}),
            type: Object
        }
    },
    data() {
        return {
            firstLoad: true,
            message: null,
            user: null
        }
    },
    computed: {
        authenticated() {
            return this.user !== null &&
                    Object.keys(this.user).length > 0;
        }
    },
    created() {
        EventBus.$on(
            "error",
            (message) => this.message = message
        );
        EventBus.$on(
            "set-user",
            (user) => this.setUser(user)
        );
    },
    mounted() {
        if (Object.keys(this.$props.auth).length > 0) {
            this.setUser(this.$props.auth);
        }

        this.firstLoad = false;
    },
    methods: {
        setUser(user) {
            this.user = user;
        }
    },
    components: {
        Forecast,
        SignUp
    }
}
</script>
