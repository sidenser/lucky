<script setup>
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const valid = ref(false);
const formRef = ref(null)
const isGenerate = ref(false)
const form = ref({
    username: '',
    phone: '',
});

const rules = {
    required: (value) => !!value || 'This field is required',
};

const submit = async () => {

    if (formRef.value && formRef.value.validate()) {
        isGenerate.value = true

        router.post('/registration', {
            _token: page.props.csrf_token,
            username: form.value.username,
            phone: form.value.phone,
        })
    }
}
</script>
<template>
<div>
    <v-row v-show="isGenerate">
        <v-col cols="12" class="text-center">
            <div class="progress">
                <v-progress-circular
                    color="primary"
                    indeterminate
                    :size="100"
                    :width="9"
                ></v-progress-circular>
            </div>
        </v-col>
    </v-row>
    <v-form ref="formRef" v-show="!isGenerate" v-model="valid" lazy-validation>
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
