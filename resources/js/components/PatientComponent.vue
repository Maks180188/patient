<template>
    <div class="patient-form">
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
                class="date-input"
            ></w-input>
            <div class="text-right mt6">
                <w-button type="submit">Send</w-button>
            </div>
            <div v-if="this.errorsMessages.length">
                <div v-for="error in this.errorsMessages" class="red">{{error}}</div>
            </div>
        </w-form>

        <div class="table">
            <w-table
                :headers="table.headers"
                :items="table.items">
            </w-table>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        firstName: '',
        lastName: '',
        date: '',
        errors: [],
        errorsMessages: [],
        table: {
            headers: [
                { label: 'ID', key: 'id' },
                { label: 'First name', key: 'first_name' },
                { label: 'Last name', key: 'last_name' },
                { label: 'Age', key: 'age' },
                { label: 'Age type', key: 'age_type' },
            ],
            items: []
        }
    }),
    mounted() {
        this.fetchPatients()
    },
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

        async fetchPatients() {
            await axios.get('/get-patients').then((res) => {
                this.table.items = res.data
            }).catch((err) => {
                console.log('error', err)
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

<style>
.patient-form {
    width: 700px
}
.date-input {
    margin-top: 10px
}
.table {
    margin-top: 20px
}
</style>
