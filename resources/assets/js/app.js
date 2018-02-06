require('./bootstrap')

Vue.component('chat-messages', require('./components/ChatMessages.vue'))
Vue.component('chat-form', require('./components/ChatForm.vue'))
Vue.component('chat-users', require('./components/ChatUsers.vue'))

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages()

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                })
            })
    },

    methods: {

        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data
            })
        },

        addMessage(message){
            this.messages.push(message)

            axios.post('/messages', message).then(response => {})
        }
    }
});
