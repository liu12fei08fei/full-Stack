const { Builder, By, Key, until } = require('selenium-webdriver');

(async function example() {
    let driver = await new Builder().forBrowser('firefox').build();
    try {
        await driver.get('http://0.0.0.0:3000/index/index');
        await driver.findElement(By.id('thumb'));
        const _animation = driver.findElement(By.id('animation'));
        await driver.wait(_animation.isDisplayed(),1000);
    } finally {
        await driver.quit();
        console.log('错误！');
    }
})();