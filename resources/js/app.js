import './bootstrap';
import { createApp } from 'vue';
import ChatMessage from './components/ChatMessage.vue';
import ChatLog from './components/ChatLog.vue';
import ChatComposer from './components/ChatComposer.vue';

const app = createApp({
    data() {
        return {
            messages: [],
            usersInRoom: []
        };
    },
    methods: {
        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message);
        }
    },
    created() {
        axios.get('/messages').then(response => {
            this.messages = response.data;
        });

        Echo.join('chatroom')
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user);
            })
            .listen('MessagePosted', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    }
});

app.component('chat-message', ChatMessage);
app.component('chat-log', ChatLog);
app.component('chat-composer', ChatComposer);

app.mount('#app');
