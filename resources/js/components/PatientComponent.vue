<template>
    <w-form
        v-on:submit="addNewPatient"
        target="_blank"
        allow-submit>

        <w-input
            label="First name"
            v-model="firstName"
        >

        </w-input>

        <w-input
            class="mt3"
            label="Last name"
            v-model="lastName"
        >
        </w-input>

        <w-input
            type="date"
            label="date"
            v-model="date"
        ></w-input>
        <div class="text-right mt6">
            <w-button type="submit">Send</w-button>
        </div>
        <div v-if="this.errorsMessages.length">
            <div v-for="error in this.errorsMessages" class="red">{{error}}</div>
        </div>
    </w-form>
</template>

<script>
export default {
    data: () => ({
        firstName: '',
        lastName: '',
        date: '',
        errors: [],
        errorsMessages: [],
    }),
    methods: {
        async addNewPatient(e) {
            e.preventDefault()
            this.errorsMessages = []
            await axios.post('/add-new-patient', {
                firstName: this.firstName,
                lastName: this.lastName,
                date: this.date,
            }).then((res) => {
                this.clearFormData()
            }).catch((err) => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors
                    for (const key in this.errors) {
                        if (this.errors.hasOwnProperty(key)) {
                            this.errorsMessages.push(this.errors[key][0])
                        }
                    }
                }
            })
        },

        clearFormData() {
            this.firstName = ''
            this.lastName = ''
            this.date = ''
        }
    }
}

</script>

