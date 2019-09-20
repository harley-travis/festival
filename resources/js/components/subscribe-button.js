import numeral from 'numeral'
import Axios from 'axios'

Vue.component('subscribe-button', {

    props: {
        channel: {
            type: Object,
            required: true,
            default: () =>({})
        },
        initalSubscriptions: {
            type: Array,
            required: true,
            default: () => []
        }
    },

    data: function() {

        return {
            subscriptions: this.initalSubscriptions
        }

    },

    computed: {

        subscribed() {
            
            if(! __auth() || this.channel.user_id === __auth().id) return false

            // double exclamation is to cast it to a boolean
            return !!this.subscription
        },

        owner() {

            if( __auth() && this.channel.user_id === __auth().id) return true

            return false

        },

        subscription() {

            if(! __auth()) return null

            return this.subscriptions.find(subscription => subscription.user_id === __auth().id) 

        },

        count() {

            return numeral(this.subscriptions.length).format('0a ')

        },

    },

    methods: {

        // check to see if the user is logged in
        toggleSubscription() {
            if(! __auth() ){
                return alert('Please login to subscribe')
            }

            if(this.owner) {
                return alert('You cannot subscribe to your channel')
            }

            if(this.subscribed){

                // using ticks not approstraphes
                axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                    .then(() => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })

            } else {

                axios.post(`/channels/${this.channel.id}/subscriptions`)
                    .then(response => {
                        this.subscriptions = [
                            ...this.subscriptions,
                            response.data
                        ]
                    })
            }

        }

    }

})