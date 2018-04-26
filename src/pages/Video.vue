<template>
    <div class="container">
        <div class="content-center">
            <div class="card">
                <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#pc" role="tab" aria-expanded="true">
                            {{ $t("nav.tutorial-video") }}-PC
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#android" role="tab" aria-expanded="false">
                            {{ $t("nav.tutorial-video") }}-Android
                        </a>
                    </li>
                </ul>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-center m-3">
                        <div class="tab-pane active" id="pc" role="tabpanel" aria-expanded="true">
                            <video src="/assets/media/tutorial_pc.Ogg" controls="controls">
                                您的浏览器不支持H5视频播放。
                            </video>
                        </div>
                        <div class="tab-pane" id="android" role="tabpanel" aria-expanded="false">
                            <span class="badge badge-warning">建议使用手动配置的用户同时观看PC版视频</span>
                            <video src="/assets/media/tutorial_android.Ogg" controls="controls">
                                您的浏览器不支持H5视频播放。
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'video',
        components: {},
    }
</script>

<style>
    video{
        max-width: 80%;
        max-height: 36rem;
        margin: auto;
        clear: both;
        display: block;
    }
</style>