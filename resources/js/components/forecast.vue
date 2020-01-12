<template>
<div>
    <article class="message is-info">
        <div class="message-header">
            <p>Summary</p>
            <div class="field is-grouped is-pulled-right">
                <div class="control">
                    <input
                        class="input"
                        type="text"
                        placeholder="City"
                        v-model="city"
                        @blur="getForecast"
                    >
                </div>
                <div class="control">
                    <a
                        class="button is-info"
                        @click="updateCity"
                    >
                        Set as default
                    </a>
                </div>
            </div>
        </div>
        <div
            class="message-body"
        >
            <div v-if="hasSummary">
                This week it is expected to be: {{ summary['summary'] }}
            </div>
            <div v-else>
                Loading...
            </div>

        </div>
    </article>
    <div class="columns is-multiline is-hidden-touch">
        <div
            v-for="(forecast, index) in breakdown"
            class="column is-one-quarter is-hidden-desktop-only"
            @click.prevent="$root.openModal('forecast', {
                day: getDay(index),
                forecast: forecast
            })"
        >
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        {{ getDay(index) }}
                    </p>
                    <span class="icon">
                        <i
                            v-if="showIcon(forecast.icon) !== null"
                            class="is-pulled-right"
                            :class="showIcon(forecast.icon)"
                        ></i>
                    </span>
                </header>
                <div class="card-content">
                    <div class="content">
                        {{ forecast.summary }}
                    </div>
                </div>
            </div>
        </div>
        <div
            v-for="(forecast, index) in breakdown"
            class="column is-one-third is-desktop is-hidden-widescreen-only is-hidden-fullhd"
            @click.prevent="$root.openModal('forecast', {
                day: getDay(index),
                forecast: forecast
            })"
        >
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        {{ getDay(index) }}
                    </p>
                    <span class="icon">
                        <i
                            v-if="showIcon(forecast.icon) !== null"
                            class="is-pulled-right"
                            :class="showIcon(forecast.icon)"
                        ></i>
                    </span>
                </header>
                <div class="card-content">
                    <div class="content">
                        {{ forecast.summary }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table is-hoverable is-fullwidth is-hidden-desktop">
        <tbody>
            <tr
                v-for="(forecast, index) in breakdown"
                style="cursor: pointer"
                @click.prevent="$root.openModal('forecast', {
                    day: getDay(index),
                    forecast: forecast
                })"
            >
                <td><strong>{{ getDay(index) }}</strong></td>
                <td>
                    <i
                        v-if="showIcon(forecast.icon) !== null"
                        :class="showIcon(forecast.icon)"
                    ></i>
                </td>
                <td>{{ forecast.summary }}</td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
const ICONS = {
    "clear-day": "fas fa-sun",
    "clear-night": "fas fa-moon",
    "rain": "fas fa-cloud-rain",
    "snow": "fas fa-snowflake",
    "sleet": "fas fa-cloud-meatball",
    "wind": "fas fa-wind",
    "fog": "fas fa-smog",
    "cloudy": "fas fa-cloud",
    "partly-cloudy-day": "fas fa-cloud-sun",
    "partly-cloudy-night": "fas fa-cloud-moon"
};

import { EventBus } from "../helpers/event-bus.js";

const moment = require("moment");

export default {
    name: "Forecast",
    props: {
        user: {
            default: () => ({}),
            type: Object
        }
    },
    data() {
        return {
            city: null,
            breakdown: [],
            summary: []
        }
    },
    computed: {
        icons() {
            return ICONS;
        },
        hasBreakdown() {
            return Object.keys(this.breakdown).length > 0;
        },
        hasSummary() {
            return Object.keys(this.summary).length > 0;
        }
    },
    mounted() {
        this.city = this.$props.user.city;
        this.getForecast();
    },
    methods: {
        getDay(index) {
            return moment().add(index, "d").format("dddd");
        },
        getForecast() {
            window.axios
                .get("/api/forecast", {
                    params: {
                        city: this.city
                    }
                })
                .then((response) => {
                    const data = response.data;

                    this.breakdown = data.breakdown;
                    this.summary = data.summary;
                });
        },
        showIcon(icon) {
            return Object.keys(this.icons).indexOf(icon) !== -1 ?
                this.icons[icon] :
                null;
        },
        updateCity() {
            window.axios
                .put(`/api/${this.$props.user.id}/location`, {
                    city: this.city
                })
                .catch(() => {
                    EventBus.$emit("error", "Unable to set new default location");
                });
        }
    }
}
</script>

<style scoped>
.icon {
    margin: 10px;
}
</style>
