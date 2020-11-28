<template>
    <div class="dropdown">

        <i id="dropdown-label"
           class="fas fa-bell"
           data-toggle="dropdown"
           role="button"
           v-bind:class="[
                  notifications.length===0?'text-light':'text-primary',
                  {blinking: has_unread}
              ]"
           @click="has_unread = false"
        />


        <div aria-labelledby="dropdown-label" class="dropdown-menu notifications" role="menu">
            <div class="notifications-wrapper">

                <div v-for="notification in notifications"
                     class="notification-item d-flex"
                     v-bind:class="[
                         'border-'+notification.data.color,
                          {read: notification.read_at}
                        ]">

                    <div class="item-content flex-grow-1">
                        <h4 class="item-title" v-text="notification.data.title"/>
                        <p class="item-info" v-text="notification.data.message"/>
                    </div>
                    <div class="item-options d-flex flex-column">
                        <i class="fas fa-eye mx-auto"
                           @click="mark_as_read(notification)"/>

                        <i class="fas fa-trash mt-auto mx-auto"/>
                    </div>

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
            notifications: {},
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
        mark_as_read(notification) {
            axios.patch(`/def-components/notifications/${notification.id}/read`, {read: !notification.read_at}, {spinner: false})
                .then(response => this.refresh_notifications())
                .catch(error => console.error(error));
        },
        update_notifications(notifications) {
            const updated_notifications = {};
            for (const notification of notifications) {
                if (this.notifications[notification.id] === undefined) {
                    this.has_unread = true;
                }

                updated_notifications[notification.id] = notification;
            }
            this.notifications = updated_notifications;
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

.notification-item.read {
    opacity: 0.3;
}
</style>
