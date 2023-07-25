<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="el-button el-button--success is-disabled is-round send-button">
        <slot />
    </button>
</template>
