<template>
    <div :class="['border-'+notification.data.color]"
         class="notification-item d-flex">

        <div class="item-content flex-grow-1">
            <h4 class="item-title" v-text="notification.data.title"/>
            <p class="item-info" v-text="notification.data.message"/>
        </div>

        <div class="item-options d-flex flex-column">
            <i class="fas fa-trash delete-item mt-auto mx-auto"
               role="button"
               @click="$emit('destroy-notification', notification)"/>
        </div>

    </div>
</template>

<script>
export default {
    name: "Notification",
    props: ['notification'],
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
}
</style>
