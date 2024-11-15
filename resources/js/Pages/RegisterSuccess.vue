<script setup>
import { ref, defineProps } from 'vue';
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const props = defineProps({
    link: String
});

const link = ref(props.link)
const textToCopy = ref()
const copyText = () => {
    let text = textToCopy.value.$el.querySelector('input')
    text.select()
    document.execCommand("copy");
}

const open = () => {
    document.location.href = link.value
}

</script>
<template>
<div>
    <v-app id="inspire">
        <v-container>
                <v-text-field
                    label="Uni link"
                    v-model="link"
                    readonly
                    outlined
                    hint=""
                    ref="textToCopy"
                    persistent-hint
                />
                <v-btn @click="copyText">copy</v-btn>
                <v-btn @click="open">open</v-btn>
        </v-container>
    </v-app>
</div>
</template>
<style scoped>

</style>
