<script setup>

import {router, usePage} from "@inertiajs/vue3";
import {defineProps, ref} from "vue";

const page = usePage()
const result = ref('')
const tab = ref(1)
const historyList = ref('')
const winAmount = ref(0)
const props = defineProps({
    link: String
});
const imfeelinglucky = () => {
    axios.post('/lucky/' + props.link, {
        _token: page.props.csrf_token,
    }).then( res => {
        tab.value = 1
        winAmount.value = res.data.data.amount
        result.value = res.data.data.result
        console.log(res);
    }).catch(e => {
        console.error(e)
    })
}

const history = () => {
    axios.get('/lucky/' + props.link + '/history', ).then( res => {
        historyList.value = res.data.data
        tab.value = 2
        console.log(res);
    }).catch(e => {
        console.error(e)
    })
}

const disableLink = () => {
    router.post('/link/' + props.link + '/disable', {
        _token: page.props.csrf_token,
    })
}

const regenerateLink = () => {
    router.post('/link/' + props.link + '/regenerate', {
        _token: page.props.csrf_token,
    })
}
</script>

<template>
    <v-app id="inspire">
        <v-container>
            <v-btn @click="imfeelinglucky">Imfeelinglucky</v-btn>
            <v-btn @click="history">History</v-btn>
            <v-btn @click="disableLink">Disable link</v-btn>
            <v-btn @click="regenerateLink">Regenerate link</v-btn>
            <div v-if="tab == 1">
                <template v-if="result == 'lose'">
                    <div class="accent-red-600">Lose</div>
                </template>
                <template v-else-if="result == 'win'">
                    <div class="accent-red-600">Win</div>
                    <div class="accent-red-600">Amount: {{ winAmount }}</div>
                </template>
            </div>
            <div v-if="tab == 2">
                <table class="table" style="width: 100px" >
                    <tr>
                        <th>Result</th>
                        <th>Amount</th>
                    </tr>
                    <tr v-for="item in historyList">
                        <td>{{ item.result }}</td>
                        <td>{{ item.win_amount }}</td>
                    </tr>
                </table>
            </div>
        </v-container>
    </v-app>
</template>

<style scoped>
td,th {
    border: 1px solid #898787;
    min-width: 100px;
}

</style>
