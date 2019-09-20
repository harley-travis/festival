Vue.component('subscribe-button', {

    props: {
        channel: {
            type: Object,
            required: true,
            default: () =>({})
        },
        subscriptions: {
            type: Array,
            required: true,
            default: () => []
        }
    },

    computed: {

        subscribed() {
            
            if(! __auth() || this.channel.user_id === __auth().id) return false

            // double exclamation is to cast it to a boolean
            return !!this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        },

        owner() {

            if( __auth() && this.channel.user_id === __auth().id) return true

            return false

        },

    },

    methods: {

        // check to see if the user is logged in
        toggleSubscription() {
            if(! __auth() ){
                alert('Please login to subscribe')
            }
        }

    }

})