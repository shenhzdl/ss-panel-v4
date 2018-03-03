<template>

    <div class="content-padder content-background">
        <div class="uk-section-small uk-section-default header">
            <div class="uk-container uk-container-large">
                <h3><span class="ion-speedometer"></span> {{$t("admin-nav.users")}} </h3>
            </div>
        </div>
        <div class="uk-section-small">
            <div class="uk-container uk-container-large">
                <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <div class="uk-margin">
                            <div class="uk-search uk-search-default">
                                <a href="#" class="uk-search-icon-flip" uk-search-icon v-on:click="Results(1)"></a>
                                <input class="uk-search-input" type="search" placeholder="Search..." v-model="keyword" v-on:keyup.enter="Results(1)"/>
                            </div>
                            <button class="uk-margin-left uk-button uk-button-primary" v-on:click="setall">
                                    {{$t("user-info.reset-enable")}}
                            </button>
                        </div>
                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{$t("user-info.user-name")}}</th>
                                    <th>{{$t("user-info.email")}}</th>
                                    <th>{{$t("user-info.transfer-upload")}}</th>
                                    <th>{{$t("user-info.transfer-download")}}</th>
                                    <th>{{$t("user-info.transfer-enable")}}</th>
                                    <th>{{$t("user-info.expire-time")}}</th>
                                    <th>{{$t("user-info.enable")}}</th>
                                    <th>{{$t("user-info.reg-ip")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="c in data.data">
                                    <td>#{{c.id}}</td>
                                    <td>{{c.user_name}}</td>
                                    <td>{{c.email}}</td>
                                    <td>{{bytesToSize(c.u)}}</td>
                                    <td>{{bytesToSize(c.d)}}</td>
                                    <td>{{bytesToSize(c.transfer_enable)}}</td>
                                    <td>{{timeFormat(c.expire_time)}}</td>
                                    <td><input class="uk-checkbox" type="checkbox" v-model="c.enable" v-on:click="setone(c)"></td>
                                    <td>{{c.reg_ip}}</td>
                                    <td> <div class="uk-margin">
                                        <router-link tag="li" :to="{ name: 'orderadd',params:{user_id:c.id }}" exact>
                                            <button class="uk-button uk-button-primary">
                                                {{$t("admin.add-order")}}
                                            </button>
                                        </router-link>
                                    </div></td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :data="data" v-on:pagination-change-page="Results"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import admin from '../../http/admin'
    import pagination from 'laravel-vue-pagination-uikit'
    import {bytesToSize,notify} from '../../tools/util'

    export default
    {
        name: 'Users',
        components: {
            pagination,
        },
        data () {
            return {
                data: {},
                keyword:''
            }
        },
        methods: {
            Results(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                admin.get(`users?page=` + page + '&keyword=' + this.keyword)
                    .then(response => {
                        this.data = response.data;
                        for (let index = 0; index < this.data.data.length; index++) {
                            this.data.data[index].enable = this.data.data[index].enable == 1;
                        }
                        this.logs = response.data.data;
                    })
                    .catch(e => {
                    })
            },
            setall()
            {
                admin.post('setuser')
                .then(response=>{
                    UIkit.notification({
                        message: this.$t('base.success'),
                        status: 'primary',
                        pos: 'top-center',
                        timeout: 5000
                    });
                    this.Results();
                })
                .catch(e=>{
                    UIkit.notification({
                        message: this.$t('base.something-wrong'),
                        status: 'danger',
                        pos: 'top-center',
                        timeout: 5000
                    });
                });
            },
            setone(item)
            {
                item.enable = !item.enable;
                admin.post('setone',
                {
                    user_id:item.id,
                    enable:item.enable
                })
                .then(response=>{
                    UIkit.notification({
                        message: this.$t('base.success'),
                        status: 'primary',
                        pos: 'top-center',
                        timeout: 5000
                    });
                    this.Results();
                })
                .catch(e=>{
                    UIkit.notification({
                        message: this.$t('base.something-wrong'),
                        status: 'danger',
                        pos: 'top-center',
                        timeout: 5000
                    });
                });
            },
            timeFormat(ut){
                return new Date(ut * 1e3).toLocaleDateString();
            },
            bytesToSize,
        },
        mounted: function () {
            this.Results();
        },
    }
</script>