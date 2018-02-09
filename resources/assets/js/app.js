require('./bootstrap')

if(document.getElementById("chat")){
    Vue.component('chat-messages', require('./components/ChatMessages.vue'))
    Vue.component('chat-form', require('./components/ChatForm.vue'))
    Vue.component('chat-users', require('./components/ChatUsers.vue'))
    Vue.component('chat-notification', require('./components/ChatNotification.vue'))

    const app = new Vue({
        el: '#chat',

        data(){

            return {
                messages: [],
                success: null,
                error: null,
                user: user,

            }
        },

        created() {
            this.fetchMessages()

        },

        mounted() {
            this.listenChat()
            this.listenUser()
        },

        methods: {

            listenChat() {
                Echo.private('chat')
                    .listen('MessageSent', (e) => {

                        this.messages.push({
                            message: e.message.message,
                            user: e.user
                        })
                    })
            },

            listenUser() {
                Echo.private(`user.${this.user.id}`)
                    .listen('UserManage', (e) => {
                        if(this.user.id === e.user.id && e.action === 'ban'){
                            window.location.href = "/ban";
                        }

                        if(this.user.id === e.user.id && e.action === 'mute'){
                            this.showNotification('You are muted' ,5000, true)

                        }
                    })
            },

            manageUser(userId,action) {

                axios.get(`/admin/user/${action}/${userId}`)
                    .then(response => {

                    })
                    .catch(error => {

                        let message = error.response.data.errors.message[0]

                        this.showNotification(message,5000,false)
                    })
            },

            fetchMessages() {
                axios.get('/messages').then(response => {
                    this.messages = response.data
                })
            },

            addMessage(message){

                axios.post('/messages', message)
                    .then(
                        (response) => {

                            if (response.data.message === 'saved') this.messages.push(message)
                        })
                    .catch(error => {

                        let message = error.response.data.errors.message[0]

                        this.showNotification(message,5000,false)
                    })
            },

            showNotification(text, time, success = true) {

                if(success){
                    this.success = text
                    setTimeout(() => {
                        this.success = null
                    },time)

                } else {
                    this.error = text
                    setTimeout(() => {
                        this.error = null
                    },time)
                }
            },


        }
    });

}
