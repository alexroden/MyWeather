<template>
<div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">{{ $props.day }}</p>
            <button class="delete" aria-label="close" @click.prevent="$parent.closeModal"></button>
        </header>
        <section class="modal-card-body">
            <p>{{ $props.forecast.summary }}</p>
            <br>
            <table class="table is-fullwidth">
                <tbody>
                    <tr>
                        <td><strong>Sunrise</strong></td>
                        <td>{{ formatTime($props.forecast.sunriseTime) }}</td>
                        <td><strong>Sunset</strong></td>
                        <td>{{ formatTime($props.forecast.sunsetTime) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Temperature Highs</strong></td>
                        <td>{{ $props.forecast.temperatureHigh }}</td>
                        <td><strong>Temperature Lows</strong></td>
                        <td>{{ $props.forecast.temperatureLow }}</td>
                    </tr>
                    <tr>
                        <td><strong>Humidity</strong></td>
                        <td>{{ $props.forecast.humidity }}</td>
                        <td><strong>Wind Speeds</strong></td>
                        <td>{{ $props.forecast.windSpeed }}</td>
                    </tr>
                    <tr>
                        <td><strong>Visibility</strong></td>
                        <td>{{ $props.forecast.visibility }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
</template>

<script>
const moment = require("moment");

export default {
    name: "Forecast-Modal",
    props: {
        day: {
            type: String
        },
        forecast: {
            type: Object
        }
    },
    methods: {
        formatTime(time) {
            return moment(time).format("HH:mm");
        }
    }
}
</script>
