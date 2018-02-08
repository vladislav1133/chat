<template>

        <ul class="user-list">

            <li
                    class="user-list__item dropdown"
                    v-for="user in users">

                <a href="#"
                   class="dropdown-toggle"
                   data-toggle="dropdown"
                   role="button"
                   aria-expanded="false"
                   aria-haspopup="true"

                   :style={color:user.color}
                   v-if="!user.isAdmin && isAdmin">

                    {{ user.name }} <span class="caret"></span>
                </a>
                <ul
                        class="dropdown-menu"
                        v-if="!user.isAdmin && isAdmin">

                    <li><a @click="muteUser(user.id)">Mute user</a></li>
                    <li><a @click="banUser(user.id)" >Ban user</a></li>
                </ul>
                <span
                        :style={color:user.color}
                        v-if="user.isAdmin || !isAdmin">

                    {{ user.name }}
                </span>

            </li>

        </ul>
</template>

<script>
    export default {
        props: ['isAdmin','user'],

        data() {
            return {
                users: []
            }
        },

        mounted() {
            this.listenUsers();
        },

        methods: {
            listenUsers() {
                Echo.join('userList')
                    .here(users => this.users = users)
                    .joining(user => {
                        console.log(user)
                        this.users.push(user)
                    })
                    .leaving(user => this.removeUserById(user.id));

            },



            banUser(id) {
                this.$emit('ban-user', id)
            },

            muteUser(id) {
                this.$emit('mute-user', id)
            },



            removeUserById(id){
                let removeIndex = this.users.map(function(item) { return item.id; }).indexOf(id);

                this.users.splice(removeIndex, 1);
            },
        }
    }
</script>