<script setup>
import {ref} from "vue";

const props = defineProps({
    total: 0,
    created: 0,
    updated: 0,
})

const total = ref(props.total)
const created = ref(props.created)
const updated = ref(props.updated)

const isLoading = ref(false)
const handleUploadUsers = async () => {
    try {
        isLoading.value = true
        const {data} = await axios.get('/upload')

        total.value = data.total
        created.value = data.created
        updated.value = data.updated

    } catch (e) {
        console.log(e)

        alert(e.message ?? 'Произошла ошибка!')
    } finally {
        isLoading.value = false
    }
}
</script>

<template>
    <div
        v-if="isLoading"
        class="fixed text-9xl w-[100vw] h-[100vh] bg-white bg-opacity-50 flex justify-center items-center"
    >
         Загрузка...
    </div>
    <div class="max-w-[1400px] mx-auto my-10 flex justify-center gap-x-5 items-center">
        <div
            @click="handleUploadUsers"
            class="bg-pink-600 p-3 rounded-2xl text-white cursor-pointer"
        >
            импортировать пользователей
        </div>

        <div>
            Всего: <span class="font-semibold">{{total ? total : 0}}</span>
        </div>

        <div>
            Добавлено: <span class="font-semibold">{{created ? created : 0}}</span>
        </div>

        <div>
            Обновлено: <span class="font-semibold">{{updated ? updated : 0}}</span>
        </div>
    </div>

</template>

<style scoped>

</style>
