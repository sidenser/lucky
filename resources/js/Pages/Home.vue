<script setup>
import {defineProps, ref} from 'vue';
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const valid = ref(false);
const formRef = ref(null)
const form = ref({
    username: '',
    phone: '',
})

const errors = ref()

const rules = {
    required: (value) => !!value || 'This field is required',
}

const submit = async () => {

    if (formRef.value && formRef.value.validate()) {
        errors.value = null
        router.post('/registration', {
            _token: page.props.csrf_token,
            username: form.value.username,
            phone: form.value.phone,
        },
        {
            onError: (errorResponse) => {
                errors.value = errorResponse
            },
        })
    }
}
</script>
<template>
<div>
    <v-container>
        <v-row>
            <v-col cols="12" class="text-center">
                <template v-for="error in errors">
                    <v-alert
                        color="error"
                        :text="error"
                    ></v-alert>
                </template>
            </v-col>
        </v-row>
    </v-container>
    <v-form ref="formRef"  v-model="valid" lazy-validation >
        <v-container>
            <v-row>
                <v-col cols="12" class="text-center">
                    <h1>Registration</h1>
                </v-col>

                <v-col cols="12">
                    <v-text-field
                        label="Username"
                        v-model="form.username"
                        :rules="[rules.required]"
                        outlined
                        hint=""
                        persistent-hint
                    />
                </v-col>

                <v-col cols="12">
                    <v-text-field
                        label="Phone number"
                        v-model="form.phone"
                        :rules="[rules.required]"
                        outlined
                        hint=""
                        persistent-hint
                    />
                </v-col>

                <v-col cols="12" class="text-center">
                    <v-btn color="primary" @click="submit">Register</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </v-form>
</div>
</template>
<style scoped>

</style>
