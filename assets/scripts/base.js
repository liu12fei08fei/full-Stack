/**
 * 新埋点方法封装
 * [依赖sensorsdata.min.js和sensorsdataprod.js/sensorsdatatest.js]
 * @param  {string}   element_page 埋点页面名称
 * @param  {string}   element_name 要埋点位置名称
 * @param  {string}   os           用户系统os/android
 * @param  {string}   userId       酷划id
 * @param  {Function} callback     回调函数，一般用不到
 * @return {empty}                 空
 */
function buriedPoint(element_page, element_name, os, userId, callback) {
    sa.track("WebClick", {
        element_page: element_page,
        element_name: element_name,
        page_url: location.href,
        os: os,
        userId: userId
    }, function() {
        callback && callback();
    });
}

/**
 * 时间戳格式化
 * 依赖evenNum方法
 * @param  {number} timestamp 时间戳
 * @return {string}           例：2018-08-08
 */
function fromatDate(timestamp) {
    var sDate = new Date(timestamp); //日期
    var sYear = sDate.getFullYear(); //年
    var sMonth = sDate.getMonth() + 1; //月
    var sDay = sDate.getDate(); //日
    var sHour = sDate.getHours(); //小时
    var sMinute = sDate.getMinutes(); //分钟
    var sSecond = sDate.getSeconds(); //秒
    var mSecond = sDate.getMilliseconds(); //毫秒
    return sYear + '-' + evenNum(sMonth) + '-' + evenNum(sDay);
}

/**
 * 双数显示数字
 * @param  {number} n 要格式的数字
 * @return {number}   返回双数格式数字
 */
function evenNum(n) {
    return /^\d\d$/.test(n) ? '' + n : '0' + n;
}

/**
 * 是否为安卓手机
 * @return {Boolean} true安卓手机，false苹果手机
 */
function isAndroid() {
    function _() {}
    _.WIN = window;
    _.NA = _.WIN.navigator;
    _.UA = _.NA.userAgent.toLowerCase();
    _.test = function(needle) {
        return needle.test(_.UA);
    }
    _.isAndroid = _.test(/android|htc/) || /linux/i.test(_.NA.platform + "");
    return _.isAndroid;
}

/**
 * 倒计时格式化
 * 依赖evenNum方法
 * @param  {number} second 剩余秒数
 * @return {string}        时分秒/分秒/秒
 */
function countdownFormat(second) {
    var d = evenNum(Math.floor(Number(second) / 60 / 60 / 24));
    var h = evenNum(Math.floor(Number(second) / 60 / 60 % 24));
    var m = evenNum(Math.floor(Number(second) / 60 % 60));
    var s = evenNum(Math.floor(Number(second) % 60));
    var rtn = '';
    if (h != 0 && m != 0) {
        rtn = h + '小时' + m + '分' + s + '秒';
    } else {
        if (h == 0 && m != 0) {
            rtn = m + '分' + s + '秒';
        } else {
            rtn = s + '秒';
        }
    }
    return rtn;
}

/**
 * 旧平台打点
 * 依赖axios.min.js、des.js文件
 * 依赖getParam方法
 * @param  {string}   action   打点名称
 * @param  {Function} callback 回调函数
 * @return {empty}            空
 */
function remoteLog(action,callback) {
    var ua = navigator.userAgent.toLowerCase();
    var url = "http://log.coohua.com/domain_click.txt";
    var uid = 0;
    if (url.indexOf("?") == -1) {
        url += '?src=new&action=' + action + '&time=' + new Date().getTime() + '&cid=' + vm.coohuaId + '&uid=' + '&url=' + strEnc(window.location.href, 'coohua@#2014') + '&ch=' + getParam("ch") + '&next_url=' + strEnc(window.location.href, 'coohua@#2014');
    } else {
        url += '&src=new&action=' + action + '&time=' + new Date().getTime() + '&cid=' + vm.coohuaId + '&uid=' + '&url=' + strEnc(window.location.href, 'coohua@#2014') + '&ch=' + getParam("ch") + '&next_url=' + strEnc(window.location.href, 'coohua@#2014');
    }
    axios.get(url)
      .then(function (response) {
        var status = response.data.status;
        if(status==1){
            // 请求通过,执行下一步
            callback&&callback();
        }else{
            console.log('请求埋点失败！');
        }
      })
      .catch(function (error) {
        console.log(error);
      });

}

/**
 * remoteLog方法依赖项
 * @param  {string} param 要格式化的参数
 * @return {string}       返回指定值
 */
function getParam(param) {
    var url = "http://log.coohua.com/domain_click.txt";
    var r = new RegExp("\\?(?:.+&)?" + param + "=(.*?)(?:[\?&].*)?$");
    var m = url.match(r);
    return m ? m[1] : "";
}

/**
 * 查询字符串转对象
 * @return {object} 返回对象
 */
function getQueryStringArgs(){
	var qs = (location.search.length > 0 ? location.search.substring(1) : ""), args = {}, items = qs.length ? qs.split("&") : [], item = null, name = null, value = null, i = 0, len = items.length; for (i = 0; i < len; i++) { item = items[i].split("="); name = decodeURIComponent(item[0]); value = decodeURIComponent(item[1]); if (name.length) { args[name] = value } } return args;
}

/**
 * axios的get请求
 * @param  {string}   url      url请求地址
 * @param  {object}   data     请求参数
 * @param  {Function} callback 回调函数
 * @return {empty}            空
 */
function requestGet(url,data,callback){
    axios.get(url, {
            params: data
        })
        .then(function(response) {
            let status = response.status;
            if (status >= 200 && status < 300 || status == 304) {
                callback&&callback(response);
            } else {
                console.log(response.statusText);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
}

/**
 * axios的post请求
 * @param  {string}   url      请求地址
 * @param  {object}   data     请求参数
 * @param  {Function} callback 回调函数
 * @return {empty}            空
 */
function requestPost(url,data,callback){
    axios.post(url, data)
        .then(function(response) {
            let status = response.status;
            if ((status >= 200 && status < 300) || status == 304) {
                callback&&callback(response);
            }else{
                console.log(response.statusText);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
}

/**
 * 获取当前日期前n天的日期
 * @param  {number} n 提前天数
 * @return {string}   格式化的时间，即：2018-08-08
 */
function getBeforeDate(n){
    var n = n;
    var d = new Date();
    var year = d.getFullYear();
    var mon=d.getMonth()+1;
    var day=d.getDate();
    if(day <= n){
            if(mon>1) {
               mon=mon-1;
            }
           else {
             year = year-1;
             mon = 12;
             }
           }
          d.setDate(d.getDate()-n);
          year = d.getFullYear();
          mon=d.getMonth()+1;
          day=d.getDate();
     s = year+"-"+(mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day);
     return s;
}

/**
 * 数组中对象去重
 * @param  {array} arr array去重数组
 * @return {array}     去重之后的数组
 */
function objectHeavy(arr){
    var unique = {};
    arr.forEach(function(item) {
        unique[JSON.stringify(item)] = item
    });
    return Object.keys(unique).map(function(uitem) {
        return JSON.parse(uitem)
    });
}

/**
 * 对象格式化，方便查看打印后的数组和对象
 * @param  {object} obj 要格式化的object
 * @return {object}     不变，object
 */
function dataFormat(obj){
    var _data = JSON.stringify(obj,null,4);
    console.log(_data);
    return _data;
}

/**
 * 处理查询字符串
 * @param {string} url   要追加查询字符串的URL
 * @param {string} name  参数名
 * @param {string} value 参数值
 * @return {object}      合成之后的地址
 */
function addQueryStringArg(url, name, value){
    if(url.indexOf("?")==-1){
        url += "?";
    }else{
        url += "&";
    }

    url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
    return url;
}

/**
 * 是否是String
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isString(object){
    return Object.prototype.toString.call(object)==='[object String]';
}

/**
 * 是否是Number
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isNumber(object){
    return Object.prototype.toString.call(object)==='[object Number]';
}

/**
 * 是否是Boolean
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isBoolean(object){
    return Object.prototype.toString.call(object)==='[object Boolean]';
}

/**
 * 是否是Undefined
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isUndefined(object){
    return Object.prototype.toString.call(object)==='[object Undefined]';
}

/**
 * 是否是Null
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isNull(object){
    return Object.prototype.toString.call(object)==='[object Null]';
}

/**
 * 是否是Symbol
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isSymbol(object){
    return Object.prototype.toString.call(object)==='[object Symbol]';
}

/**
 * 是否是Object
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isObject(object){
    return Object.prototype.toString.call(object)==='[object Object]';
}

/**
 * 是否是Array
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isArray(object){
    return Object.prototype.toString.call(object)==='[object Array]';
}

/**
 * 是否是Function
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isFunction(object){
    return Object.prototype.toString.call(object)==='[object Function]';
}

/**
 * 是否是Date
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isDate(object){
    return Object.prototype.toString.call(object)==='[object Date]';
}

/**
 * 是否是RegExp
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isRegExp(object){
    return Object.prototype.toString.call(object)==='[object RegExp]';
}

/**
 * 是否是Math
 * @param  {object}  object object
 * @return {Boolean}        true/false
 */
function isMath(object){
    return Object.prototype.toString.call(object)==='[object Math]';
}

/**
 * string转base64
 * @param  {string} str 要格式化的字符串
 * @return {string}     base64格式的字符串
 */
function base64Encode(str){
    // 对字符串进行编码
    var encode = encodeURI(str);
    // 对编码的字符串转化base64
    var base64 = btoa(encode);
    return base64;
}

/**
 * base64转string
 * @param  {string} base64 base64码的字符串
 * @return {string}        格式化完成的string
 */
function base64Decode(base64){
    // 对base64转编码
    var decode = atob(base64);
    // 编码转字符串
    var str = decodeURI(decode);
    return str;
}
