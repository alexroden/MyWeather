<template>
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="../">
                <h1>myweather.co.uk</h1>
            </a>
            <span class="navbar-burger burger" data-target="navbarMenu" @click.prevent="toggleDropDown">
            <span></span>
            <span></span>
            <span></span>
        </span>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
            <span class="navbar-item">
                <div
                    v-if="authenticated"
                    class="field is-inline-block-desktop"
                >
                    <div class="control">
                        <button
                            class="button is-primary"
                            @click.prevent="logout"
                        >
                            Logout
                        </button>
                    </div>
                </div>
                <login v-else></login>
            </span>
            </div>
        </div>
    </div>
</nav>
</template>

<script>
import { EventBus } from "../helpers/event-bus.js";

import Login from "./login";

export default {
    name: "Nav-Bar",
    props: {
        auth: {
            default: () => ({}),
            type: Object
        }
    },
    data() {
        return {
            user: null
        }
    },
    computed: {
        authenticated() {
            return Object.keys(this.$props.auth).length > 0 ||
                (
                    this.user !== null &&
                    Object.keys(this.user).length > 0
                );
        }
    },
    created() {
        EventBus.$on(
            "set-user",
            (user) => this.setUser(user)
        );
    },
    methods: {
        logout() {
            window.axios
                .post("/api/logout", this.user)
                .then(() => {
                    EventBus.$emit("set-user", null);
                    this.toggleDropDown();
                });
        },
        setUser(user) {
            this.user = user;
        },
        toggleDropDown() {
            let burger = document.querySelector('.burger');
            let menu = document.querySelector('#'+burger.dataset.target);

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        }
    },
    components: {
        Login
    }
}
</script>

<style scoped>
.field.is-grouped {
    float: right;
}

.navbar-menu {
    position: absolute;
    width: 100%;
}
</style>
