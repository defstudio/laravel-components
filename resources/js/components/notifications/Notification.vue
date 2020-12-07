<template>
    <div :class="['border-'+notification.data.color]"
         class="notification-item d-flex">

        <div class="item-content flex-grow-1">
            <h4 class="item-title">{{ notification.data.title }}</h4>
            <p class="item-info">{{ notification.data.message }}</p>

            <small class="mt-4">
                {{ notification.created_at | format_date }}
            </small>

            <div v-if="notification.data.actions" class="actions-container mt-2">
                <a v-for="(url, label) in notification.data.actions"
                   :href="url"
                   class="btn btn-primary btn-sm"
                >{{ label }}</a>
            </div>
        </div>

        <div v-if="deletable" class="item-options d-flex flex-column">
            <i class="fas fa-trash delete-item mt-auto mx-auto"
               role="button"
               @click="$emit('destroy-notification', notification)"/>
        </div>

    </div>
</template>

<script>
export default {
    name: "Notification",
    props: {
        notification: {
            required: true,
        },
        deletable: {
            default: true,
        },
    },
}
</script>

<style scoped>
.item-title {
    font-size: 1.0rem;
    color: #000;
}

.notification-item {
    padding: 10px;
    margin: 5px;
    border: 1px solid;
    border-radius: 4px;
    background-color: whitesmoke;
}
</style>
