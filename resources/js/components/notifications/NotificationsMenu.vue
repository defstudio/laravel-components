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
           @click="mark_all_as_read()"
        />


        <div aria-labelledby="dropdown-label" class="dropdown-menu notifications" role="menu" @click="$event.stopPropagation()">
            <div class="notifications-wrapper">

                <div v-for="(notification, index) in notifications"
                     class="notification-item d-flex"
                     v-bind:class="[
                         'border-'+notification.data.color,
                     ]">

                    <div class="item-content flex-grow-1">
                        <h4 class="item-title" v-text="notification.data.title"/>
                        <p class="item-info" v-text="notification.data.message"/>
                    </div>
                    <div class="item-options d-flex flex-column">
                        <i class="fas fa-trash delete-item mt-auto mx-auto"
                           role="button"
                           @click="destroy(index)"/>
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

            for (const notification_id in this.notifications) {
                if (this.notifications[notification_id].read_at) continue;

                this.notifications[notification_id] = new Date();

                axios.patch(`/def-components/notifications/${notification_id}/read`, {
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
        destroy(notification_index) {
            const notification = this.notifications[notification_index];
            this.notifications.splice(notification_index, 1);

            axios.delete(`/def-components/notifications/${notification.id}`, {
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
