<template>
    <div class="container mx-auto px-4 mt-12">
        <h2 class="text-xl font-bold border-l-4 border-gray-900 text-green-800 ml-2 pl-2">UPCOMING EVENTS</h2>
        <br>
        <div>
            <h3>Create Event</h3>
        </div>
        <input v-model="data.name"
                placeholder="Create Event Name"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

        <input v-model="data.location"
                placeholder="Create Event Location"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

        <input v-model="data.start_at"
                placeholder="Create Event Starting time"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

        <input v-model="data.end_at"
                placeholder="Create Event Ending time"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

        <textarea v-model="data.description"
                placeholder="Create event description"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        </textarea>
        <div>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="saveEvent">Save</button>
            <button class="bg-teal-300 hover:bg-teal-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="resetEdit">Cancel</button>
        </div>
        <div class="px-2">
            <div class="md:flex flex-wrap -mx-2">
                <event v-for="event in events"
                        :key="event.id"
                        :user="user"
                        :event="event"
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
                events: [
                    {
                        id: 1,
                        name: "Baby Shower",
                        location: "Kianjai, Meru Kenya",
                        description: "You have a new message, Read it and give your feedback.",
                        start_at: "MAR 15 SUN 12:06",
                        end_at: "MAR 15 SUN 18:06",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        owner: {
                            id: 1,
                            name: 'Anderson King',
                        }
                    },
                    {
                        id: 2,
                        name: "Baby Shower",
                        location: "Kianjai, Meru Kenya",
                        description: "You have a new message, Read it and give your feedback.",
                        start_at: "MAR 15 SUN 12:06",
                        end_at: "MAR 15 SUN 18:06",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        owner: {
                            id: 2,
                            name: 'Sammy Mwangangi',
                        }
                    },
                    {
                        id: 3,
                        name: "Baby Shower",
                        location: "Kianjai, Meru Kenya",
                        description: "You have a new message, Read it and give your feedback.",
                        start_at: "MAR 15 SUN 12:06",
                        end_at: "MAR 15 SUN 18:06",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        owner: {
                            id: 3,
                            name: 'Joy Floh',
                        }
                    },
                    {
                        id: 4,
                        name: "Baby Shower",
                        location: "Kianjai, Meru Kenya",
                        description: "You have a new message, Read it and give your feedback.",
                        start_at: "MAR 15 SUN 12:06",
                        end_at: "MAR 15 SUN 18:06",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        owner: {
                            id: 3,
                            name: 'Joy Floh',
                        }
                    },
                ]
            }
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
            // saveEvent() {
            //     const t = this;
            //     axios.post('/events', t.data)
            //     .then(({data}) => {
            //         t.events.unshift(data);
            //         t.stopEditing();
            //     })
            // },
            saveEvent() {
                let newEvent = {
                    id: this.events[this.events.length - 1].id + 1,
                    name: this.data.name,
                    location: this.data.location,
                    start_at: this.data.start_at,
                    end_at: this.data.end_at,
                    description: this.data.description,
                    edited: false,
                    created_at: new Date().toLocaleString(),
                    owner: {
                        id: this.user.id,
                        name: this.user.name,
                    }
                }

                this.events.push(newEvent);
                
                this.data.name = '';
                this.data.location = '';
                this.data.start_at = '';
                this.data.end_at = '';
                this.data.description = '';
            },
            eventIndex(eventId) {
                return this.events.findIndex((element) => {
                    return element.id === eventId;
                });
            }
        }
    }
</script>