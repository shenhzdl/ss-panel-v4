<template>
    <div class="container">
        <div class="content-center">
            <h4 class="title text-center"> {{ $t("nav.tutorial-video") }}-PC</h4>
            <video src="/assets/media/tutorial_pc.Ogg" controls="controls" width="480px">
                您的浏览器不支持H5视频播放。
            </video>
            <h4 class="title text-center"> {{ $t("nav.tutorial-video") }}-Android</h4>
            <video src="/assets/media/tutorial_android.Ogg" controls="controls" height="270px">
                您的浏览器不支持H5视频播放。
            </video>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'video',
        components: {},
    }
</script>