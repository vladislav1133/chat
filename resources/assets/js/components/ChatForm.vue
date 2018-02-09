<template>
    <div class="input-group">
        <input
                type="text"
                id="btn-input"
                name="message"
                class="form-control input-sm"
                placeholder="Type your message"
                v-model="newMessage"
                @keyup.enter="sendMessage"

        >

        <span class="input-group-btn">
            <button
                    class="bth btn-primary btn-sm"
                    id="btn-chat"
                    @click="sendMessage"
            >
                Send
            </button>
        </span>
    </div>
</template>

<script>
    import VueTypes from 'vue-types';

    export default {

        props: {
            user: VueTypes.object.isRequired,
        },


        data() {
            return {
                newMessage: ''
            }
        },

        methods: {

            sendMessage() {
                this.$emit('message-sent', {
                    user: this.user,
                    message: this.newMessage
                })

                this.newMessage = ''
            }
        }
    }
</script>