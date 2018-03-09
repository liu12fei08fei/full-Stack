'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _indexModel = require('../models/indexModel');

var _indexModel2 = _interopRequireDefault(_indexModel);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var indexController = {
    index: function index() {
        return async function (ctx, next) {
            ctx.body = await ctx.render('index.html', {
                title: '大拇指点赞'
            });
        };
    },
    update: function update() {
        return async function (ctx, next) {
            var indexM = new _indexModel2.default();
            ctx.body = await indexM.updateNum();
        };
    }
};
exports.default = indexController;
