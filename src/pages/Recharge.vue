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
                        <div class="uk-margin">
                            <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                                <div>
                                    <img src="/assets/img/zfbqrcode10.jpg" width="200" alt="">
                                </div>
                                <div>
                                    <img src="/assets/img/zfbqrcode30.jpg" width="200" alt="">
                                </div>
                                <div>
                                    <img src="/assets/img/zfbqrcode100.jpg" width="200" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <span class="uk-label uk-label-primary uk-text-bold">注</span>
                            <span class="uk-text-muted uk-text-middle">支付宝扫码后输入订单号充值，一次性充值超过三个月每三个月送一个邀请码</span>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-form-controls">
                                <input class="uk-input uk-width-1-2" v-bind:placeholder="$t('order.tradeno')" id="form-horizontal-text" type="text"
                                       v-model="tradeno">
                                <button class="uk-button uk-button-primary" @click="recharge">
                                    {{$t("user-index.recharge")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                tradeno: '',
            }
        },
        methods:{
            recharge(){
                rest.post('recharge',{
                    tradeno:this.tradeno
                })
                .then(response=>{
                    if(response.data.data.success)
                    {
                        UIkit.notification({
                            message: this.$t('base.success'),
                            status: 'primary',
                            pos: 'top-center',
                            timeout: 5000
                        });
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
                    
                })
                .catch(err=>{
                    UIkit.notification({
                        message: this.$t('base.something-wrong'),
                        status: 'danger',
                        pos: 'top-center',
                        timeout: 5000
                    });
                });
            }
        }
    }
</script>