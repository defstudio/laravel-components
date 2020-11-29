<template>
    <div class="dropdown">

        <i id="dropdown-label"
           class="fas fa-bell"
           data-toggle="dropdown"
           role="button"
           :class="[
                  notifications.length===0?'text-light':'text-primary',
                  {blinking: has_unread}
            ]"
           @click="mark_all_as_read()"
        />


        <div aria-labelledby="dropdown-label" class="dropdown-menu notifications" role="menu" @click="$event.stopPropagation()">
            <div class="notifications-wrapper">

                <notification v-for="notification in notifications"
                              :key="notification.id"
                              :notification="notification"
                              v-on:destroy-notification="destroy"/>

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
            has_unread: false,
        }
    },
    mounted() {
        this.refresh_notifications();
    },
    methods: {
        refresh_notifications() {
            axios.get('/def-components/notifications', {spinner: false})
                .then(response => this.update_notifications(response.data))
                .catch(error => console.error(error));
        },
        mark_all_as_read() {
            this.has_unread = false;

            for (const notification of this.notifications) {
                if (notification.read_at) continue;

                notification.read_at = new Date();

                axios.patch(`/def-components/notifications/${notification.id}/read`, {
                    read: !notification.read_at
                }, {
                    spinner: false
                });

            }
        },
        update_notifications(notifications) {
            this.notifications = notifications;

            this.has_unread = false;
            for (const notification of notifications) {
                if (!notification.read_at) {
                    this.has_unread = true;
                }
            }

        },
        destroy(notification_to_destroy) {

            this.notifications = this.notifications.filter(notification => notification.id !== notification_to_destroy.id);

            axios.delete(`/def-components/notifications/${notification_to_destroy.id}`, {
                spinner: false
            }).catch(error => console.error(error));
        }
    }
}
</script>

<style scoped>
@keyframes blink {
    50% {
        opacity: 0.2;
    }
}

.blinking {
    animation: blink 1s linear infinite;
}

.dropdown {
    display: inline-block;
    margin-left: 20px;
    padding: 10px;
}

.notifications {
    left: unset;
    right: -15px;
    min-width: 420px;
}



</style>
