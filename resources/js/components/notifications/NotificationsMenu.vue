<template>
    <div class="dropdown">
        <a id="dropdown-label" data-target="#" data-toggle="dropdown" href="/" role="button">
            <i class="fas fa-bell"></i>
        </a>

        <div aria-labelledby="dropdown-label" class="dropdown-menu notifications" role="menu">
            <div class="notification-heading d-flex">
                <h4 class="menu-title">Notifications</h4>
                <h4 class="menu-title ml-auto">
                    View all&nbsp;<i class="fas fa-arrow-circle-right"></i>
                </h4>
            </div>

            <span class="divider"></span>

            <div class="notifications-wrapper">

                <div v-for="notification in notifications"
                     v-bind:class="['notification-item', 'border-'+notification.data.color]">

                    <h4 class="item-title" v-text="notification.data.title"/>
                    <p class="item-info" v-text="notification.data.message"/>

                </div>

            </div>

        </div>


    </div>
</template>

<script>
export default {
    name: "NotificationsMenu",
    data() {
        return {
            notifications: [],
        }
    },
    mounted() {
        this.refresh_notifications();
    },
    methods: {
        refresh_notifications() {
            axios.get('/def-components/notifications')
                .then(response => this.notifications = response.data).catch(error => console.error(error));
        }
    }
}
</script>

<style scoped>
.dropdown {
    display: inline-block;
    margin-left: 20px;
    padding: 10px;
}


.notifications {
    left: unset;
    right: 0;
    min-width: 420px;
}

.menu-title {
    color: #ff7788;
    font-size: 1rem;
    display: inline-block;
}


.notification-heading, .notification-footer {
    padding: 2px 10px;
}


.dropdown-menu .divider {
    margin: 5px 0;
}

.item-title {
    font-size: 1.0rem;
    color: #000;
}


.notification-item {
    padding: 10px;
    margin: 5px;
    border: 1px solid;
    border-radius: 4px;
}
</style>
