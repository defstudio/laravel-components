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
           @click="handle_dropdown_open()"
        />

        <div aria-labelledby="dropdown-label" class="dropdown-menu notifications" role="menu" @click="$event.stopPropagation()">
            <div class="notifications-wrapper">
                <transition-group name="notifications-list" tag="p">
                    <notification v-for="notification in notifications"
                                  :key="notification.id"
                                  :notification="notification"
                                  @destroy-notification="destroy_notification"/>
                </transition-group>
            </div>

        </div>

        <div class="toasts-container">
            <transition-group name="notifications-list" tag="p">
                <notification v-for="toast in toasts"
                              :key="toast.id"
                              :deletable="false"
                              :notification="toast"
                              @click="destroy_toast(toast)"/>
            </transition-group>
        </div>

    </div>
</template>

<script>
export default {
    name: "NotificationsMenu",
    data() {
        return {
            notifications: [],
            toasts: [],
        }
    },
    props: {
        userId: {
            required: true,
        }
    },
    computed: {
        has_unread() {
            if (this.notifications.length === 0) return false;
            return this.notifications.filter(notification => !notification.read_at).length > 0;
        }
    },
    mounted() {
        this.refresh_notifications();
        this.setup_echo_listener();
    },
    methods: {
        setup_echo_listener() {
            if (!window.Echo) return;

            window.Echo.private(`App.Models.User.${this.userId}`)
                .notification(notification => {
                    if (notification.def_components_notification) {
                        this.show_toast_notification(notification);
                        this.refresh_notifications();
                    }
                });
        },
        show_toast_notification(toast) {
            if (!this.is_dropdown_open()) {
                this.toasts.push(toast);
                setTimeout(
                    () => this.destroy_toast(toast),
                    5000
                );
            }
        },
        is_dropdown_open() {
            return this.$el.querySelector('.notifications').classList.contains('show');
        },
        refresh_notifications() {
            console.debug('refresh');
            axios.get('/def-components/notifications', {spinner: false})
                .then(response => this.notifications = response.data)
                .catch(error => console.error(error));
        },
        handle_dropdown_open() {
            this.toasts = [];
            for (const notification of this.notifications) {
                if (notification.read_at) continue;
                notification.read_at = new Date();
                axios.patch(`/def-components/notifications/${notification.id}/read`, {
                    read: true
                }, {
                    spinner: false
                });
            }
        },
        destroy_notification(notification_to_destroy) {
            this.notifications = this.notifications.filter(notification => notification.id !== notification_to_destroy.id);
            axios.delete(`/def-components/notifications/${notification_to_destroy.id}`, {
                spinner: false
            }).catch(error => console.error(error));
        },
        destroy_toast(toast_to_destroy) {
            this.toasts = this.toasts.filter(notification => notification.id !== toast_to_destroy.id)
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
    overflow: hidden;
    left: unset;
    right: -15px;
    min-width: 420px;
}

.toasts-container {
    min-width: 420px;
    position: absolute;
    right: -15px;
    z-index: 500;
}

.notification-item {
    transition: all 1s;
}

.notifications-list-leave-to {
    opacity: 0;
    transform: translateX(200px);
}

.notifications-list-enter {
    opacity: 0;
    transform: translateX(200px);
}

.notifications-list-leave-active {
    position: absolute;
    min-width: 420px;
}

</style>
