<template>
<div v-if="$root.modal !== null">
    <component :is="$root.modal" v-bind="props"></component>
</div>
</template>

<script>
import { EventBus } from "../helpers/event-bus.js";
import forecastModal from "./modals/forecast"
import signUpModal from "./modals/sign-up"

export default {
    name: "Modal",
    data() {
        return {
            data: null
        };
    },
    computed: {
        props() {
            const props = {};

            if (this.data) {
                const keys = Object.keys(this.data);
                for (let i = 0; i < keys.length; i++) {
                    props[keys[i]] = this.data[keys[i]];
                }
            }

            return props;
        }
    },
    created() {
        EventBus.$on("modal-add-data", (data) => {
            this.data = data;
        });
    },
    methods: {
        closeModal() {
            this.$root.modal = null;
        }
    },
    components: {
        "forecast": forecastModal,
        "sign-up": signUpModal
    }
};
</script>
