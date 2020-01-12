<template>
<div class="column is-6 is-offset-3">
    <h1 class="title">
        Sign up!
    </h1>
    <h2 class="subtitle">
        Join our weekly weather breakdown mailing list.
    </h2>
    <div class="box">
        <validation-provider
            name="email"
            rules="required|email"
            v-slot="{ errors }"
        >
            <div class="field is-grouped">
                <p class="control is-expanded">
                        <input
                            class="input"
                            type="text"
                            placeholder="Enter your email"
                            v-model="email"
                        >
                        <span>{{ errors[0] }}</span>
                </p>
                <p class="control">
                    <a
                        class="button is-info"
                        :class="{ 'is-static' : inactive || errors.length > 0 }"
                        @click="$root.openModal('sign-up', {email: email})"
                    >
                        Subscribe
                    </a>
                </p>
            </div>
        </validation-provider>
    </div>
</div>
</template>

<script>
export default {
    name: "SignUp",
    data() {
        return {
            email: null
        }
    },
    computed: {
        inactive() {
            return this.email === null
                || this.email === '';
        }
    }
}
</script>

<style scoped>
    span {
        font-size: 12px;
        color: #ff3860;
    }
</style>

