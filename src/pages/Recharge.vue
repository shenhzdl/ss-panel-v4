<template>

    <div class="content-padder content-background">
        <div class="uk-section-small uk-section-default header">
            <div class="uk-container uk-container-large">
                <h3><span class="ion-speedometer"></span> {{$t("admin-nav.orders")}} </h3>
            </div>
        </div>
        <div class="uk-section-small">
            <div class="uk-container uk-container-large">
                <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@m uk-child-width-1-4@xl">
                    <div class="uk-card uk-card-default uk-card-body">
                        <div class="uk-margin">
                            <div class="uk-card-media-top">
                                <img class="uk-border-rounded uk-box-shadow-small" src="/assets/img/zfbqrcode.jpg" >
                            </div>
                            <span>
                                1个月/10元
                                <br/>
                                3个月/30元
                                <br/>
                                6个月/50元
                                <br/>
                                1年/100元
                                <br/>
                                请支付宝扫码支付后在下面的输入框输入支付订单号，点击充值按钮进行充值
                            </span>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label"
                                   for="form-horizontal-text">{{$t("order.tradeno")}}</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       v-model="tradeno">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" @click="recharge">
                                {{$t("user-index.recharge")}}
                            </button>
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
                    UIkit.notification({
                        message: this.$t('base.success'),
                        status: 'primary',
                        pos: 'top-center',
                        timeout: 5000
                    });
                    
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