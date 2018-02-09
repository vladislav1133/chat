<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix" :style={color:message.user.color}>
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>

                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
    import VueTypes from 'vue-types';

    export default {

        props: {

          messages: VueTypes.array.isRequired,

        },

        updated() {
            this.scrollToEnd()
        },

        methods: {
            scrollToEnd: function() {
                const chatBody = document.querySelector(".panel-body");

                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }

    };
</script>