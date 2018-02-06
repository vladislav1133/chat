<template>
    <ul class="user-list">
        <li
                class="user-list__item"
                :style={color:user.color}
                v-for="user in users"
        >
                {{ user.name }}
        </li>
    </ul>

</template>

<script>
    export default {

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