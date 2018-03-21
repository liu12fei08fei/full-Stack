# 文件说明

[TOC]

## out文件夹

* 记录base.js的清晰说明

## js文件说明

### base.js

* 是常用方法集合

### axios.min.js

* Axios 是一个基于 promise 的 HTTP 库，可以用在浏览器和 node.js 中。
* XMLHttpRequests，异步请求使用

### clipboard.min.js

* clipboard.js是一款轻量级的实现复制文本到剪贴板功能的JavaScript插件

### des.js

* 加密文件
* 和旧打点合作

### WebBridge.js

* 目前仅限ios，前端和客户端交流的基础方法

### sensorsdata.min.js

* 新打点系统之一
* 和`sensorsdataprod.js`或`sensorsdatatest.js`合作打点

**sensorsdataprod.js**

* 是线上打点地址

**sensorsdatatest.js**

* 是测试打点地址

### vue.min.js

* 使用vue进行开发

## 常用方法总结

### 获得ios用户信息

* 和ios客户端进行交互
* 得到客户端：获取酷划id、获取手机型号、获取用户手机号、获取客户端的版本号

```
var data = {
    'func': 'getIdPhoneVersion',
    'params': ''
}
callHandler(JSON.stringify(data), function (data) {
    var data = typeof(data)=='string'?JSON.parse(data):data;
    var Online = data.env != 'test'
    var dataIos = {
        coohuaId:data.coohuaId,// 获取酷划id
        baseKey:data.baseKey,// 获取baseKey
        PhoneName:data.phoneName,// 获取手机型号
        phone:data.phone,// 获取用户手机号
        appVersion:data.appVersion,// 获取客户端的版本号
        Online:Online,// 环境，true代表是线上环境，fales代表是测试环境
    };
});
```

### 获得锁屏用户信息

* 这里收藏了常用的方法，都是全局方法，具体使用的时候可以先跟客户端沟通，防止出现问题

```
// 酷划baseKey接口
var baseKey = window.$CooHua?window.$CooHua.getBaseKey():'';

// 酷划id接口
var coohuaId = window.$CooHua?window.$CooHua.common_getCooHuaId():'';

// 酷划版本号接口，例：513000
var Version = window.$CooHua?window.$CooHua.common_getVersionCode():'';

// 是否是线上环境，true代表是线上环境，fales代表是测试环境
var Online = window.$CooHua&&window.$CooHua.is_online_environment?window.$CooHua.is_online_environment():'';

```

### 区分测试和线上环境，更好的进行测试

```
// true代表是线上环境，fales代表是测试环境
if (!Online) {
    document.title = document.title + "-2.0";
}
```

### 使用rem进行开发，rem:px=1:100

```
function Rem() {
// 获取视窗宽度
var htmlWidth = document.documentElement.clientWidth||document.body.clientWidth,
	// 获取html的DOM
	htmlDom = document.getElementsByTagName('html')[0],
    oSize = htmlWidth / 3.75;
htmlDom.style.fontSize = oSize + 'px';
}
window.addEventListener('resize', Rem, false);
Rem();
```

