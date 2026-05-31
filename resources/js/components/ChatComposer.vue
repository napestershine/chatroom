<template>
    <div class="chat-composer">
        <input id="message" type="text" placeholder="Start typing your message..."
               v-model="messageText" @keyup.enter="sendMessage">
        <button class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messageText: ''
        };
    },
    methods: {
        sendMessage() {
            const userName = document.querySelector('meta[name="user-name"]')?.content || '';
            this.$emit('messagesent', {
                message: this.messageText,
                user: {
                    name: userName
                }
            });
            this.messageText = '';
        }
    }
};
</script>

<style scoped>
.chat-composer {
    display: flex;
}
.chat-composer input {
    flex: 1 auto;
    padding: .5rem 1rem;
}
.chat-composer button {
    border-radius: 0;
}
</style>
