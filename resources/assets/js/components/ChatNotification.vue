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
    export default {
        props: ['error', 'success']
    }
</script>
