const Vue = require('vue')
const server = require('express')()
// 创建renderer
const renderer = require('vue-server-renderer').createRenderer({
    // 引入页面模板
    template: require('fs').readFileSync('./index.template.html', 'utf-8')
});
server.get('*', (req, res) => {
    // 创建vue实例
    const app = new Vue({
        data: {
            url: req.url
        },
        template: `<div>访问的 路由 是： {{ url }}</div>`
    });
    // 渲染上下文对象，renderToString函数第二个参数，提供差值数据
    const context = {
        title: '怪诞咖啡-SSR',
        meta: `
        <!-- 360浏览器启动webkit内核渲染 -->
        <meta name="renderer" content="webkit">
        <!-- QQ移动浏览器，在指定方向上锁定屏幕（锁定横/竖屏=landscape/portrait） -->
        <meta name="x5-orientation" content="portrait">
        <!-- UC移动浏览器，在指定方向上锁定屏幕（锁定横/竖屏=landscape/portrait） -->
        <meta name="screen-orientation" content="portrait">
      `
    };
    // 将 Vue 实例渲染为 HTML
    renderer.renderToString(app, context, (err, html) => {
        if (err) {
            res.status(500).end('Internal Server Error')
            return
        }
        res.end(`${html}`);
    })
});
// 绑定端口
const port = 8080;
server.listen(port, () => {
    console.log(`Server running at http://0.0.0.0:${port}`);
});