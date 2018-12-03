<template>

    <div class="content-padder content-background">
        <div class="uk-section-small uk-section-default header">
            <div class="uk-container uk-container-large">
                <h3><span class="ion-speedometer"></span> {{$t("admin-nav.orders")}} </h3>
            </div>
        </div>
        <div class="uk-section-small">
            <div class="uk-container uk-container-large">
                <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@m uk-child-width-1-2@xl">
                    <div class="uk-card uk-card-default uk-card-body">
                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                            <label><input class="uk-radio" value="0" v-model="monthIndex" type="radio"> {{months[0].text}}</label>
                            <label><input class="uk-radio" value="1" v-model="monthIndex" type="radio" checked> {{months[1].text}}</label>
                            <label><input class="uk-radio" value="2" v-model="monthIndex" type="radio"> {{months[2].text}}</label>
                        </div>
                        <div class="uk-margin">
                            <span class="uk-label uk-label-primary uk-text-bold">{{$t("user-index.note")}}</span>
                            <span class="uk-text-muted uk-text-middle">{{$t("user-index.recharge-info")}}</span>
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" @click="getQrCode">
                                    {{$t("user-index.recharge")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-qrcode" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">{{$t("user-index.recharge") + "-" +months[monthIndex].text}}</h2>
            <p style="text-align:center">
                <img v-if="isqrload" v-bind:src="qrcodeurl" v-bind:alt="$t('user-index.qrcode')">
                <span v-else uk-spinner="ratio: 4.5"></span>
            </p>
        </div>
    </div>
</template>

<script>
    import rest from '../http/rest'

    export default 
    {
        name: 'Recharge',
        components: {},
        data () {
            return {
                months:[{text:'一个月',value:1},{text:'三个月',value:3},{text:'一年',value:12}],
                monthIndex:1,
                tradeno: '',
                qrcodeurl:'/assets/img/zfberror.jpg',
                isqrload:false,
                checkTask:null,
                modal:null
            }
        },
        methods:{
            getQrCode(){
                this.isqrload = false;
                if(this.checkTask != null)
                {
                    clearInterval(this.checkTask);
                    this.checkTask = null;
                }
                var that = this;
                setTimeout(function(){
                    that.qrcodeurl = '/assets/img/zfbtimeout.jpg'
                    if(that.checkTask != null)
                    {
                        clearInterval(that.checkTask);
                        that.checkTask = null;
                    }
                },3*60*1000);
                
                rest.get('getQrCode?month=' + this.months[this.monthIndex].value)
                .then(response=>{
                    if(response.data.data.filename != '')
                    {
                        that.qrcodeurl = '/assets/img/' + response.data.data.filename + '.jpg';
                        that.checkTask = setInterval(that.checkPayed,10*1000);
                    }
                    else
                    {
                        UIkit.notification({
                            message: this.$t('base.something-wrong'),
                            status: 'danger',
                            pos: 'top-center',
                            timeout: 5000
                        });
                    }
                    that.isqrload = true;
                })
                .catch(err=>{
                    UIkit.notification({
                        message: this.$t('base.something-wrong'),
                        status: 'danger',
                        pos: 'top-center',
                        timeout: 5000
                    });
                    that.isqrload = true;
                });
                this.modal =UIkit.modal('#modal-qrcode');
                this.modal.show();
            },
            checkPayed()
            {
                var that = this;
                rest.get('isPayed').then(response=>{
                    if(response.data.data.success)
                    {
                        UIkit.notification({
                            message: this.$t('base.success'),
                            status: 'primary',
                            pos: 'top-center',
                            timeout: 5000
                        });
                        clearInterval(that.checkTask);
                        if(that.modal != null)
                        {
                            that.modal.hide();
                        }
                    }
                })
            }
        }
    }
</script>