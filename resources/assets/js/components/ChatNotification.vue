<template>
    <div>
        <div class="flash flash__success" v-if="success">
            {{success}}
        </div>

        <div class="flash flash__error" v-if="error">
            {{error}}
        </div>
    </div>
</template>

<script>
    import VueTypes from 'vue-types';

    export default {
        props: {
            error: VueTypes.string,
            success: VueTypes.string
        },
    }
</script>
