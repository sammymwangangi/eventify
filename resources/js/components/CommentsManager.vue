<template>
    <div class="container mx-auto px-4 mt-12">
        <h2 class="text-xl font-bold border-l-4 border-gray-900 text-green-800 ml-2 pl-2">UPCOMING EVENTS</h2>
        <br>

        <div>
            <h3>Create Event</h3>
        </div>
        <input v-model="data.name"
                placeholder="Create Event Name"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                :class="[state === 'editing' ? 'h-24' : 'h-10']"
                @focus="startEditing">

        <input v-model="data.location"
                placeholder="Create Event Location"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                :class="[state === 'editing' ? 'h-24' : 'h-10']"
                @focus="startEditing">

        <input v-model="data.start_at"
                placeholder="Create Event Starting time"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                :class="[state === 'editing' ? 'h-24' : 'h-10']"
                @focus="startEditing">

        <input v-model="data.end_at"
                placeholder="Create Event Ending time"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                :class="[state === 'editing' ? 'h-24' : 'h-10']"
                @focus="startEditing">

        <textarea v-model="data.description"
                placeholder="Create event description"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                :class="[state === 'editing' ? 'h-24' : 'h-10']"
                @focus="startEditing">
        </textarea>
        <div v-show="state === 'editing'" class="mt-3">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="saveEvent">Save</button>
            <button class="bg-teal-300 hover:bg-teal-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="stopEditing">Cancel</button>
        </div>

        <!-- <div class="bg-white rounded shadow-sm p-8 mb-4">
            <div class="mb-4">
                <h2 class="text-black">Events</h2>
            </div>
            <textarea v-model="data.description"
                      placeholder="Add a comment"
                      class="bg-gray-400 rounded leading-normal resize-none w-full py-2 px-3"
                      :class="[state === 'editing' ? 'h-24' : 'h-10']"
                      @focus="startEditing">
            </textarea>
            <div v-show="state === 'editing'" class="mt-3">
                <button class="border border-teal-300 bg-teal-600 text-white hover:bg-teal-900 py-2 px-4 rounded tracking-wide mr-1" @click="saveEvent">Save</button>
                <button class="border border-gray-600 text-gray-900 hover:bg-gray-800 hover:text-white py-2 px-4 rounded tracking-wide ml-1" @click="stopEditing">Cancel</button>
            </div>
        </div> -->
        
        <div class="mt-4 px-2">
            <div class="md:flex flex-wrap -mx-2">
                <event v-for="(event, index) in events"
                        :key="event.id"
                        :user="user"
                        :event="event"
                        :class="[index === events.length - 1 ? '' : 'mb-6']"
                        @event-updated="updateEvent($event)"
                        @event-deleted="deleteEvent($event)">
                </event>
            </div>
        </div>
    </div>
</template>

<script>
    import event from './CommentItem'
    export default {
        components: {
            event
        },
        props: {
            user: {
                required: true,
                type: Object,
            }
        },
        data: function() {
            return {
                state: 'default',
                data: {
                    description: ''
                },
                events: []
            }
        },
        created() {
            this.fetchEvents();
        },
        methods: {
            startEditing() {
                this.state = 'editing';
            },
            stopEditing() {
                this.state = 'default';
                this.data.name = '';
                this.data.location = '';
                this.data.start_at = '';
                this.data.end_at = '';
                this.data.description = '';
            },
            fetchEvents() {
                const t = this;
                axios.get('/events')
                    .then(({data}) => {
                        t.events = data;
                    })
            },
            updateEvent($event) {
                const t = this;
                axios.put(`/events/${$event.id}`, $event)
                    .then(({data}) => {
                        t.events[t.eventIndex($event.id)].name = data.name;
                        t.events[t.eventIndex($event.id)].location = data.location;
                        t.events[t.eventIndex($event.id)].start_at = data.start_at;
                        t.events[t.eventIndex($event.id)].end_at = data.end_at;
                        t.events[t.eventIndex($event.id)].description = data.description;
                    })
            },
            deleteEvent($event) {
                const t = this;
                axios.delete(`/events/${$event.id}`, $event)
                    .then(() => {
                        t.events.splice(t.eventIndex($event.id), 1);
                    })
            },
            saveEvent() {
                const t = this;
                axios.post('/events', t.data)
                .then(({data}) => {
                    t.events.unshift(data);
                    t.stopEditing();
                })
            },
            eventIndex(eventId) {
                return this.events.findIndex((element) => {
                    return element.id === eventId;
                });
            }
        }
    }
</script>