<template>
    <div class="mb-4">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <img v-if="comment.user.avatar" :src="comment.user.avatar" alt="" class="avatar-img mr-3 rounded-circle" height="45" width="45">
                <img v-else :src="defaultavatar" alt="" class="avatar-img mr-3 rounded-circle" height="45" width="45">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <a :href="`/${locale}/profile/` + comment.user.slug" class="color-black t-r_r-14 mr-3">
                            {{ comment.user.name }}
                        </a>
                        <template v-if="parent">
                            <span class="t-r_r-14 color-gray">
                                To {{ parent.user.name }}
                            </span>
                        </template>
                    </div>
                    <div class="t-r_r-10">{{ comment.date }}</div>
                </div>
            </div>
            <div class="d-flex article-metrics">
                <div class="c-pointer d-flex align-items-center mr-4" @click="like(comment)">
                    <span class="t-r_b-24 mr-1">{{ comment.likes_count }}</span>
                    <span class="text-success">+</span>
                </div>
                <div class="c-pointer d-flex align-items-center mr-4" @click="dislike(comment)">
                    <span class="t-r_b-24 mr-1">{{ comment.dislikes_count }}</span>
                    <span class="text-danger">-</span>
                </div>
            </div>
        </div>
        <img v-if="comment.image" :src="comment.image" alt="" width="300" class="mb-3">
        <p class="mb-3 t-r_r-14">{{ comment.text }}</p>
        <div class="d-flex align-items-center mb-3">
            <a href="#" class="color-dark text-decoration-none t-r_r-14 mr-4" @click.prevent="$root.reply = comment">Reply</a>
        </div>
        <div class="user-answer pl-4" v-if="comment.replies && comment.replies.length">
            <note-comment :parent="comment" :comment="answer" v-for="answer in comment.replies" :key="answer.id" :defaultavatar="defaultavatar"></note-comment>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment', 'defaultavatar', 'parent', 'locale'],
        methods: {
            like: function(comment) {
                if(!window.apiToken) {
                    return
                }
                fetch('/api/comments/' + comment.id + '/like?api_token=' + window.apiToken)
                .then(response => response.json())
                .then(json => {
                    comment.likes_count = json.likes
                    comment.dislikes_count = json.dislikes
                })
            },
            dislike: function(comment) {
                if(!window.apiToken) {
                    return
                }
                fetch('/api/comments/' + comment.id + '/dislike?api_token=' + window.apiToken)
                .then(response => response.json())
                .then(json => {
                    comment.likes_count = json.likes
                    comment.dislikes_count = json.dislikes
                })
            }
        }
    }
</script>
