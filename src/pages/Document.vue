<template>
    <div class="content-padder content-background">
        <div class="uk-section-small uk-section-default header">
            <div class="uk-container uk-container-large">
                <h3><span class="ion-speedometer"></span> {{$t("user-nav.document")}} </h3>
            </div>
        </div>
        <div class="uk-section-small">
            <div class="uk-container uk-container-large">
                <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-2@m">
                    <div class="uk-card uk-card-default uk-card-body">
                        <ul uk-accordion>
                            <li class="uk-open">
                                <h3 class="uk-accordion-title">ShadowsocksR下载</h3>
                                <div class="uk-accordion-content">
                                    <p>Windwos客户端：<a class="uk-link-muted" href="https://github.com/shadowsocksrr/shadowsocksr-csharp/releases/download/4.9.0/ShadowsocksR-win-4.9.0.zip">下载</a></p>
                                    <p>MacOS客户端：<a class="uk-link-muted" href="#">无下载资源</a></p>
                                    <p>Android客户端：<a class="uk-link-muted" href="#">无下载资源</a></p>
                                </div>
                            </li>
                            <li>
                                <h3 class="uk-accordion-title">原版Shadowsocks下载</h3>
                                <div class="uk-accordion-content">
                                    <p>Windwos客户端：<a class="uk-link-muted" href="https://github.com/shadowsocksr-rm/shadowsocksr-csharp/releases/download/4.7.0.1/ShadowsocksR-4.7.0.1-win.7z">下载</a></p>
                                    <p>MacOS客户端：<a class="uk-link-muted" href="https://github.com/shadowsocks/ShadowsocksX-NG/releases/download/v1.7.0/ShadowsocksX-NG.1.7.0.zip">下载</a></p>
                                    <p>
                                        Android客户端：
                                        <a href="https://play.google.com/store/apps/details?id=com.github.shadowsocks" rel="nofollow">
                                            <img class="uk-width-1-5" src="https://camo.githubusercontent.com/bdaf711a93d64d0bb5e5abfc346a8b84ea47f164/68747470733a2f2f706c61792e676f6f676c652e636f6d2f696e746c2f656e5f75732f6261646765732f696d616765732f67656e657269632f656e2d706c61792d62616467652e706e67" data-canonical-src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png" />
                                        </a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <h3 class="uk-accordion-title">网站使用手册</h3>
                                <div class="uk-accordion-content">
                                    <p>控制面板中可进行签到获取少量流量，流量在月底（以用户注册或充值日期计算）清零。</p>
                                    <p>控制面板中的链接信息以及节点列表中的IP地址用于客户端连接，用户可以选择节点列表中的任意节点或者使用客户端提供的负载均衡功能同时使用多个节点</p>
                                    <p>如果使用原版Shadowsocks，设置中obfs Protocol请选择origin或者*_compatible，obfs Plugin请选择plain或者*_compatible，如果使用ShadowsocksR则无限制，系统会默认选择兼容原版Shadowsocks的形式，一般用户无需设置。</p>
                                </div>
                            </li>
                            <li>
                                <h3 class="uk-accordion-title">客户端使用手手册</h3>
                                <div class="uk-accordion-content">
                                    <p>下载客户端后，服务器地址输入节点列表中节点的IP地址，密码端口号和加密方式输入控制面板中链接信息显示的信息，如果使用ShadowsocksR则需要输入协议插件（protocal）和混淆插件(obfs)信息，使用原版Shadowsocks无需设置。</p>
                                    <p>配置好参数后需要设置代理，代理地址为127.0.0.1，端口号是软件下方显示的端口，默认为1080（安卓用户无需设置）</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
