<template>
        <ul class="user-list">
            <li
                    v-if="isAdmin"
                    v-for="user in users"
                    class="user-list__item dropdown">
                <a href="#"
                   class="dropdown-toggle"
                   data-toggle="dropdown"
                   role="button"
                   aria-expanded="false"
                   aria-haspopup="true"
                   :style={color:user.color}
                   v-if="!user.isAdmin">
                    {{ user.name }} <span class="caret"></span>
                </a>
                <ul v-if="!user.isAdmin" class="dropdown-menu">
                    <li><a href="#">Mute user</a></li>
                    <li><a href="#">Ban user</a></li>
                </ul>
                <span
                        :style={color:user.color}
                        v-if="user.isAdmin">
                    {{ user.name }}
                </span>

            </li>
            <li
                    v-else
                    class="user-list__item"
                    v-for="user in users"
            >
               <span :style={color:user.color}>
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

            removeUserById(id){
                let removeIndex = this.users.map(function(item) { return item.id; }).indexOf(id);

                this.users.splice(removeIndex, 1);
            },
        }
    }
</script>