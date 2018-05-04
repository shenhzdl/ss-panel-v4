似乎原作者被请去喝茶之后系统开发就停止了，源码也删了，我从[原作者](https://github.com/orvice/ss-panel/releases)处下载之后做了一些修补，使功能基本完善，勉强可满足个人当个奸商的需求。以下引用部分为原作者文档。


> # ss-panel
> Let's talk about cat.  A simple panel for shadowsocks.
>  Based on [LightFish](https://github.com/Pongtan/LightFish) and [Vue.js](https://vuejs.org).
> [Demo](https://demo.sspanel.xyz/)|[API Document](https://doc.sspanel.xyz/)| [安装文档](https://sspanel.xyz/docs)
> [![Build Status](https://travis-ci.org/orvice/ss-panel.svg?branch=master)](https://travis-ci.org/orvice/ss-panel) [![Coverage Status](https://coveralls.io/repos/github/orvice/ss-panel/badge.svg?branch=master)](https://coveralls.io/github/orvice/ss-panel?branch=master) [![Join the chat at https://gitter.im/orvice/ss-panel](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/orvice/ss-panel?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
>  ## About
> Please visit [releases pages](https://github.com/orvice/ss-panel/releases) to download source.
> ## Supported Server
> * [shadowsocks manyuser](https://github.com/mengskysama/shadowsocks/tree/manyuser)
> * [shadowsocksrss manyuser](https://github.com/breakwa11/shadowsocks/tree/manyuser)
> * [shadowsocks-go mu](https://github.com/orvice/shadowsocks-go)
> * [shadowsocks-go mu ng](https://github.com/catpie/ss-go-mu)
> ## Install with Docker
> ### Get it 
> ```bash
> docker pull orvice/ss-panel
> ```
> ### Install with Docker-compose
> [Install docker-compose](https://docs.docker.com/compose/install/)
> ```bash
> wget https://raw.githubusercontent.com/orvice/ss-panel/master/docker-compose.yml
> docker-compose up -d
> ```
> Visit `ip:8080`
> You can also install manual with Nginx or other web server,[check wiki](https://github.com/orvice/ss-panel/wiki/Install-with-Nginx).
> ## ToDo
> * Full unit test for api
> * Unit test for Front
> ## Thanks to
> * [LightFish](https://github.com/Pongtan/LightFish)
> * [Vue.js](https://vuejs.org)
> * [UIKit](https://getuikit.com)
> * [UIAdmin](https://github.com/ConsoleTVs/UIAdmin)
> * [Now UI Kit](https://github.com/creativetimofficial/now-ui-kit)

以下为我增改部分说明：

## 主体界面

删除了部分节点的class：uk-child-width-1-4@xl，1080P及以上的屏幕显示

## 管理面板

### 增加用户管理

- 在用户管理页可以显示所有用户
- 提供一键根据到期时间设置用户可用性功能
- 可以手动为用户创建订单，以满足多个支付场景

### 增加订单显示

- 可以显示所有订单

### 配置功能修改

- 修改首页消息公告显示方式，使可以显示HTML
- 与之对应将配置中的消息公告编辑框从input修改为textarea

## 用户控制

### 控制面板

- 添加到期日期显示和充值按钮
- 与之对应改变了文字和按钮排列方式

### 使用手册

- 添加了使用手册页面，提供客户端下载和基本使用说明

### 备注

- 系统的自动充值系统充值到个人支付宝账户，需要使用软件监控支付宝账单，并推送到自己的服务器，我写了一个支付宝订单监控系统，欢迎[下载](http://www.myshuju.net/home/download)使用

### 欢迎打赏

![二维码](/public/assets/img/dscode.png)


### 找回密码更改

- 原作者使用的是Mailgun，不过持续使用Mailgun需要国际信用卡，考虑到部分人没有，又不想用国内的服务，选用了SendGrid，如果要改回Mailgun更改app/Providers/MailSrviceProvider中的register即可
- SendGrid参数设置使用原Mailgun设置部分，请求网址可随便填