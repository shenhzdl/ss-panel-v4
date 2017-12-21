<template>

    <div class="content-padder content-background">
        <div class="uk-section-small uk-section-default header">
            <div class="uk-container uk-container-large">
                <h3><span class="ion-speedometer"></span> {{$t("admin-nav.orders")}} </h3>
            </div>
        </div>
        <div class="uk-section-small">
            <div class="uk-container uk-container-large">
                <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <table class="uk-table uk-table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{$t("order.user-id")}}</th>
                                    <th>{{$t("order.tradeno")}}</th>
                                    <th>{{$t("order.total")}}</th>
                                    <th>{{$t("order.renew")}}</th>
                                    <th>{{$t("order.time")}}</th>
                                    <th>{{$t("order.method")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="c in data.data">
                                    <td>#{{c.id}}</td>
                                    <td>{{c.user_id}}</td>
                                    <td>{{c.tradeno}}</td>
                                    <td>{{c.total}}</td>
                                    <td>{{c.renew}}个月</td>
                                    <td>{{timeFormat(c.datetime)}}</td>
                                    <td>{{c.method}}</td>
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
    import {notify} from '../../tools/util'

    export default
    {
        name: 'Orders',
        components: {
            pagination,
        },
        data () {
            return {
                data: {},
            }
        },
        methods: {
            Results(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                admin.get(`orders?page=` + page)
                    .then(response => {
                        this.data = response.data;
                        this.logs = response.data.data;
                    })
                    .catch(e => {
                    })
            },
            timeFormat(ut){
                return new Date(ut * 1e3).toLocaleDateString();
            },
        },
        mounted: function () {
            this.Results();
        },
    }
</script>