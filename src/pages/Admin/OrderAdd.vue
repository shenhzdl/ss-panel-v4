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
                            <label class="uk-form-label"
                                   for="form-horizontal-text">{{$t("order.user-id")}}</label>
                            <div class="uk-form-controls">
                                <input readonly="readonly" class="uk-input" id="form-horizontal-text" type="text"
                                       v-model="user_id">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label"
                                   for="form-horizontal-text">{{$t("order.method")}}</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-horizontal-select" v-model="method">
                                    <option v-for="m in methods" :value="m" >{{m}}</option>
                                </select>
    
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label"
                                   for="form-horizontal-text">{{$t("order.amount")}}</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-horizontal-text" type="text"
                                       v-model="amount">
                            </div>
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
                            <label class="uk-form-label"
                                   for="form-horizontal-text">{{$t("order.renew")}}</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-horizontal-select" v-model="renew">
                                    <option v-for="(value, key) in renews" :value="value" >{{key}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" @click="add">
                                {{$t("admin.add")}}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import admin from '../../http/admin'

    export default
    {
        name: 'Order',
        components: {},
        data () {
            return {
                methods:['支付宝','微信支付','友情赠送'],
                renews:{
                    '一个月':1,
                    '三个月':3,
                    '半年':6,
                    '一年':12,
                    },
                user_id:this.$route.params.user_id,
                method:'支付宝',
                tradeno:'',
                amount:0,
                renew:1,
            }
        },
        methods:{
            add()
            {
                admin.post('orders',
                {
                    user_id:this.user_id,
                    method:this.method,
                    amount:this.amount,
                    tradeno:this.tradeno,
                    renew:this.renew
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