<template>
    <div class="container mx-auto px-4 mt-12">
        <h2 class="text-xl font-bold border-l-4 border-gray-900 text-green-800 ml-2 pl-2">UPCOMING EVENTS</h2>
        <br>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
            <div>
                <h2 class="text-xl font-bold border-b-2 border-gray-900 text-green-800 ml-2 pl-2 mb-6 text-center">Create Event</h2>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event Name
                    </label>
                    <input v-model="data.name"
                            placeholder="Create Event Name"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                            :class="[state === 'editing' ? 'h-24' : 'h-10']"
                            @focus="startEditing">
                </div>

                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event Location
                    </label>
                    <input v-model="data.location"
                            placeholder="Create Event Location"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                            :class="[state === 'editing' ? 'h-24' : 'h-10']"
                            @focus="startEditing">
                </div>

            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event Starting Time
                    </label>
                    <input v-model="data.start_at"
                            placeholder="Create Event Starting time"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                            :class="[state === 'editing' ? 'h-24' : 'h-10']"
                            @focus="startEditing">
                </div>
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event Ending Time
                    </label>
                    <input v-model="data.end_at"
                            placeholder="Create Event Ending time"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4"
                            :class="[state === 'editing' ? 'h-24' : 'h-10']"
                            @focus="startEditing">
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Description
                    </label>
                    <textarea v-model="data.description"
                            placeholder="Create event description"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            :class="[state === 'editing' ? 'h-24' : 'h-10']"
                            @focus="startEditing">
                    </textarea>
                </div>
            </div>
            <div v-show="state === 'editing'" class="mt-3">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="saveEvent">Save</button>
                <button class="bg-teal-300 hover:bg-teal-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="stopEditing">Cancel</button>
            </div>
        </div>
        
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