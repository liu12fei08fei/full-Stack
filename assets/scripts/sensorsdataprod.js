// 线上环境
(function (para) {
    var n = para.name;
    window['sensorsDataAnalytic201505'] = n;
    window[n] = {
        _q: [],
        para: para
    };
})({
    name: 'sa',
    show_log: true,
    server_url: 'http://dcs.coohua.com/data/v1?project=browser'//浏览器
    // server_url: 'http://dcs.coohua.com/data/v1?project=locker_test'//锁屏测试
});