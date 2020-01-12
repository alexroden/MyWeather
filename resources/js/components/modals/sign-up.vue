<template>
<div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Set Preferred Location </p>
            <button class="delete" aria-label="close" @click.prevent="$parent.closeModal"></button>
        </header>
        <section class="modal-card-body">
            <article
                v-if="showAlert"
                class="message is-danger"
            >
                <div class="message-header">
                    <p>Oops</p>
                    <button class="delete" aria-label="delete" @click.prevent="showAlert = false"></button>
                </div>
                <div class="message-body">
                    Looks like something went wrong.
                </div>
            </article>
            <div class="field">
                <label class="label">First Name:</label>
                <div class="control">
                    <input class="input" type="text" v-model="user.first_name">
                </div>
                <ul v-if="fieldHadError('first_name')" class="is-small">
                    <li v-for="error in errors['first_name']">{{ error }}</li>
                </ul>
            </div>
            <div class="field">
                <label class="label">Last Name:</label>
                <div class="control">
                    <input class="input" type="text" v-model="user.last_name">
                </div>
                <ul v-if="fieldHadError('last_name')" class="is-small">
                    <li v-for="error in errors['last_name']">{{ error }}</li>
                </ul>
            </div>
            <div class="field">
                <label class="label">City:</label>
                <div class="control">
                    <input class="input" type="text" v-model="user.city">
                </div>
                <ul v-if="fieldHadError('city')" class="is-small">
                    <li v-for="error in errors['city']">{{ error }}</li>
                </ul>
            </div>
            <div class="field">
                <label class="label">Password:</label>
                <div class="control">
                    <input class="input" type="password" v-model="user.password">
                </div>
                <ul v-if="fieldHadError('password')" class="is-small">
                    <li v-for="error in errors['password']">{{ error }}</li>
                </ul>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-success" @click.prevent="submit">Subscribe</button>
            <button class="button" @click.prevent="$parent.closeModal">Cancel</button>
        </footer>
    </div>
</div>
</template>

<script>
import { EventBus } from "../../helpers/event-bus.js";

export default {
    name: "Sign-Up-Modal",
    props: {
        email: {
            type: String
        }
    },
    data () {
        return {
            errors: [],
            showAlert: false,
            user: {
                city: null,
                email: null,
                first_name: null,
                last_name: null,
                password: null
            }
        }
    },
    mounted() {
        this.user.email = this.$props.email;
        this.getCurrentLocation();
    },
    methods: {
        fieldHadError(field) {
            return Object.keys(this.errors).length > 0 &&
                Object.keys(this.errors).indexOf(field) !== -1;
        },
        getCurrentLocation() {
            window.axios.get("/api/location")
                .then((response) => {
                    this.user.city = response.data.city;
                });
        },
        submit() {
            window.axios
                .post("/api/subscribe", this.user)
                .then((response) => {
                    const user = response.data.data;

                    EventBus.$emit("set-user", user);
                }).catch((e) => {
                    this.showAlert = true;
                    this.errors = e.response.data.errors;
                });
        }
    }
}
</script>

<style scoped>
li {
    font-size: 12px;
    color: #ff3860;
}
</style>
