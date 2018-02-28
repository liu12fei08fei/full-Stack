'use strict';

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function () {
    var PraiseButton = function () {
        // static 
        function PraiseButton(ele, num) {
            _classCallCheck(this, PraiseButton);

            this.ele = ele;
            this.num = num;
        }

        _createClass(PraiseButton, [{
            key: 'init',
            value: function init() {
                var _this = this;

                var ele = document.querySelector(this.ele);
                var eleName = this.ele.substr(1);
                ele.onclick = function () {
                    if (_this.num < 10) {
                        _this.num++;
                        ele.querySelector('span').innerHTML = _this.num;
                        ele.setAttribute('title', _this.num);
                        if (_this.num == 10) {
                            ele.className = eleName + " " + eleName + "_active";
                        }
                    }
                };
            }
        }]);

        return PraiseButton;
    }();
    // 父类


    new PraiseButton('.favour', 0).init();
    // 子类

    var Thumb = function (_PraiseButton) {
        _inherits(Thumb, _PraiseButton);

        function Thumb(ele, num) {
            _classCallCheck(this, Thumb);

            return _possibleConstructorReturn(this, (Thumb.__proto__ || Object.getPrototypeOf(Thumb)).call(this, ele, num));
        }

        _createClass(Thumb, [{
            key: 'init',
            value: function init() {
                _get(Thumb.prototype.__proto__ || Object.getPrototypeOf(Thumb.prototype), 'init', this).call(this);
            }
        }]);

        return Thumb;
    }(PraiseButton);

    new Thumb('.hand', 0).init();
})();