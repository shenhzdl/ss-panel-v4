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
                                <h3 class="uk-accordion-title">使用手册</h3>
                                <div class="uk-accordion-content">
                                    <p>本手册以Windows的原版Shadowsocks为例，其他客户端类似。</p>
                                    <ul>
                                        <li>
                                            <p>第一步，下载客户端
                                                <a href="https://github.com/shadowsocks/shadowsocks-windows/releases/download/4.0.7/Shadowsocks-4.0.7.zip">下载</a>，下载之后解压到到自己指定的文件夹。双击点开Shadowsocks.exe，出现如下界面：
                                                <br/>
                                                <img alt="image" src="/assets/img/doc1.png"/>
                                            </p>
                                        </li>
                                        <li>
                                            <p>接下来我们需要配置参数。在我们的网站中点开节点列表，如图：
                                                <br/>
                                                <img alt="image" src="/assets/img/doc2.png"/>
                                                <br/>
                                                点开一个节点，如图，复制IP地址，粘贴到软件的服务器地址输入框内。
                                                <br/>
                                                <img alt="image" src="/assets/img/doc3.png"/>
                                                <br/>
                                                然后来在我们的网站点开控制面板，看链接信息模块，软件的服务器端口填写链接信息中的端口，软件的密码填写链接信息中的密码，软件的加密选择链接方式中的加密方式
                                                <br/>
                                                <img alt="image" src="/assets/img/doc4.jpg"/>
                                                <br/>
                                                配置完之后点击确定即可，界面会隐藏到左面右下角的状态栏。另外我们提供了多个节点，这也就表示我们的用户可以点击添加按钮添加多条配置，随意使用哪一个节点，甚至可以开启服务器>>负载均衡来同时使用多个节点，提高速度。
                                            </p>
                                        </li>
                                        <li>
                                            <p>第三步是配置浏览器：</p>
                                            <ul>
                                                <li>IE浏览器设置方式：设置&gt;&gt;Intenet选项&gt;&gt;连接选项卡&gt;&gt;局域网设置，在代理服务器部分，勾选为LAN使用代理服务器，地址填入127.0.0.1，端口填入1080。如图：<br/>
                                                <img alt="image" src="/assets/img/doc5.png"/>  </li>
                                                <li>Chrome浏览器设置方式：设置&gt;&gt;最下面&gt;&gt;高级&gt;&gt;最下面&gt;&gt;打开代理设置，之后就跟IE设置一致。</li>
                                                <li>Firefox浏览器设置方式：选项&gt;&gt;最下面&gt;&gt;网络代理&gt;&gt;点设置按钮&gt;&gt;手动配置代理，地址输入127.0.0.1，端口输入1080，注意要选择Socket V5。如图。<br/>
                                                <img alt="image" src="/assets/img/doc6.png"/>  </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
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
                                    <p>Windwos客户端：<a class="uk-link-muted" href="https://github.com/shadowsocks/shadowsocks-windows/releases/download/4.0.7/Shadowsocks-4.0.7.zip">下载</a></p>
                                    <p>MacOS客户端：<a class="uk-link-muted" href="https://github.com/shadowsocks/ShadowsocksX-NG/releases/download/v1.7.0/ShadowsocksX-NG.1.7.0.zip">下载</a></p>
                                    <p>
                                        Android客户端：
                                        <a href="https://play.google.com/store/apps/details?id=com.github.shadowsocks" rel="nofollow">
                                            <img class="uk-width-1-5" src="https://camo.githubusercontent.com/bdaf711a93d64d0bb5e5abfc346a8b84ea47f164/68747470733a2f2f706c61792e676f6f676c652e636f6d2f696e746c2f656e5f75732f6261646765732f696d616765732f67656e657269632f656e2d706c61792d62616467652e706e67" data-canonical-src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png" />
                                        </a>
                                        或者
                                        <a class="uk-link-muted" href="https://apps.evozi.com/apk-downloader/?id=com.github.shadowsocks">下载APK</a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
