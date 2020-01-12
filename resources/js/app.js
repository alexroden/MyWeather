require("./bootstrap");

import { EventBus } from "./helpers/event-bus.js";

window.Vue = require("vue");

// Vee validate
import { ValidationProvider, extend } from "vee-validate";
import { email, required } from "vee-validate/dist/rules";

extend("required", {
    ...required,
    message: "This field is required"
});

extend("email", {
    ...email,
    message: "Must be a validate email address"
});

Vue.component("validation-provider", ValidationProvider);

// Components
import Container from "./components/container";
import Modal from "./components/modal";
import NavBar from "./components/nav-bar";

const app = new Vue({
    el: '#app',
    data: {
        modal: null
    },
    methods: {
        openModal(name, data = null) {
            this.modal = name;
            if (data) {
                EventBus.$emit("modal-add-data", data);
            }
        }
    },
    components: {
        Container,
        Modal,
        NavBar
    }
});
