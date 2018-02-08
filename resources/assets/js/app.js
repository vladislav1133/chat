require('./bootstrap')

if(document.getElementById("root")){
    Vue.component('chat-messages', require('./components/ChatMessages.vue'))
    Vue.component('chat-form', require('./components/ChatForm.vue'))
    Vue.component('chat-users', require('./components/ChatUsers.vue'))
    Vue.component('chat-notification', require('./components/ChatNotification.vue'))

    const app = new Vue({
        el: '#root',

        data(){

            return {
                messages: [],
                success: null,
                error: null,
                user: user,
                mute: null
            }
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
                .listen('UserManage', (e) => {
                    if(this.user.id === e.user.id && e.action === 'ban'){
                        window.location.href = "/ban";
                    }

                    if(this.user.id === e.user.id && e.action === 'mute'){
                        this.showNotification('You are muted' ,5000)
                        this.mute = true
                    }
                })

        },

        methods: {
            banUser(userId) {
                axios.get(`/admin/user/ban/${userId}`)
                    .then(response => {
                        console.log(response)

                        if (response.data.banned === true) this.showNotification(response.data.message ,5000)

                    })
                    .catch(error => {

                        let message = error.response.data.errors.message[0]
                        this.showNotification(message,5000,false)
                    })
            },

            muteUser(userId) {
                axios.get(`/admin/user/mute/${userId}`)
                    .then(response => {

                        if (response.data.muted === true)  this.showNotification(response.data.message ,5000)

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

            addMessage(message){

                axios.post('/messages', message)
                    .then(
                        (response) => {
                            console.log(response)

                            if (response.data.message === 'saved') this.messages.push(message)

                        })
                    .catch(error => {

                        let message = error.response.data.errors.message[0]
                        this.showNotification(message,5000,false)
                    })
            }
        }
    });

}
