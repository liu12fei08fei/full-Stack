'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _path = require('path');

var _path2 = _interopRequireDefault(_path);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Config = new Map();
Config.set('port', 3000);
Config.set('staticDir', _path2.default.join(__dirname, '..', 'public'));
Config.set('viewDir', _path2.default.join(__dirname, '..', 'views'));
exports.default = Config;
