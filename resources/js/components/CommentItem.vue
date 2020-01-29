<template>
        <div class="w-1/3 px-2 mb-5">
            <div v-show="state === 'default'" class="max-w-sm w-full lg:max-w-full lg:flex">
                <div class="shadow-md h-48 lg:h-auto lg:w-48 flex-none overflow-hidden bg-cover bg-gray-600 text-white rounded-t lg:rounded-t-none lg:rounded-l" style="background-image: url('/images/party.svg')" title="party">
                    <p class="mt-4 text-center text-md"><b>STARTS:</b> {{event.start_at}}</p>
                    <p class="mt-4 text-center text-md"><b>ENDS:</b> {{event.end_at}}</p>
                </div>
                <div class="shadow-md border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <p class="text-sm text-gray-600 flex items-center">By: {{event.owner.name}}</p>
                    <a href="">
                        <h2 class="tracking-wide text-md text-blue-600 font-bold leading-tight">{{event.name}}</h2>
                    </a>
                    <h6 class="block mt-1 text-xs text-gray-900 leading-tight"><i class="fas fa-map-marker-alt"></i> {{event.location}}</h6>
                    <p class="mt-2 text-xs text-gray-600 leading-normal">{{event.description}}</p>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded items-center mt-2" v-if="editable" @click="state = 'editing'"><i class="fas fa-edit"></i> Edit</button>
                </div>
            </div>
            <div v-show="state === 'editing'">
                <div>
                    <h3>Update Event</h3>
                </div>
                <input v-model="data.name"
                        placeholder="Update Event Name"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

                <input v-model="data.location"
                        placeholder="Update Event Location"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

                <input v-model="data.start_at"
                        placeholder="Update Event Starting time"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

                <input v-model="data.end_at"
                        placeholder="Update Event Ending time"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-4">

                <textarea v-model="data.description"
                        placeholder="Update event description"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </textarea>
                <div>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="saveEdit">Update</button>
                    <button class="bg-teal-300 hover:bg-teal-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="resetEdit">Cancel</button>
                    <button class="bg-red-300 hover:bg-red-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-2" @click="deleteEvent">Delete</button>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props: {
            user: {
                required: true,
                type: Object,
            },
            event: {
                required: true,
                type: Object,
            }
        },
        data: function() {
            return {
                state: 'default',
                data: {
                    name: this.event.name,
                    location: this.event.location,
                    start_at: this.event.start_at,
                    end_at: this.event.end_at,
                    description: this.event.description,
                }
            }
        },
        computed: {
            editable() {
                return this.user.id === this.event.owner.id;
            }
        },
        methods: {
            resetEdit() {
                this.state = 'default';
                this.data.name = this.event.name;
                this.data.location = this.event.location;
                this.data.start_at = this.event.start_at;
                this.data.end_at = this.event.end_at;
                this.data.description = this.event.description;
            },
            saveEdit() {
                this.state = 'default';
                this.$emit('event-updated', {
                    'id': this.event.id,
                    'name': this.data.name,
                    'location': this.data.location,
                    'start_at': this.data.start_at,
                    'end_at': this.data.end_at,
                    'description': this.data.description,
                });
            },
            deleteEvent() {
                this.$emit('event-deleted', {
                    'id': this.event.id,
                });
            }
        }
    }
</script>